<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="property-view">

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
        <?= Html::a('New Value', ['newValue', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
        ],
    ]) ?>

    <h3>Значения</h3>
    <table class="table table-striped table-bordered detail-view">
        <?php 
            $valueList = ArrayHelper::getValue($valueList, '0.values');
            foreach($valueList as $key => $value): 
        ?>
        <tr>
            <td  ><?= $value['title']; ?></td>
            <td>
                <a href="" id="<?= $value['id'] ?>"><span class="glyphicon glyphicon-trash"></span></a>
                <a href="" id="<?= $value['id'] ?>"><span class="glyphicon glyphicon-pencil"></span></a>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
</div>
