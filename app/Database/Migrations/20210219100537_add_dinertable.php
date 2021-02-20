<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDinertable extends Migration {

    protected $table = 'dinertable';
    

    public function up() {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'min_diner' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false,
            ],
            'max_diner' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable($this->table);

        $db = \Config\Database::connect();
        $builder = $db->table($this->table);
        $builder->insert([
            'name' => "Mesa 1",
            'min_diner' => "1",
            'max_diner' => "2"
        ]);
        
           $builder->insert([
            'name' => "Mesa 1",
            'min_diner' => "2",
            'max_diner' => "2"
        ]);
           $builder->insert([
            'name' => "Mesa 3",
            'min_diner' => "3",
            'max_diner' => "4"
        ]);
           $builder->insert([
            'name' => "Mesa 4",
            'min_diner' => "3",
            'max_diner' => "4"
        ]);
                            
    }

    public function down() {
        $db = \Config\Database::connect();
        if ($db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }

}
