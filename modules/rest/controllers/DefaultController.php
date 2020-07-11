<?php

    namespace app\modules\rest\controllers;

    use app\models\Article;
    use app\models\ArticleForm;
    use Yii;
    use yii\web\BadRequestHttpException;
    use yii\web\Controller;

    /**
     * Default controller for the `rest` module
     */
    class DefaultController extends Controller
    {
        public function behaviors()
        {
            return [
                    [
                            'class' => \yii\ filters\ ContentNegotiator::className(),

                            'formats' => [
                                    'application/json' => \yii\ web\ Response::FORMAT_JSON,
                            ],
                    ],
            ];
        }

        public function beforeAction($action)
        {
            if ($action->id == 'Create' || 'Update') {
                Yii::$app->request->enableCsrfValidation = false;
            }
            try {
                return parent::beforeAction($action);
            } catch (BadRequestHttpException $e) {

            }
        }

        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionIndex()
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
             $articles=Article::find()->orderBy('create_at', 'desc')->all();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $articles;
        }

        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionView($id)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $article= Article::findOne($id);
            if($article){
               return $article;
            }else{
                return Yii::$app->response->statusCode = 403;
            }
        }

        public function actionCreate()
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if (Yii::$app->request->isPost) {
                $post = Yii::$app->request->post();
                $article=new Article();
                $article->title=$post["title"];
                $article->description=$post["description"];
                if($article->save()){
                   return Yii::$app->response->statusCode = 201;
                }else{
                   return Yii::$app->response->statusCode = 400;
                }
            }
            return Yii::$app->response->statusCode = 400;
        }

        public function actionUpdate($id)
        {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $review = Article::find()->where(['id' => $id])->one();
            if(!$review){
                return  Yii::$app->response->statusCode = 404;
            }
            $post = Yii::$app->request->get();

            $review->title=$post["title"];
            $review->description=$post["description"];
            if($review->save()){
                Yii::$app->response->statusCode = 204;
                return $review;
            }

            return  Yii::$app->response->statusCode = 400;
        }

        public function actionDelete($id)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $review = Article::find()->where(['id' => $id])->one();
            if($review && $review->delete()){
                Yii::$app->response->statusCode = 204;
            }elseif (!$review){
                Yii::$app->response->statusCode = 404;
            }else{
                Yii::$app->response->statusCode = 400;
            }

        }
    }
