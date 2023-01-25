<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTeamTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'team_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'team_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'team_position' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'team_fb' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'team_ig' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'team_photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('team_id', true);
        $this->forge->createTable('team');
    }

    public function down()
    {
        $this->forge->dropTable('team');
    }
}
