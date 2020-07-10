<?php

    namespace app\modules\article\controllers;

    use app\models\Article;
    use app\models\ArticleForm;

    use Yii;
    use yii\filters\AccessControl;
    use yii\web\Controller;

    /**
     * Default controller for the `Article` module
     */
    class DefaultController extends Controller
    {



        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionIndex()
        {
            //   die("s1");
            $articles = $customer = Article::find()
                    ->all();

            return $this->render('index', [
                    'articles' => $articles,
            ]);
        }

        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionCreate()
        {
            //   die("s1");
            if(Yii::$app->user->isGuest){
                return $this->redirect('/login');
            }

            $model = new ArticleForm();

            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                if ($user = $model->create()) {
                    return $this->actionIndex();
                }
                die("s");
            }
            return $this->render('create', ['model' => $model]);
        }

        public function actionView($id)
        {

            $article = Article::findOne($id);
            return $this->render('view', ['article' => $article]);
        }

    }
