<?php

namespace backend\modules\test;

use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\test\controllers';

    public function init()
    {
        parent::init();      
        if(!Yii::$app->user->can('testPost'))
       {
              throw new ForBiddenHttpException("您没有执行此操作的权限!");
       }

        // custom initialization code goes here
    }
}
