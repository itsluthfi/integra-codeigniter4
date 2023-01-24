<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSliderTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'slider_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slider_title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
            'slider_image' => [
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
        $this->forge->addKey('slider_id', true);
        $this->forge->createTable('slider');
    }

    public function down()
    {
        $this->forge->dropTable('slider');
    }
}
