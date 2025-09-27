<?php 

namespace Baiboly\Models;
use Serasera\Base\Models\BaseModel;


class TokoModel extends BaseModel
{
    protected $table      = 'b_toko';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['id', 't_b_id', 't_toko', 't_and', 't_intro', 't_notes', 't_intro2' ];



    protected $afterInsert = ['insertChange'];
    protected $afterUpdate = ['updateChange'];
    
    protected function insertChange($data) {

        (new ChangeModel())->insert(['table' => 'b_toko', 'type' =>'c', 'src_id' => $data['id'], 'data' => json_encode($data['data'])]);
    }

    protected function updateChange($data) {

        (new ChangeModel())->insert(['table' => 'b_toko', 'type' =>'u', 'src_id' => $data['id'], 'data' => json_encode($data['data'])]);
    }
}