<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddReservation extends Migration {

    protected $table = 'reservation';
    

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'dinertable_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'mum_diner' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false,
            ],
            'reservation_date' => [
                'type' => 'date',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable($this->table);

                            
    }

    public function down() {
        $db = \Config\Database::connect();
        if ($db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }

}
