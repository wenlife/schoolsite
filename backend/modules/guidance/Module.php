<?php

namespace backend\modules\guidance;
use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\guidance\controllers';

    public function init()
    {
        parent::init();

        if(!Yii::$app->user->can('guiPost'))
       {
              throw new ForBiddenHttpException("您没有执行此操作的权限!");
       }


        // custom initialization code goes here
    }
}
