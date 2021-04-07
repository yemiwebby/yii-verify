<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\VerifyUserForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Verify Phone Number';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please provide the token sent by SMS</p>

    <?php $form = ActiveForm::begin([
        'id' => 'verify-user-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'token')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Verify Me', ['class' => 'btn btn-primary', 'name' => 'verify-user-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>