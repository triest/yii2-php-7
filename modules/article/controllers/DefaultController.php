<?php

    namespace app\modules\article\controllers;

    use app\models\Article;
    use app\models\ArticleForm;

    use Yii;
    use yii\data\Pagination;
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

            $query = Article::find()->orderBy('create_at', 'desc');
            $count = $query->count();
            $pageSize = 3;
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

            $models = $query->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();

            return $this->render('index', [
                    'articles' => $models,
                    'pagination' => $pagination,
            ]);
        }

        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionCreate()
        {
            //   die("s1");
            if (Yii::$app->user->isGuest) {
                return $this->redirect('/login');
            }

            $model = new ArticleForm();

            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                if ($user = $model->create()) {
                    return $this->actionIndex();
                }

            }
            return $this->render('create', ['model' => $model]);
        }

        public function actionView($id)
        {
            $article = Article::findOne($id);
            return $this->render('view', ['article' => $article]);
        }

        public function actionEdit($id)
        {

            $review = Article::find()->where(['id' => $id])->one();
            //если отправка формы
            $post = Yii::$app->request->post();

            if ($review->load($post) && $review->save()) {
                return $this->actionView($id);
            }

            if ($review == null) {
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            } else {
                return $this->render('edit', ['model' => $review]);
            }
        }

    }
