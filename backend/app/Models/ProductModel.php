<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'id';

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    // Fields allowed for mass assignment
    protected $allowedFields = [
        'name',
        'slug',
        'category',
        'brand',
        'description',
        'condition',
        'price',
        'stock',
        'is_available',
        'inclusions',
        'main_image',
        'created_by'
    ];

    // Automates created_at and updated_at
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation rules (optional but recommended)
    protected $validationRules = [
        'name'         => 'required|min_length[2]',
        'slug'         => 'required|alpha_dash|min_length[2]|is_unique[products.slug,id,{id}]',
        'category'     => 'required',
        'price'        => 'decimal',
        'stock'        => 'integer',
        'is_available' => 'in_list[0,1]',
    ];
}
