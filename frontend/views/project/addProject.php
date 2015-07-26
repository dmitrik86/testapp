<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Добавить новый проект';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'add-project-form']); ?>
                <?= $form->field($model, 'projectname')->label('Название проекта') ?>
                <?= Html::label('Ключевые слова') ?>
                <?= Html::textarea('keywords', '', ['class' => 'form-control', 'rows' => 10]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>