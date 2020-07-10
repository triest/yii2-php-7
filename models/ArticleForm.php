<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 10.07.2020
     * Time: 16:09
     */

    namespace app\models;

    use app\models\Article;
    use Yii;
    use yii\base\Model;

    class ArticleForm extends Model
    {
        public $title;
        public $description;

        public function rules()
        {
            return [
                    [['title', 'description'], 'required'],

            ];
        }

        public function attributes()
        {
            return [
                    'id',
                    'title',
                    'description',
            ];
        }

        public function create()
        {
            if ($this->validate()) {
                $article = new  Article();
                $article->title = $this->title;
                $article->description = $this->description;
                $article->save(false);
                return true;
            } else {
                return false;
            }
        }

    }