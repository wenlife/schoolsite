<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
//use backend\controllers\action\CaptchaAction;
use backend\models\SysNation;
use kartik\datetime\DateTimePicker;
use backend\libary\CommonFunction;
/* @var $this yii\web\View */
/* @var $model backend\models\SignSheet */
/* @var $form yii\widgets\ActiveForm */
$arrCat1 = CommonFunction::getCat11();
$arrcat_ty = json_encode(CommonFunction::getCat21());
$arrcat_yy = json_encode(CommonFunction::getCat22());
$arrcat_tj = json_encode(CommonFunction::getCat31());
?>
<style type="text/css">
    .score{
        width:100px;
    }
</style>

<div class="sign-sheet-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($model, 'idcard')->textInput(['maxlength' => true,'id'=>'idcard'])->label("身份证号(最后一位为X请大写)") ?>
        <div class="row">
            <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'minzu')->dropDownlist(SysNation::getList(),['prompt'=>'请选择民族']) ?>
            <?= $form->field($model, 'graduate')->textInput(['maxlength' => true]) ?>
            </div>
        <div class="col-md-6">
            <?= $form->field($model, 'imageFile')->fileInput(['id'=>'fileupload'])->label('请依据样片选择一张自己的证件照上传 ') ?>
            <img src="img/boxed-bg.png" width="120" height="160" id="preview">
             <img src="img/example.jpg" width="120" height="160" id="preview" style="margin-left: 10px">
        </div>
    </div>



    <?= $form->field($model, 'cat1')->dropDownlist($arrCat1,['prompt'=>'请选择专业类别','id'=>'cat1']) ?>

    <?= $form->field($model, 'cat2')->dropDownlist([],['id'=>'cat2']) ?>

    <?= $form->field($model, 'cat3')->dropDownlist([],['id'=>'cat3'])?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'graduate_id')->textInput(['maxlength' => true])->label("中考报名号(12位，照片右下角)") ?>

    <?= $form->field($model, 'prizedetail')->textarea(['rows' => 6]) ?>
    <div class="col-md-12">
        <p><b>最近一次文化模拟考试11科目的成绩</b></p>
    </div>
    <table class="table table-bordered">
    <tr>
    <th><?= $form->field($model,'yw')->textInput(['class'=>"score"])->label("语文120"); ?></th>
    <th><?= $form->field($model,'sx')->textInput(['class'=>"score"])->label("数学120"); ?></th>
    <th><?= $form->field($model,'yy')->textInput(['class'=>"score"])->label("英语120"); ?></th>
    <tr>
    <tr>
    <th><?= $form->field($model,'wl')->textInput(['class'=>"score"])->label("物理100"); ?></th>
    <th><?= $form->field($model,'hx')->textInput(['class'=>"score"])->label("化学100"); ?></th>
    <th><?= $form->field($model,'sw')->textInput(['class'=>"score"])->label("生物100"); ?></th>
    <tr>
    <tr>
    <th><?= $form->field($model,'zz')->textInput(['class'=>"score"])->label("政治100"); ?></th>
    <th><?= $form->field($model,'ls')->textInput(['class'=>"score"])->label("历史100"); ?></th>
    <th><?= $form->field($model,'dl')->textInput(['class'=>"score"])->label("地理100"); ?></th>
    <tr>
    <tr>
    <th><?= $form->field($model,'sy')->textInput(['class'=>"score"])->label("实验  30"); ?></th>
    <th><?= $form->field($model,'ty')->textInput(['class'=>"score"])->label("体育  80"); ?></th>
    </tr>
    </table>
    <?php // $form->field($model, 'score')->textInput(['readonly'=>'readonly'])->label('折后后(自动生成，不用填写)') 
    ?>
    <?= $form->field($model, 'parentname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parentrelation')->dropDownlist(['dady'=>'父亲','mom'=>'母亲'],['prompt'=>'请选择监护人关系']) ?>
    <?= $form->field($model, 'parentphone')->textInput(['maxlength' => true]) ?>
    <div class="row">
     <div class="col-md-12"><p>如未缴纳报名费，请使用微信扫描下图二维码缴费(手机端请长按下图识别），并一定<b class="text-danger">记录并填写缴费微信账号昵称和时间</b></p></div>
    <div class="col-md-3">
    <img src="img/fukuan.jpg" width="150" style="margin-left: 20px">
    </div>
    <div class="col-md-6">
    <?= $form->field($model, 'payacount')->textInput(['placeholder'=>'缴费微信昵称'])->label('微信账号昵称备注') ?>
    <?= $form->field($model, 'paytime')->textInput(['placeholder'=>'缴费时间','id'=>'ss1','data-inputmask'=>"'mask': '9999-99-99 99:99'"])->label("精确到分：格式为： 2020-07-11 12:31");
    ?>
    </div>
    </div>

    <?php echo $form->field($model, 'captcha')->widget(Captcha::className(), [
                'captchaAction' => 'signsheet/captcha',
                'options' => [
                    'class' => 'input-text size-L',
                    'style' => 'width:150px;',
                    'placeholder' => '输入验证码',
                ],
                'template' => '{input}&nbsp;&nbsp;{image}',
                'imageOptions' => [
                    'title'=>'换一个',
                    'alt'=>'换一个',
                    'onclick' => 'this.src=this.src+"&c="+Math.random();',
                ]
            ])->label('<i class="Hui-iconfont">验证码</i>') ?>

    <div class="form-group">
        <?= Html::submitButton('提交报名申请', ['class' => 'btn btn-success','id'=>'submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$va1 = 'ss';
$this->registerJsFile('specialcontent\inputmask\inputmask.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJsFile('specialcontent\inputmask\inputmask.extensions.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJsFile('specialcontent\inputmask\inputmask.numeric.extensions.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJsFile('specialcontent\inputmask\jquery.inputmask.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
$this->registerJsFile('specialcontent\inputmask\jquery.inputmask.bundle.js',
      ['depends' => [\backend\assets\AppAsset::className()]]);
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

function options(json,item,msg)
{
    $(item).html("");
    $(item).append("<option value>"+msg+"</option>")
    for(var title in json){
       // alert(item +"=>"+json[item]);
       $(item).append("<option value='"+title+"'>"+json[title]+"</option>");
       
    }

}

    

if($('#cat1').val()=== 'ty'){
    $('.field-cat2').show();
    options({$arrcat_ty},"select#cat2","请选择第二专业类别");
    $("select#cat2").val('{$model->cat2}');
}
if($('#cat1').val() === 'yy'){
    $('.field-cat2').show();
    options({$arrcat_yy},"select#cat2","请选择第二专业类别");
    $("select#cat2").val('{$model->cat2}');
}

$('.field-cat3').hide();
if($('#cat2').val() === '田径'){
    $('.field-cat3').show();
    options({$arrcat_tj},"select#cat3","请选择第三专业类别");
    $("select#cat3").val('{$model->cat3}');
}
$('#cat1').change(function(){
    $('.field-cat2').hide();
    $('.field-cat3').hide();
    $('#cat2').html('');
    $('#cat3').html('');
    if(this.value === 'ty'){
        $('.field-cat2').show();
        options({$arrcat_ty},"select#cat2","请选择第二专业类别");
    }
    if(this.value === 'yy'){
        $('.field-cat2').show();
        options({$arrcat_yy},"select#cat2","请选择第二专业类别");
    }
    if(this.value === 'ms'){
        //alert('ms');
    }
});
$('#cat2').change(function(){
   $('.field-cat3').hide();
   $('select#cat3').html('');
   $('select#cat3').removeAttr('required');
   if(this.value === '田径')
   {
        $('.field-cat3').show();
        $('select#cat3').attr('required','required');
        options({$arrcat_tj},"select#cat3","请选择第三专业类别");
        $("select#cat3").val('{$model->cat2}');

   }
});

$('#idcard').blur(function(){
    s = this.value;
    year = s.substring(6,10);
    month = s.substring(10,12)
    day = s.substring(12,14);
    //alert(year+'-'+month+'-'+day);
    $('#birth').val(year+'-'+month+'-'+day);
});



$("#ss1").inputmask("datetime", {
    inputFormat: "dd/mm/yyyy",
    outputFormat: "mm-yyyy-dd",
    inputEventOnly: true,
    clearIncomplete: true
});

$('#signsheet-captcha-image').trigger('click');
$('.score').change(function(){
    sc = $('#signsheet-score')
    val1 = sc.val();    
    if(val1)
        sc.val(Number(val1)+Number(this.value));  
    else
        sc.val(this.value);  
});

JS,View::POS_LOAD);
?>
