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
        $dinertable = $this
                ->asArray()
                ->where(['id' => $id])
                ->first();

        if (!$dinertable) {
            throw new Exception('Could not find table for specified ID');
        }

        return $dinertable;
    }

    /* override delete for remove the reservations of dinnertable */

    public function delete($id = null, bool $purge = false) {
        $reservations = new ReservationModel();
        $reservations->deleteByTableId(intval ($id));
        parent::delete($id, $purge);
    }


}
