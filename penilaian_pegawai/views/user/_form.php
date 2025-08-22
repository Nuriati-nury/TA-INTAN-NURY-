<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'authKey')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($model, 'accessToken')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'role')->textInput(['maxlength' => true]) ?>

    <!-- <?= $form->field($model, 'id_pegawai')->textInput() ?> -->

    <!-- <?= $form->field($model, 'time_create')->textInput() ?> -->
<!--  -->
    <!-- <?= $form->field($model, 'time_update')->textInput() ?> -->
    <br>
    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
