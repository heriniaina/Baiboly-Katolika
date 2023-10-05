<?php 

namespace Baiboly\Models;
use Serasera\Base\Models\BaseModel;


class TokoModel extends BaseModel
{
    protected $table      = 'baiboly_v2_b_toko';
    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = ['id', 't_b_id', 't_toko', 't_and', 't_intro', 't_notes', 't_intro2' ];



}