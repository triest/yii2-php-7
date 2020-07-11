<?php

use yii\db\Migration;

/**
 * Class m200711_080718_add_timestamp_to_article_table
 */
class m200711_080718_add_timestamp_to_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'create_at',  $this->timestamp()->notNull()->defaultExpression('NOW()'));
        $this->addColumn('article', 'update_at',  $this->timestamp()->null()->append('ON UPDATE NOW()'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200711_080718_add_timestamp_to_article_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200711_080718_add_timestamp_to_article_table cannot be reverted.\n";

        return false;
    }
    */
}
