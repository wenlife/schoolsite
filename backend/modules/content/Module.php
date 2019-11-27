<?php
namespace backend\modules\content;

use Yii;
use yii\web\ForbiddenHttpException;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\content\controllers';
    //public $layout = false;

    public function init()
    {
        parent::init();
       if(!Yii::$app->user->can('contentPost'))
       {
              throw new ForBiddenHttpException("您没有执行此操作的权限!");
       }
    }

}
