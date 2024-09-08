<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AuthTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'firstname'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'lastname'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'email'    => ['type' => 'VARCHAR', 'constraint' => 255, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => [ 'type'=> 'ENUM', 'constraint'=> ['user', 'admin', 'instructor'], 'dafault'=>'user'],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME'],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('auth');
    }

    public function down()
    {
        //
    }
}
