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
        $Reservation = $this
                ->asArray()
                ->where(['id' => $id])
                ->first();

        if (!$Reservation) {
            throw new Exception('Could not find reservation for specified ID');
        }

        return $Reservation;
    }

    //remove all reservation from a table
    public function deleteByTableId($dinertable_id) {

        $where = ['dinertable_id' => $dinertable_id];
        return $this->db->table($this->table)->where($where)->delete();
    }
    
    public function CheckAvailability($date, $num) {

        $sql = 'SELECT * FROM dinertable WHERE  id NOT IN (
          SELECT di.id FROM dinertable as di
          INNER JOIN reservation as re ON  di.id = re.dinertable_id
          WHERE re.reservation_date = :date:)
          AND  min_diner >= :num: and max_diner >= :num:';
        $where = ['date' => $date, 'num' => $num];
        $query = $this->db->query($sql, $where);
        return $query;
    }

}
