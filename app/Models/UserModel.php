<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true; # db takes care of it
    protected $returnType = 'object'; # 'object' or 'array'
    protected $useSoftDeletes = false; # true if you expect to recover data
    # Fields that can be set during save, insert, or update methods
    protected $allowedFields = ['name', 'email', 'password', 'role', 'image'];
    protected $useTimestamps = false; # no timestamps on inserts and updates
    # Do not use validations rules (for the time being...)
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function authenticate($email, $password)
    {
        $user = $this->where('email', $email)->first();
        if ($user && password_verify($password, $user->password))
            return $user;
        return FALSE;
    }
}
