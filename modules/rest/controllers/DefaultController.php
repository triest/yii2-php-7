<?php

    namespace app\modules\rest\controllers;

    use app\models\Article;
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
            die("44");
            // return $this->render('index');
        }

        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionView($id)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $id;
            // return $this->render('index');
        }

        public function actionCreate()
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return "s";
            // return $this->render('index');
        }

        public function actionUpdate($id)
        {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $review = Article::find()->where(['id' => $id])->one();
            $post = Yii::$app->request->get();

            $review->title=$post["title"];
            $review->description=$post["description"];
            if($review->save()){
                return $review;
            }

            return false;
        }

        public function actionDelete($id)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $review = Article::find()->where(['id' => $id])->one();
            if($review && $review->delete()){
                return true;
            }else{
                return false;
            }

        }
    }
