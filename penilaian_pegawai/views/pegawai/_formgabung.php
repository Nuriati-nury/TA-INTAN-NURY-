<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Pegawai $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pegawai-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'nama_pegawai')->textInput(['maxlength' => true]) ?>
    </diV>

     <div class="col-md-4">
    <?= $form->field($model, 'nip_baru')->textInput([
        'maxlength' => 18, 
        'minlength' => 18, 
        'pattern' => '\d{18}', 
        'title' => 'NIP baru harus terdiri dari 18 digit angka',
        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
    ]) ?>
</div>

<div class="col-md-4">
    <?= $form->field($model, 'nip_lama')->textInput([
        'maxlength' => 9, 
        'minlength' => 9, 
        'pattern' => '\d{9}', 
        'title' => 'NIP lama harus terdiri dari 9 digit angka',
        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
    ]) ?>
</div>
</div>


<div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'jabatan')->textInput(['maxlength' => true]) ?>
    </div>

     <div  class="col-md-4">
    <?= $form->field($modelUser, 'username')->textInput(['maxlength' => true]) ?>
    </div>

    <div  class="col-md-4">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    </div>
</div>


<div class="row">
    
  <div class="col-md-4">
    <?= $form->field($modelUser, 'password', [
        'template' => "{label}\n<div class='input-group'>
                          {input}
                          <span class='input-group-text' id='toggle-password' style='cursor:pointer;'>
                              <i class='fas fa-eye'></i>
                          </span>
                       </div>\n{error}"
    ])->passwordInput(['id' => 'password-input', 'maxlength' => true]) ?>
</div>

<?php
$this->registerJs("
    $('#toggle-password').on('click', function() {
        var input = $('#password-input');
        var icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });
");
?>

</div>
    
    <!-- <?= $form->field($modelUser, 'authKey')->textInput(['maxlength' => true]) ?> -->

    <!-- <?= $form->field($modelUser, 'accessToken')->textInput(['maxlength' => true]) ?> -->

<?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'Admin'): ?>


<div class="row">
    <div class="col-md-4">
    <?= $form->field($model, 'status')->dropDownList(
        ['Kepala' => 'Kepala', 'Pegawai' => 'Pegawai'],
        ['prompt' => 'Pilih Status'] // Opsi untuk placeholder di dropdown
    )->label('Status Pegawai') ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($modelUser, 'status')->dropDownList([10 => 'Aktif', 0 => 'Tidak Aktif'],
        ['prompt' => 'Pilih Status'] 
    )->label('Status User') ?>
    </div>

    <div class="col-md-4">
    <?= $form->field($modelUser, 'role')->dropDownList(['Admin' => 'Admin', 'User' => 'User'],
        ['prompt' => 'Pilih Role']
    )->label('Role') ?>
    </div>
</div>

<?php else: ?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'status')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'status_text')
            ->textInput(['value' => $model->status, 'readonly' => true])
            ->label('Status Pegawai') ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($modelUser, 'status')->hiddenInput()->label(false) ?>
        <?= $form->field($modelUser, 'status_text')
            ->textInput(['value' => $modelUser->status == 10 ? 'Aktif' : 'Tidak Aktif', 'readonly' => true])
            ->label('Status User') ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($modelUser, 'role')->hiddenInput()->label(false) ?>
        <?= $form->field($modelUser, 'role_text')
            ->textInput(['value' => $modelUser->role, 'readonly' => true])
            ->label('Role') ?>
    </div>
</div>
<?php endif; ?>





    <!-- <?= $form->field($modelUser, 'id_pegawai')->textInput() ?> -->

    <!-- <?= $form->field($modelUser, 'time_create')->textInput() ?> -->
<!--  -->
    <!-- <?= $form->field($modelUser, 'time_update')->textInput() ?> -->
    <br>
    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
