<?php

namespace App\Models;

use CodeIgniter\Model;

class UserSettingsModel extends Model
{
    protected $table = 'user_settings';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = false; # No usar autoincremento ya que user_id es clave primaria
    protected $returnType = 'object'; # 'object' o 'array'
    protected $allowedFields = ['user_id', 'show_cover', 'show_name', 'show_author', 'show_genre', 'show_pages', 'show_rating', 'show_bin'];
    protected $useTimestamps = false; # No usar timestamps en inserciones y actualizaciones
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
