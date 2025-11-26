<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = \App\Entities\User::class;

    protected $allowedFields    = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password_hash',
        'type',
        'account_status',
        'email_activated',
        'newsletter',
        'gender',
        'profile_image',
    ];

    protected $useSoftDeletes   = true;

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $validationRules = [
        'email' => 'required|valid_email',
    ];

    protected $validationMessages = [];
}
