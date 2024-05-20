<?php

namespace backend\components;

use yii\base\Behavior;
use yii\web\Controller;
use yii\filters\AccessControl;

class AccessControlBehavior extends Behavior
{
    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction',
        ];
    }

    public function beforeAction($event)
    {
        $controller = $this->owner;
        $controller->attachBehavior('access', [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
            'denyCallback' => function ($rule, $action) {
                return Yii::$app->getResponse()->redirect(Yii::$app->user->loginUrl);
            },
        ]);
        return true;
    }
}
