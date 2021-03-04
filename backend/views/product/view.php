<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->id;
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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'titile',
            'description:ntext',
        ],
    ]) ?>


    <h2>Свойства</h2>
    <table class="table table-striped table-bordered detail-view">
        <?php foreach($dataProvider as $key=>$value): ?>
        <tr>
            <th data-id="<?= $value['property_id'] ?>"><?= $value['prop'] ?></th>
            <td data-id="<?= $value['value_id'] ?>"><?= $value['val'] ?></td>
            <td>
                <a href="<?= Url::to(['property/view/'.$value['property_id']]) ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                <a href=""><span class="glyphicon glyphicon-pencil"></span></a>
                <a href=""><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br><br>

   
</div>
