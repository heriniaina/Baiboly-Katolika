<?php 

namespace Baiboly\Models;
use Serasera\Base\Models\BaseModel;

class TahiryModel extends BaseModel {

    protected $table = 'tahiry';
    protected $primaryKey = 'id';
    
    protected $useAutoIncrement = true;
    
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    
    protected $allowedFields = ['id', 'username', 'name', 'uri', 'note', 'created_at', 'updated_at'];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    
}