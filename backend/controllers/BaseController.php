<?php

namespace backend\controllers;

use yii\web\Controller;
use backend\components\AccessControlBehavior;

class BaseController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControlBehavior::class,
                ],
            ]
        );
    }
}
