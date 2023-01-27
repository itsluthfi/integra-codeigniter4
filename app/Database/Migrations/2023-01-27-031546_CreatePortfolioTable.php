<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePortfolioTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'portfolio_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'portfolio_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'portfolio_slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'category_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'portfolio_client' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'portfolio_date' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'description' => [
                'type'       => 'TEXT',
            ],
            'portfolio_image' => [
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
        $this->forge->addKey('portfolio_id', true);
        $this->forge->createTable('portfolio');
    }

    public function down()
    {
        $this->forge->dropTable('portfolio');
    }
}
