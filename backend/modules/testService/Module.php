<?php
namespace backend\modules\testService;
use Yii;
use yii\web\ForbiddenHttpException;
/**
 * testService module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'backend\modules\testService\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
       if(!Yii::$app->user->can('analysisPost'))
       {
              throw new ForBiddenHttpException("您没有执行此操作的权限!");
       }


        // custom initialization code goes here
    }
}
