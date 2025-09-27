<?php 

namespace Baiboly\Models;

use Serasera\Base\Models\BaseModel;

class ChangeModel extends BaseModel {

    protected $table = 'b_changes';
    protected $primaryKey = 'id';
    
    protected $useAutoIncrement = true;
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['table', 'type', 'data'];
    
    protected $useTimestamps = false;
    
    
}