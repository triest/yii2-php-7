<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%users}}`.
     */
    class m200708_130703_create_users_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%user}}', [
                    'id' => $this->primaryKey(),
                    'username' => $this->string(),
                    'email' => $this->string()->defaultValue(null),
                    'password' => $this->string(),
                    'isAdmin' => $this->integer()->defaultValue(0),
                    'salt' => $this->string()->defaultValue(null)
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%users}}');
        }
    }
