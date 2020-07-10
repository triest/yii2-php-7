<?php
    /**
     * Created by PhpStorm.
     * User: triest
     * Date: 09.07.2020
     * Time: 23:02
     */

    namespace app\modules\admin\controllers;

    use yii\web\Controller;

    class TestController extends Controller
    {
        /**
         * Renders the index view for the module
         * @return string
         */
        public function actionIndex()
        {
          //  die("s");
            return $this->render('index');
        }
    }