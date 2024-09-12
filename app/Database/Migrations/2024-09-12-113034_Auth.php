<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Auth extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email' => ['type' => 'VARCHAR', 'constraint'=> 255, 'unique' => true],
            'role' => ['type' => 'ENUM', 'constraint' => ['user', 'tutor', 'admin']],
            'firstname' => ['type' => 'VARCHAR', 'constraint' => 255],
            'lastname' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME'],
            'updated_at' => ['type' => 'DATETIME', 'null' => true]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('auth');
    }

    public function down()
    {
        $this->forge->dropTable('auth');
    }
}
