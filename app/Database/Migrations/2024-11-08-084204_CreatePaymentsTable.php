<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'checkout_link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'external_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['PENDING', 'PAID', 'FAILED', 'EXPIRED'],
                'default' => 'PENDING',
                'null' => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('payments');
    }

    public function down()
    {
        //
    }
}
