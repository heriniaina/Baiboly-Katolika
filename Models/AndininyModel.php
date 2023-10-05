<?php 

namespace Baiboly\Models;
use Serasera\Base\Models\BaseModel;

class AndininyModel extends BaseModel {
    protected $table      = 'baiboly_v2_b_and';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['id', 'b_t_id', 'b_toko', 'b_and', 'b_text', 'b_notes', 'b_break', 'b_user', 'b_niova'];    


    public function getAndininy() {

        $this->select('b.b_name, b.b_sname, b.b_intro, t.t_b_id, t.t_toko, t.t_intro, a.id, a.b_t_id, a.b_toko, a.b_and, a.b_text, a.b_break')
        ->from('baiboly_v2_b_and a', true)
        ->join('baiboly_v2_b_toko t', 't.id=a.b_t_id', 'left')
        ->join('baiboly_v2_b_boky b', 'b.id=t.t_b_id', 'left')
        ->orderBy('b.b_order')
        ->orderBy('t.t_toko')
        ->orderBy('a.b_and');

        return $this;
    }
}