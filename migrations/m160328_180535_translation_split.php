<?php

use humanized\clihelpers\components\Migration;

class m160328_180535_translation_split extends Migration
{

    public $dropped = ['is_enabled', 'is_default'];

    public function safeUp()
    {

        /**
         * Build new translation table
         */
        $columns = [
            'code' => $this->string(10),
        ];

        /**
         * Remove old columns & populate columns
         */
        $switch = FALSE;
        foreach ($this->dropped as $column) {
            $this->dropColumn('language', $column);
            $columns[$column] = $this->boolean()->defaultValue($switch)->notNull();
            $switch = !$switch;
        }


        $this->createTable('translation', $columns, $this->tableOptions);
        $this->addPrimaryKey('pk_translation', 'translation', 'code');
        $this->addForeignKey('fk_translation_language', 'translation', 'code', 'language', 'code', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropTable('translation');
        $switch = FALSE;
        foreach ($this->dropped as $column) {
            $this->addColumn('language', $column, $this->boolean()->defaultValue($switch)->notNull());
            $switch = !$switch;
        }
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
