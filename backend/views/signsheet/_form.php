<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use backend\models\SysNation;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sign-sheet-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'idcard')->textInput(['maxlength' => true,'id'=>'idcard'])->label("身份证号(最后一位为X请大写)") ?>
        <div class="row">
            <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?php $form->field($model, 'gender')->dropDownlist(['男'=>'男','女'=>'女'],['prompt'=>'请选择性别']) ?>
            <?php $form->field($model, 'old')->textInput() ?>
            <?= $form->field($model, 'minzu')->dropDownlist(SysNation::getList(),['prompt'=>'请选择民族']) ?>
            </div>
        <div class="col-md-6">
            <?= $form->field($model, 'imageFile')->fileInput(['id'=>'fileupload'])->label('请选择一张自己最近的免冠证件照上传') ?>
            <img src="img/boxed-bg.png" width="120" height="160" id="preview">
        </div>
    </div>
    <?php $form->field($model, 'birth')->textInput(['maxlength' => true,'id'=>'birth']) ?>

    <?= $form->field($model, 'graduate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cat1')->dropDownlist(['ty'=>'体育','yy'=>'音乐'],['prompt'=>'请选择专业类别','id'=>'cat1']) ?>

    <?= $form->field($model, 'cat2')->dropDownlist([],['id'=>'cat2']) ?>

    <?= $form->field($model, 'cat3')->textInput(['id'=>'cat3']) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'graduate_id')->textInput(['maxlength' => true])->label("中考报名号(12位，照片右下角)") ?>

    <?= $form->field($model, 'prizedetail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'score')->textInput()->label('最近一次文化模拟考试总分(11科折合后)') ?>

    <?= $form->field($model, 'parentname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentrelation')->dropDownlist(['dady'=>'父亲','mom'=>'母亲'],['prompt'=>'请选择监护人关系']) ?>

    <?= $form->field($model, 'parentphone')->textInput(['maxlength' => true]) ?>
    <div class="col-md-12">
    <img src="img/fukuan.jpg" width="150" style="margin-left: 20px">
    <?= $form->field($model, 'note')->textInput(['placeholder'=>'微信昵称+缴费时间'])->label('扫描二维码缴费后备注自己的微信昵称和缴费时间（手机端请长按上图识别）') ?>
</div>

    <?php echo $form->field($model, 'captcha')->widget(Captcha::className(), [
                'captchaAction' => 'signsheet/captcha',
                'options' => [
                    'class' => 'input-text size-L',
                    'style' => 'width:150px;',
                    'placeholder' => '输入验证码',
                ],
                'template' => '
                   {input}&nbsp;&nbsp;{image}
                   ',
                'imageOptions' => [
                    'style' => '',
                ]
            ])->label('<i class="Hui-iconfont">验证码</i>') ?>

    <div class="form-group">
        <?= Html::submitButton('提交报名申请', ['class' => 'btn btn-success','id'=>'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$this->registerJs(<<<JS

$('#fileupload').change(function(e){
var file = e.target.files || e.dataTransfer.files;
    if (file) {
        var reader = new FileReader();
        reader.onload = function () {
            $("#preview").attr("src", this.result);
        }
        reader.readAsDataURL(file[0]);
    }
});

JS,View::POS_LOAD);
?>
