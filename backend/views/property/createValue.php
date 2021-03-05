<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */

$this->title = 'Create Value for this Property';
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
