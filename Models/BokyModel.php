<?php 

namespace Baiboly\Models;
use Serasera\Base\Models\BaseModel;

class BokyModel extends BaseModel {


    protected $table      = 'b_boky';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    
    protected $useTimestamps = false;

    protected $allowedFields = ['id', 'b_name', 'b_sname', 'b_order', 'b_notes', 'b_intro', 'b_file', 'b_abbr', 'b_test' ];

    protected $afterInsert = ['insertChange'];
    protected $afterUpdate = ['updateChange'];
    
    protected function insertChange($data) {

        (new ChangeModel())->insert(['table' => 'b_boky', 'type' =>'c', 'src_id' => $data['id'], 'data' => json_encode($data['data'])]);
    }

    protected function updateChange($data) {

        (new ChangeModel())->insert(['table' => 'b_boky', 'type' =>'u', 'src_id' => $data['id'], 'data' => json_encode($data['data'])]);
    }


    public function getBoky() {
        $this->from('b_boky b', true)
        ->join('b_boky_alt_names alt', 'alt.alt_b_id=b.id');

        return $this;
        
    }
}