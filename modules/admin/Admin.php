<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;

/**
 * Admin module definition class
 */
class Admin extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                'access' => [
                        'class' => AccessControl::className(),
                        'denyCallback' => function ($rule, $action) {
                            throw new \yii\web\NotFoundHttpException();
                        },
                        'rules' => [
                                [
                                        'allow' => true,
                                        'matchCallback' => function ($rule, $action) {
                                            return Yii::$app->user->identity->isAdmin;
                                        }
                                ]
                        ]
                ]
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
