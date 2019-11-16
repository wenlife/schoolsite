<?php
use yii\helpers\Url;
use common\models\Adminuser;
use yii\helpers\Html;
use backend\libary\CommonFunction;
use backend\modules\guest\models\UserTeacher;
use yii\helpers\ArrayHelper;
if(Yii::$app->user->isGuest){
    return $this->redirect(['site/login']);
}else{
    $username = Yii::$app->user->identity->username;           
    $teacher = UserTeacher::find()->where(['username'=>$username])->one();
    $thisTerm = (new \yii\db\Query())->from('teach_year_manage')
                                ->indexby('id')->orderby('end_date desc')->one();
    //计算当前周
    $all = ceil(ceil((strtotime($thisTerm['end_date'])-strtotime($thisTerm['start_date']))/86400)/7);
    $period = ceil(ceil((time()-strtotime($thisTerm['start_date']))/86400)/7);

}
$file = "img/seven.jpg";
?>
<div class="box box-primary">
  <div class="box-body box-profile">

    <img class="profile-user-img img-responsive img-circle" src="<?=$file?>" alt="User profile picture">
    <h3 class="profile-username text-center"><?=$teacher->name?></a></h3>
    <p class="text-muted text-center"><?=CommonFunction::getAllSubjects()[$teacher->subject]?>教师</p>
    <ul class="list-group list-group-unbordered">
      <li class="list-group-item">
        <b>本学期</b> <a class="pull-right"><?=ArrayHelper::getValue($thisTerm,'start_date')." 至 ".ArrayHelper::getValue($thisTerm,'end_date')?></a>
      </li>
      <li class="list-group-item">
        <b>现在是</b> <a class="pull-right">
          <span class="fa fa-star"></span>
          第<?=$period."/".$all?>周
          <span class="fa fa-star"></span>
        </a>
      </li>

    </ul>

    <a href="index.php?r=tcenter/cal" class="btn btn-primary btn-block"><b>查看校历</b></a>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->




