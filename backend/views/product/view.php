<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $propertyValueList backend\models\ProductPropertyValue */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Add property', ['add-property', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
        ],
    ]) ?>


    <h2>Свойства</h2>
    <table class="table table-striped table-bordered detail-view">
        <?php foreach($propertyValueList as $key=>$value): ?>
        <tr>
            <th data-id="<?= $value['property_id'] ?>"><?= $value['prop'] ?></th>
            <td data-id="<?= $value['value_id'] ?>"><?= $value['val'] ?></td>
            <td>
                <a href="<?= Url::to(['property/view', 'id' => $value['property_id']]) ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update-value', 'id' => $value['product_id']]) ?>
                <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-product-property-value', 'id' => $value['product_id']], [
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><br>

   
</div>
