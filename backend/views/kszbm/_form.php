<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SysNation;
use kartik\datetime\DateTimePicker;
use backend\libary\CommonFunction;
/* @var $this yii\web\View */
/* @var $model backend\models\SignKszbm */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
label{
    margin-right: 20px;
 }
</style>
<div class="sign-kszbm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_card')->textInput(['style'=>'max-width:500px']) ?>

    <?= $form->field($model, 'name')->textInput(['style'=>'max-width:500px']) ?>

    <?= $form->field($model, 'birth_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origin_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'minzu')->dropDownlist(SysNation::getList(),['prompt'=>'请选择民族','style'=>'max-width:500px']) ?>


    <?= $form->field($model, 'hukou_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hukou_type')->radioList(['农业'=>'农业','非农业'=>'非农业'],['style'=>'max-width:500px']) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'health')->radioList(['健康或良好'=>'健康或良好','一般或较弱'=>'一般或较弱','有慢性病'=>'有慢性病','有生理缺陷'=>'有生理缺陷','有残疾'=>'有残疾']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'if_pre_educate')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_sigle')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_alone')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_ls')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'zk_exam_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zk_score')->textInput() ?>

    <?= $form->field($model, 'zk_school')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'party_type')->radioList(['团员'=>'团员','非团员'=>'非团员']) ?>

    <?= $form->field($model, 'speciality')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'if_live')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_cload')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_en')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_help')->radioList(['1'=>'是','0'=>'否']) ?>

    <?= $form->field($model, 'if_uniform')->radioList(['1'=>'是','0'=>'否']) ?>

    <hr>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dad_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dad_nation')->dropDownlist(SysNation::getList(),['prompt'=>'请选择民族']) ?>

            <?php $form->field($model, 'dad_hukou')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dad_idcard')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dad_phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dad_company')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dad_duty')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'mom_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mom_nation')->dropDownlist(SysNation::getList(),['prompt'=>'请选择民族']) ?>

            <?php $form->field($model, 'mom_hukou')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mom_idcard')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mom_phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mom_company')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'mom_duty')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <hr>
    <div class="form-group">
        <?= Html::submitButton('提交报名表', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
