<?php  
use yii\helpers\Html;  
  
/* @var $this yii\web\View */  
/* @var $user common\models\User */  
  
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $aa]);  
?>  
  
  
< a href="#" ><?php echo $resetLink ?></a>  