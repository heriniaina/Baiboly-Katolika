<?php

namespace Baiboly\Controllers;

use Baiboly\Models\AndininyModel;
use Baiboly\Models\BokyModel;
use Baiboly\Models\TokoModel;
use Serasera\Base\Controllers\BaseController;

class BokyController extends BaseController
{


    private $fontname = ROOTPATH . 'modules/Baiboly/Fonts/Capriola-Regular.ttf';
    /**
     * Mampiseho ny lisitry ny boky
     *
     * @return string
     */
    public function index()
    {
        $this->data['page_title'] = lang('Baiboly.boky_rehetra');
        $this->data['rows'] = (new BokyModel())->orderBy('b_order')->findAll();
        return view('\Baiboly\Views\boky_index', $this->data);
    }

    public function showById($id)
    {
        $boky = (new BokyModel())->where('b_order', $id)->first();
        if (!$boky) {
            return redirect()->to('boky')->with('error', lang('Baiboly.tsy_hita_ny_boky'));
        }
        $this->data['boky'] = $boky;
        $this->data['rows'] = (new TokoModel())->where('t_b_id', $boky['id'])->orderBy('t_toko')->findAll();

        $this->data['page_title'] = $boky['b_name'];

        return view('\Baiboly\Views\boky_show', $this->data);
    }
    public function show($boky)
    {
        $boky = (new BokyModel())->where('b_sname', $boky)->first();
        if (!$boky) {
            return redirect()->to('boky')->with('error', lang('Baiboly.tsy_hita_ny_boky'));
        }
        $this->data['boky'] = $boky;
        $this->data['rows'] = (new TokoModel())->where('t_b_id', $boky['id'])->orderBy('t_toko')->findAll();

        $this->data['page_title'] = $boky['b_name'];

        return view('\Baiboly\Views\boky_show', $this->data);

    }

    public function toko($boky, $toko, $andininy = false)
    {

        if (!$andininy) {
            return $this->andininy($boky, $toko);
        }
        return $this->andininy($boky, $toko . "," . trim($andininy));
    }

