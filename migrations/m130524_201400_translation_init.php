<?php

use yii\db\Migration;

class m130524_201400_translation_init extends Migration
{

    protected $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

    public function safeUp()
    {
        $this->createTable('language', [
            'code' => $this->string(10)->notNull(), //ISO-2 Code is considered ID, more space allocated to keep things flexible
            'is_default' => $this->boolean()->defaultValue(FALSE)->notNull(),
            'is_enabled' => $this->boolean()->defaultValue(TRUE)->notNull(),
            'system_name' => $this->string(255)->notNull(),
                //     'native_name' => $this->string(255), //todo
                ], $this->tableOptions);

        $this->addPrimaryKey('pk_language', 'language', 'code');

        $this->createTable('language_translation', [
            'id' => $this->primaryKey(), //Auto-Incremented ID
            'source_id' => $this->string(2)->notNull(),
            'language_id' => $this->string(2)->notNull(),
            'name' => $this->string(255)->notNull(),
                ], $this->tableOptions);
        $this->addForeignKey('fk_language_translation_source', 'language_translation', 'source_id', 'language', 'code', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_language_translation_translation', 'language_translation', 'language_id', 'language', 'code', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('language_translation');
        $this->dropTable('language');
    }

}
