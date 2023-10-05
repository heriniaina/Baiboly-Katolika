<?php 

namespace Baiboly\Controllers;
use Baiboly\Models\TahiryModel;
use Serasera\Base\Controllers\BaseController;

class TahiryController extends BaseController {

    public function index() {
        $this->data['page_title'] = lang('Baiboly.andininy_voatahiry');

        $tahiryModel = new TahiryModel();

        $rows = $tahiryModel->where('username', $this->user['username'])->orderBy('id')->paginate(20);

        if(!$rows) {
            return redirect()->to('baiboly')->with('error', lang('Baiboly.mbola_tsisy_tahiry'));
        }

        $this->data['rows'] = $rows;
        $this->data['pager'] = $tahiryModel->pager;
        $this->data['page'] = $this->request->getGet('page') ?? 1;

        return view('\Baiboly\Views\tahiry_index', $this->data);
    }

    public function create() {

        if($this->request->getMethod() == 'post') {
            
            $username = $this->user['username'];
            $name = $this->request->getPost('name');
            $uri = $this->request->getPost('uri');
            $note = $this->request->getPost('note');

            if( (new TahiryModel())->insert(['username' => $username, 'name' => $name, 'uri' => $uri, 'note' => $note], true)) {
                return redirect()->to('baiboly/tahiry')->with('message', lang('Baiboly.tafiditra_ny_tahiry'));
            }
            return redirect()->to('baiboly')->with('error', lang('Baiboly.tsy_tafiditra_ny_tahiry'));
        }

        $this->data['page_title'] = lang('Baiboly.tehirizo');

        return view('\Baiboly\Views\tahiry_create', $this->data);
    }
}