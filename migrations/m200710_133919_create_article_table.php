<?php

    use yii\db\Migration;

    /**
     * Handles the creation of table `{{%article}}`.
     */
    class m200710_133919_create_article_table extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable('{{%article}}', [
                    'id' => $this->primaryKey(),
                    'title' => $this->string()->null()->defaultValue(null),
                    'description' => $this->text()->null()->defaultValue(null),
                    'updated_at' => $this->timestamp()->defaultValue(null),
                    'created_at' => $this->timestamp(),
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            $this->dropTable('{{%article}}');
        }
    }
