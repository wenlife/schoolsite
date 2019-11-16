<?php
use yii\helpers\Url;
use common\models\user;
use yii\helpers\Html;
//$id = Yii::$app->user->identity->username;
if(Yii::$app->user->isGuest){
    return $this->redirect(['site/login']);
}else{
    $username = Yii::$app->user->identity->username;           
    $user = User::findByUsername($username);
}
if(file_exists("avatar/1/$username.png"))
{
  $file = "avatar/1/$username.png";
}else{
  if($user->gender==2)
  {
    $file = "avatar/1/female.png";
  }else{
    $file = "avatar/1/male.png";
  }
  
}

?>
<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-body box-profile">
    <p>
    <?= \hyii2\avatar\AvatarWidget::widget(['imageUrl'=>'uploads/avatar/'.$username.'/avatar_big.png']); ?>
    </p>
    <h3 class="profile-username text-center">王大锤</a></h3>

    <p class="text-muted text-center">演艺教师</p>

    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>本学期</b> <a class="pull-right">2018.9.1-2019.2.10</a>
      </li>
      <li class="list-group-item">
        <b>现在是</b> <a class="pull-right">
          <span class="fa fa-star"></span>
          第十周
          <span class="fa fa-star"></span>
        </a>
      </li>

    </ul>

    <a href="index.php?r=tcenter/cal" class="btn btn-primary btn-block"><b>查看校历</b></a>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->




