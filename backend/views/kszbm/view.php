<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\libary\CommonFunction;
use backend\models\SysNation;
/* @var $this yii\web\View */
/* @var $model backend\models\SignKszbm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
//\yii\web\YiiAsset::register($this);
$nationList = SysNation::getList();
?>
<div class="sign-kszbm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>    
    <?= Html::a('录入新的市外考生', ['create'], ['class' => 'btn btn-success']) ?>
    <?php
        if($model->verify !=3)
        {
            echo Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
            ]);
            echo Html::a('修改报名信息', ['update', 'id' => $model->id], ['class' => 'btn btn-success']);
        }
        ?>
        <?= Html::a('添加缴费信息', ['verify', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<<返回查询页面', ['query'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('查看任务完成', ['index'], ['class' => 'btn btn-primary']) ?>

    </p>
    <div class="box box-primary">

    <!-- /.box-header -->
    <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            ['attribute'=>'verify','value'=>function($model){
                  $lqjd = CommonFunction::getLqjd();
                  return ArrayHelper::getValue($lqjd,$model->verify);
            }], 
            'name',
            'gender',
            'birth_place',
            'birth_date',
            'origin_place',
            ['attribute'=>'minzu','value'=>function($model){
                $nationList = SysNation::getList();
                return ArrayHelper::getValue($nationList,$model->minzu);
            }],
            'id_card',
            'hukou_place',
            'hukou_type',
            'height',
            'health',
            'address',
            ['attribute'=>'if_pre_educate','value'=>function($model){return $model->if_pre_educate?"是":"否";}],
            ['attribute'=>'if_sigle','value'=>function($model){return $model->if_sigle?"是":"否";}],
            ['attribute'=>'if_ls','value'=>function($model){return $model->if_ls?"是":"否";}],
            ['attribute'=>'if_alone','value'=>function($model){return $model->if_alone?"是":"否";}],

            'zk_exam_id',
            'zk_score',
            'zk_school',
            'party_type',
            'speciality:ntext',
            ['attribute'=>'if_live','value'=>function($model){return $model->if_live?"是":"否";}],
            ['attribute'=>'if_cload','value'=>function($model){return $model->if_cload?"是":"否";}],
            ['attribute'=>'if_en','value'=>function($model){return $model->if_en?"是":"否";}],
            ['attribute'=>'if_help','value'=>function($model){return $model->if_help?"是":"否";}],
            'dad_name',
            'dad_nation',
            //'dad_hukou',
            'dad_idcard',
            'dad_phone',
            'dad_company',
            'dad_duty',
            'mom_name',
            'mom_nation',
            //'mom_hukou',
            'mom_idcard',
            'mom_phone',
            'mom_company',
            'mom_duty',
            ['attribute'=>'if_uniform','value'=>function($model){return $model->if_uniform?"是":"否";}],
            'create_time',
            'update_time',
            
            'verify_time',
            'verify_admin',
            'verify_msg',
            'note:ntext',
        ],
    ]) ?>
</div>
</div>
</div>
