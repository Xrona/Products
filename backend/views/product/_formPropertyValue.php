<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $name  backend\views\ */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, $name)->dropDownList($list); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
