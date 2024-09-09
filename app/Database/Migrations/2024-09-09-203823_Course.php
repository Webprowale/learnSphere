<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Course extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'=> ['type'=> 'INT', 'constraint'=> 11, 'unsigned'=> true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'description' => ['type'=> 'TEXT'],
            'image' => ['type'=>'VARCHAR', 'constraint'=> 255],
            'category' => ['type'=> 'VARCHAR', 'constraint'=> 255],
            'price' => ['type'=> 'INT', 'constraint'=>20]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('course');
    }

    public function down()
    {
        
    }
}
