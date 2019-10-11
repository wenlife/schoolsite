<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Teachsetting */

$this->title = 'Create Teachsetting';
$this->params['breadcrumbs'][] = ['label' => 'Teachsettings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachsetting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
