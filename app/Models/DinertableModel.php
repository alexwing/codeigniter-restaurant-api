<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class DinertableModel extends Model {

    protected $table = 'dinertable';
    protected $allowedFields = [
        'name',
        'min_diner',
        'max_diner'
    ];

    public function findDinertableById($id) {
        $table = $this
                ->asArray()
                ->where(['id' => $id])
                ->first();

        if (!$table) {
            throw new Exception('Could not find client for specified ID');
        }

        return $table;
    }

}
