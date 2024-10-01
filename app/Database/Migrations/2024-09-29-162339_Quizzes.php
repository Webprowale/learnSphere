<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Quizzes extends Migration
{
    public function up()
    {
      $this->forge->addField([
          'id'=>['type'=> 'INT', 'constraint'=>11, 'unsigned'=>true, 'auto_increment'=>true],
          'course_id' => ['type'=> 'INT', 'constraint'=>11, 'unsigned'=>true],
          'title' => ['type' => 'VARCHAR', 'constraint' => 255],
          'description' => ['type'=> 'TEXT'],
          'passing_score' => ['type'=> 'INT', 'constraint'=>3],
          'total_questions' => ['type'=> 'INT', 'constraint'=>3],
          'duration' => ['type'=> 'INT', 'constraint'=>3],
          'allow_multiple_choice' => ['type'=> 'BOOLEAN'],
          'randomize_questions' => ['type'=> 'BOOLEAN'],
          'created_at' => ['type' => 'DATETIME'],
      ]);
     $this->forge->addKey('id', true);
      $this->forge->addForeignKey('course_id', 'course', 'id', 'CASCADE');
      $this->forge->createTable('quizzes');
    }

    public function down()
    {
        //
    }
}
