<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ReservationModel extends Model {

    protected $table = 'reservation';
    protected $allowedFields = [
        'dinertable_id',
        'name',
        'mum_diner',
        'reservation_date'
    ];

    public function findReservationById($id) {
        $table = $this
                ->asArray()
                ->where(['id' => $id])
                ->first();

        if (!$table) {
            throw new Exception('Could not find reservation for specified ID');
        }

        return $table;
    }

    //remove all reservation from a table
    public function deleteByTableId($dinertable_id) {

        $where = ['dinertable_id' => $dinertable_id];
        return $this->db->table($this->table)->where($where)->delete();
    }
    //Check availability to reservation a table
    public function CheckAvailability($date,$num){
        return $this->asArray()->db->select('');
    }
    
}
