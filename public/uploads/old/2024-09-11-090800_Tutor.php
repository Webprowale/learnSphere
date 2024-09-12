<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tutor extends Migration
{
    public function up()
    {
     $this->forge->addField([
      'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
       'num_course'=>['type'=>'INT', 'constraint'=>255 , 'null'=> true ],
       'auth_id' => ['type'=> 'INT', 'constraint'=>11, 'unsigned'=> true],
       'income'=>['type'=> 'DECIMAL', 'constraint'=>'10, 2', 'null'=> true],
       'created_at'=>['type'=>'DATETIME'],
       'updated_at'=>['type'=>'DATETIME', 'null'=>true]
     ]);
     $this->forge->addKey('id', true);
     $this->forge->addForeignKey('auth_id', 'auth', 'id',  'CASCADE', 'CASCADE');
     $this->forge->createTable('tutor');
    }

    public function down()
    {
        $this->forge->dropTable('tutor');
    }
}
