<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;


$this->title = '选择任教教师';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin(['options'=>['class'=>'form-inline']]); ?>
                  <input name="term" class="hide" />
                  <input name="banji" class="hide" />
                  <input name="subject" class="hide" /> 
                  <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3">Password</label>
                     <?=Html::dropDownList('teacherid',null,$subjectteacher,['prompt' => '请选择题目类型','class'=>'form-control','style'=>'width:150px']);?>
                  </div>        
        <button type="submit" class="btn btn-primay">提交</button>


 <?php ActiveForm::end(); ?>