<?php

namespace Baiboly\Controllers;

use Baiboly\Models\AndininyModel;
use Baiboly\Models\BokyModel;
use Serasera\Base\Controllers\BaseController;

class BaibolyController extends BaseController
{

    public function index()
    {

        //new version
        /*
         * ny fanoratra izany dia
         * boky toko,andininy-andininy.andininy.andininy;toko,andininy
         * ; manasaraka ny toko samihafa
         * . manasaraka ny andininy samihafa
         * , manasaraka ny toko sy andininy
         */

        // esory aloha ny espace rehetra
        $aModel = new AndininyModel();
        $builder = $aModel->getAndininy();

        $this->data['page_title'] = lang('Baiboly.andininy_rehetra');
        $boky = $this->request->getGet('boky');
        if ($boky) {

            $builder->where('b_sname', $boky);
            $this->data['page_title'] = $boky;
            $toko = $this->request->getGet('toko');
            if ($toko && intval($toko) > 0) {
                $this->data['toko'] = $toko;
                $this->data['page_title'] .= " " . $toko;
                $builder->where('t_toko', $toko);
                if ($andininy = $this->request->getGet('andininy')) {
                    // esory aloha ny espace rehetra

                    $andininy = str_replace(" ", "", $andininy);
                    $this->data['andininy'] = $andininy;
                    $this->data['page_title'] .= ", " . $andininy;
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


        }
        $teny = $this->request->getGet('teny');
        if($teny) {
            $this->data['page_title'] .= " " . lang('Baiboly.misy_hoe', [$teny]);
            $builder->groupStart();
            $tenys = explode(" ", $teny);
            $clean_teny = [];
            foreach ($tenys as $t) {
                if(trim($t) != "") {
                    $builder->like('a.b_text', $t);
                    $clean_teny[] = $t;
                }
            }
            
            $builder->groupEnd();
            $this->data['teny'] = $clean_teny;
            

        }

        $rows = $builder->paginate(50);

        
        $this->data['pager'] = $aModel->pager;
        $this->data['andininy'] = $rows;

        return view('\Baiboly\Views\baiboly_index', $this->data);
    }

    public function niova($niova = 0) {
        if (intval($niova) < 202104101956) {
            $niova = 202104101956;
        }
        $rows = (new AndininyModel())->select('b_text, b_niova, id')->where('b_niova >', $niova)->orderBy('b_niova')->findAll();
        //$query = $this->db->query('SELECT id, b_text, b_niova FROM '.$this->db->dbprefix('b_and').' WHERE b_niova > ? ORDER BY b_niova, id', [$niova]);

        return $this->response->setJSON($rows);
    }

    public function search() {
        $this->data['page_title'] = lang('Baiboly.fitadiavana');
        $this->data['boky'] = (new BokyModel())->orderBy('b_order')->findAll();
        return view('\Baiboly\Views\baiboly_search', $this->data);
    }


    public function hamaky() {
        $this->data['page_title'] = lang('Baiboly.hamaky_baiboly');

        
        return view('\Baiboly\Views\baiboly_hamaky', $this->data);
    }
    
}