<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Enrollment extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'auth_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'course_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => false],
            'enrollment_date' => ['type' => 'DATE', 'null' => false],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'status' => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected']],
            'created_at' => ['type' => 'DATETIME']
            
        ]);

        $this->forge->addForeignKey('auth_id', 'auth', 'id',  'CASCADE',  'CASCADE');
        $this->forge->addForeignKey('course_id','course', 'id', 'CASCADE',  'CASCADE' );
        $this->forge->addKey('id', true);
        $this->forge->createTable('enrollment');
    }

    public function down()
    {
        $this->forge->dropTable('enrollment');
    }
}