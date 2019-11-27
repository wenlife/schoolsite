<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use backend\libary\CommonFunction;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员与教师';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">

    </div>
    <!-- /.box-header -->
<div class="box-body">
<div class="adminuser-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          //  'id',
            'username',
            'name',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
             'email:email',
             ['attribute'=>'type','value'=>function($model){
                 $type = CommonFunction::getTeacherType();
                 return ArrayHelper::getValue($type,$model->type);
             }],
              ['attribute'=>'status','value'=>function($model){
                 $status = [0=>'禁用',10=>'激活'];
                 return ArrayHelper::getValue($status,$model->status);
             }],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>'操作',
              'template'=>'{resetpwd}&nbsp{update} &nbsp {privilege}&nbsp{delete}',
              'buttons'=>[
                'resetpwd'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-lock"></span',$url,['title'=>'重置密码']);
  
                },
                'privilege'=>function($url,$model,$key){
                    return Html::a('<span class="glyphicon glyphicon-user"></span',$url,['title'=>'权限设置']);
                },
              ],
              //'headerOptions'=>['width'=>'180']
            ],
        ],
    ]); ?>

</div>
</div>

