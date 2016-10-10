<?php

use yii\db\Migration;

class m130524_201400_language_table extends Migration
{

    protected $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function safeUp()
    {
        $this->createTable('language', [
            'id' => $this->string(2)->notNull(),
            'is_default' => $this->boolean()->notNull()->defaultValue(FALSE),
                ], $this->tableOptions);

        $this->addPrimaryKey('pk_language', 'language', 'id');
        $this->createIndex('idx_default_language', 'language', 'is_default');
    }

    public function safeDown()
    {
        $this->dropTable('language');
    }

}
