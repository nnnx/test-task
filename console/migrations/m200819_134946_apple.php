<?php

use yii\db\Migration;

/**
 * Class m200819_134946_apple
 */
class m200819_134946_apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('apple', [
            'id' => $this->primaryKey(),
            'color' => $this->string(255)->notNull()->comment('Цвет'),
            'date_create' => $this->dateTime()->notNull()->comment('Дата появления'),
            'date_fall' => $this->dateTime()->comment('Дата появления'),
            'status' => $this->tinyInteger()->notNull()->comment('Статус'),
            'eaten' => $this->decimal(10, 2)->notNull()->defaultValue(0)->comment('Съедено, %'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200819_134946_apple cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200819_134946_apple cannot be reverted.\n";

        return false;
    }
    */
}
