<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $valueList backend\models\Value */

$this->title = 'Update Product: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

   <h1>Select Value</h1>

    <?= $this->render('_formPropertyValue', [
        'model' => $model,
        'list' => $valueList,
        'name' => 'title'
    ]) ?>

</div>
