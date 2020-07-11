<?php

    namespace app\modules\admin\controllers;

    use app\models\Article;
    use app\models\ArticleForm;

    use Yii;
    use yii\data\Pagination;
    use yii\filters\AccessControl;
    use yii\web\Controller;

    /**
     * Default controller for the `Article` module
     */
    class ArticleController extends Controller
    {


        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionIndex()
        {
            die("s");
        }

        public function actionView(){
            die("viea Action");
        }

    }