    public function andininy($bokyname, $tokosyandininy)
    {
        $boky = (new BokyModel())->where('b_sname', $bokyname)->first();
        if (!$boky) {
            return redirect()->to('boky')->with('error', lang('Baiboly.tsy_hita_ny_boky'));
        }
        // esory aloha ny espace rehetra

        $aModel = new AndininyModel();
        $builder = $aModel->getAndininy();

        $builder->where('b.id', $boky['id']);

        if (false === strpos($tokosyandininy, ':')) {
            //new version
            /*
             * ny fanoratra izany dia
             * boky toko,andininy-andininy.andininy.andininy;toko,andininy
             * ; manasaraka ny toko samihafa
             * . manasaraka ny andininy samihafa
             * , manasaraka ny toko sy andininy
             */

            // esory aloha ny espace rehetra
            $tokosyandininy = str_replace(' ', '', $tokosyandininy);
            // Misy ; = toko maromaro
            $fiz = [];
            $fiz = explode(';', $tokosyandininy);


            $builder->groupStart();

            foreach ($fiz as $fiz1) {
                //jerena raha toko sy andininy
                $fiz2 = [];
                $fiz2 = explode(',', $fiz1);
                $builder->orWhere('a.b_toko', $fiz2['0']);
                if (isset($fiz2[1])) {
                    $andininy = $fiz2[1];
                    //misy andininy
                    $vands = [];

                    $arr_virg = explode('.', $andininy);
                    if (is_array($arr_virg)) {
                        foreach ($arr_virg as $key => $val) {
                            $arr_and = explode('-', $val, 2);
                            if (is_array($arr_and)) {
                                $arr_and[0] = (int) (trim($arr_and[0]));
                                if (isset($arr_and[1])) {
                                    $arr_and[1] = (int) (trim($arr_and[1]));
                                } else {
                                    $arr_and[1] = 0;
                                }
                                if ($arr_and[0] > $arr_and[1]) {
                                    $val_and_1 = $arr_and[1];
                                    $val_and_2 = $arr_and[0];
                                } else {
                                    $val_and_1 = $arr_and[0];
                                    $val_and_2 = $arr_and[1];
                                }
                                if ($val_and_1 > 0) {
                                    for ($i = $val_and_1; $i <= $val_and_2; ++$i) {
                                        $vands[] = $i;
                                    }
                                } else {
                                    $vands[] = $val_and_2;
                                }
                            } elseif ((int) (trim($val)) > 0) {
                                $vands[] = (int) (trim($val));
                            }
                        }
                    } else {
                        $vands[] = (int) (trim($andininy));
                    }
                    if (count($vands) > 0) {
                        $builder->groupStart();
                        foreach ($vands as $vand) {
                            $builder->orWhere('b_and', $vand);
                        }
                        $builder->groupEnd();
                    }

                }
            }
            $builder->groupEnd();



        } else {
            //old version

            /*
             * added on 16/05/2008
             * Raha ohatra ka manana endrika toa izao
             * /boky/1:2-6
             * na
             * /boky/1:2-3;5:6-7.6
             */

            // esory aloha ny espace rehetra
            $tokosyandininy = str_replace(' ', '', $tokosyandininy);
            // Misy ; = toko maromaro
            $fiz = [];
            $fiz = explode(';', $tokosyandininy);

            $builder->groupStart();

            foreach ($fiz as $fiz1) {

                $fiz2 = [];
                $fiz2 = explode(':', $fiz1);
                $builder->orWhere('a.b_toko', $fiz2['0']);

                if (isset($fiz2[1])) {
                    $andininy = $fiz2[1];
                    //misy andininy
                    $vands = [];

                    $arr_virg = explode(',', $andininy);
                    if (is_array($arr_virg)) {
                        foreach ($arr_virg as $key => $val) {
                            $arr_and = explode('-', $val, 2);
                            if (is_array($arr_and)) {
                                $arr_and[0] = (int) (trim($arr_and[0]));
                                if (isset($arr_and[1])) {
                                    $arr_and[1] = (int) (trim($arr_and[1]));
                                } else {
                                    $arr_and[1] = 0;
                                }
                                if ($arr_and[0] > $arr_and[1]) {
                                    $val_and_1 = $arr_and[1];
                                    $val_and_2 = $arr_and[0];
                                } else {
                                    $val_and_1 = $arr_and[0];
                                    $val_and_2 = $arr_and[1];
                                }
                                if ($val_and_1 > 0) {
                                    for ($i = $val_and_1; $i <= $val_and_2; ++$i) {
                                        $vands[] = $i;
                                    }
                                } else {
                                    $vands[] = $val_and_2;
                                }
                            } elseif ((int) (trim($val)) > 0) {
                                $vands[] = (int) (trim($val));
                            }
                        }
                    } else {
                        $vands[] = (int) (trim($andininy));
                    }
                    if (count($vands) > 0) {
                        $builder->groupStart();
                        foreach ($vands as $vand) {
                            $builder->orWhere('b_and', $vand);
                        }
                        $builder->groupEnd();
                    }
                }
            }
            $builder->groupEnd();

        }



        $rows = $builder->paginate(50);

        if (!$rows) {
            return redirect()->to('boky/' . $boky['b_sname'])->with('error', lang('Baiboly.tsy_hita_ny_lahatsoratra'));
        }
        $this->data['pager'] = $aModel->pager;
        $this->data['andininy'] = $rows;
        $this->data['page_title'] = $rows['0']['b_sname'] . " " . $tokosyandininy;
        $this->data['tokosyandininy'] = $tokosyandininy;
        $this->data['boky'] = $boky;

        switch ($this->request->getGet('output')) {
            case 'sary.jpg':


                $file = WRITEPATH . 'ogimage_' . md5($rows['0']['b_sname'] . "_" . $tokosyandininy) . '.jpg';

                if (!file_exists($file) || $this->request->getGet('refresh')) {

                    // define the base image that we lay our text on
                    $width = 1920;
                    $height = 1080;
                    $randfond = rand(0, 4);
                    $im = imagecreatefromjpeg(ROOTPATH . 'modules/Baiboly/Images/fonds/light_' . $randfond . '.jpg');

                    // setup the text colours
                    $grey = imagecolorallocate($im, 0, 0, 0);
                    $white = imagecolorallocate($im, 255, 255, 255);



                    $rectangleX = 100; // X-coordinate of the top-left corner of the rectangle
                    $rectangleY = 100; // Y-coordinate of the top-left corner of the rectangle
                    $rectangleWidth = $width - 100; // Width of the rectangle
                    $rectangleHeight = $height - 100; // Height of the rectangle

                    $fontsize = 50; //title
                    $text = wordwrap($rows['0']['b_text'], 40, "\n", false) . "\n     " . "(" . $rows['0']['b_sname'] . ", " . $tokosyandininy . ")";

                    $bbox = imagettfbbox($fontsize, 0, $this->fontname, $text);

                    // This is our cordinates for X and Y

                    $x = $bbox[6] + imagesx($im) / 2 - (ceil($bbox[4] / 2));
                    $y = $bbox[7] + imagesy($im) / 2 - (ceil($bbox[1] / 2));

                    // Write it
                    imagettftext($im, $fontsize, 0, $x, $y, $grey, $this->fontname, $text, ['linespacing' => 1.5]);
                    // create the image
                    $img = imagejpeg($im, $file, 90);
                    return $this->response->setContentType('image/jpeg')->setBody(file_get_contents($file));
                }

                return $this->response->download($file, null);

            case 'json':
                $boky['andininy'] = $rows;
                $boky['page'] = [
                    'first' => $aModel->pager->getFirstPage(),
                    'last' => $aModel->pager->getLastPage(),
                    'current' => $aModel->pager->getCurrentPage(),
                    'total' => $aModel->pager->getTotal()
                ];
                return $this->response->setJSON($boky);
            default:
                return view('\Baiboly\Views\boky_andininy', $this->data);

        }


    }

    private function center_text($string, $font_size)
    {
        $image_width = 1920;
        $width = 0;

        $bbox = imagettfbbox($font_size, 0, $this->fontname, $string);

        return ceil(($image_width - $bbox[4]) / 2);
    }
}