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
            'tutor_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'description' => ['type'=> 'TEXT'],
            'image' => ['type'=>'VARCHAR', 'constraint'=> 255],
            'category' => ['type'=> 'VARCHAR', 'constraint'=> 255],
            'price' => ['type'=> 'INT', 'constraint'=>20],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('tutor_id','tutor', 'id','CASCADE', 'CASCADE' );
        $this->forge->createTable('course');
    }

    
    public function down()
    {
        $this->forge->dropTable('course');
    }
}
