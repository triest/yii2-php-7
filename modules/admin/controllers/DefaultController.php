<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `Admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        die("s");
        return $this->render('index');
    }

    public function actionCreate()
    {
        die("s");
        return $this->render('index');
    }
}