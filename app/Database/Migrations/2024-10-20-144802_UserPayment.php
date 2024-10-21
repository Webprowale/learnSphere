<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPayment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'course_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'ref' => ['type' => 'VARCHAR', 'constraint'=> 255, 'unique'=>true],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'success', 'failed']],
            'created_at' => ['type' => 'DATETIME']
        ]);
         $this->forge->addPrimaryKey('id');
         $this->forge->addForeignKey('user_id', 'auth', 'id',  'CASCADE');
         $this->forge->addForeignKey('course_id', 'course', 'id', 'CASCADE');
         $this->forge->createTable('user_payment');
    }

    public function down()
    {
        $this->forge->dropTable('user_payment');
    }
}
