<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pegawai $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>
    <div class="row">
    <di class="col-md-4">
    <?= $form->field($model, 'nama_pegawai')->textInput(['maxlength' => true]) ?>
    </div>

    <di class="col-md-4">
    <?= $form->field($model, 'nip_baru')->textInput(['maxlength' => true]) ?>
    </div>
    </div>

    <?= $form->field($model, 'nip_lama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>

    <div>
        <?= $form->field($model, 'status')->radioList(['Kepala' => 'Kepala', 'Pegawai' => 'Pegawai'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label('Status')?>
    </div>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <br>
    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
