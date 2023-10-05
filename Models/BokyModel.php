<?php 

namespace Baiboly\Models;
use Serasera\Base\Models\BaseModel;

class BokyModel extends BaseModel {


    protected $table      = 'b_boky';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    
    protected $useTimestamps = false;

    protected $allowedFields = ['id', 'b_name', 'b_sname', 'b_order', 'b_notes', 'b_intro', 'b_file', 'b_abbr', 'b_test' ];

}