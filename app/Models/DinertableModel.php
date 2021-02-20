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
            throw new Exception('Could not find table for specified ID');
        }

        return $table;
    }
    
	public function delete($id = null, bool $purge = false) {
            
            $reservations = new ReservationModel();
            $reservations->deleteByTableId($id);
            parent::delete($id, $purge);
            
    }
        
    }
