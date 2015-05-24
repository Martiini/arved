<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoice */
/* @var $form ActiveForm */
?>
<div class="invoice-create">

    <h1>Create invoice</h1>

    <br />
    <br />
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'client_id')->dropDownList($clients) ?>
        <?= $form->field($model, 'name') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- invoice-create -->
