<?php

use yii\db\Schema;
use yii\db\Migration;

class m150517_091128_invoice extends Migration
{

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }


        $this->createTable('{{%client}}', [
            'id' => Schema::TYPE_PK,
            'first_name' => Schema::TYPE_STRING . ' null default null',
            'last_name' => Schema::TYPE_STRING . ' null default null',
            'address' => Schema::TYPE_STRING . ' null default null',
            'email' => Schema::TYPE_STRING . ' null default null',
            'phone' => Schema::TYPE_STRING . ' null default null',
            'company' => Schema::TYPE_STRING . ' null default null',
        ], $tableOptions);
        $this->createTable('{{%invoice}}', [
            'id' => Schema::TYPE_PK,
            'client_id' => Schema::TYPE_INTEGER . ' not null',
            'name' => Schema::TYPE_STRING . ' not null',
        ], $tableOptions);
        $this->createTable('{{%invoice_item}}', [
            'id' => Schema::TYPE_PK,
            'invoice_id' => Schema::TYPE_INTEGER . ' not null',
            'name' => Schema::TYPE_STRING . ' not null',
            'sum' => Schema::TYPE_INTEGER . ' not null',
        ], $tableOptions);

        $this->addForeignKey('{{%invoice_client_id}}', '{{%invoice}}', 'client_id', '{{%client}}', 'id');
        $this->addForeignKey('{{%invoice_item_id}}', '{{%invoice_item}}', 'invoice_id', '{{%invoice}}', 'id');

    }
    
    public function safeDown()
    {
        $this->dropTable('{{%invoice_item}}');
        $this->dropTable('{{%invoice}}');
        $this->dropTable('{{%client}}');
    }

}
