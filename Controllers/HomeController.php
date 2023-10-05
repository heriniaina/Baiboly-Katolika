<?php 

namespace Baiboly\Controllers;
use Baiboly\Models\BokyModel;
use Serasera\Base\Controllers\BaseController;

class HomeController extends BaseController {

    public function index() {
        $bokyModel = new BokyModel();

        $this->data['page_title'] = lang('Baiboly.fandraisana');
        $this->data['boky'] = $bokyModel->orderBy('b_order')->findAll();


        return view('\Baiboly\Views\home_index', $this->data);
    }
}