<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Question extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'question' => ['type' => 'TEXT'],
            'answer' => ['type' => 'TEXT'],
            'quiz_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('quiz_id', 'quizzes', 'id', 'CASCADE');
        $this->forge->createTable('question');
    }

    public function down()
    {
        //
    }
}
