<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Customer */

$this->title = 'Проект';
?>
<div class="customer-view">

    <h1><?= Html::encode($this->title) ?></h1>

<?php /*
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
            'projectname',
            'status',
        ],
    ]) ?>
*/ ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'projectname',
            'status',
        ],
    ]) ?>

<?php /*
    <?= DetailView::widget([
        'model' => $model->keywords,
        'attributes' => [
            'keyword',
            'status',
        ],
    ]) ?>
*/ ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_keyword',
    ]); ?>

</div>
