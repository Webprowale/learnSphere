<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Lesson extends Migration
{
    public function up()
    {
        $this->forge->addField([
          'id'=>['type'=> 'INT', 'constraint'=>11, 'unsigned'=>true, 'auto_increment'=>true],
          'title' => ['type' => 'VARCHAR', 'constraint' => 255],
          'video' => ['type'=>'VARCHAR', 'constraint'=> 255],
          'course_id' => ['type'=> 'INT', 'constraint'=>11, 'unsigned'=>true],
          'created_at' => ['type' => 'DATETIME'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('course_id', 'course', 'id', 'CASCADE');
        $this->forge->createTable('lesson');
    }

    public function down()
    {
        $this->forge->dropTable('lesson');
    }
}
