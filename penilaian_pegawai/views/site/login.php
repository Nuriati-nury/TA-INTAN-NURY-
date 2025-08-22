<?php
use yii\helpers\Html;
?>

<div class="card">
    <div class="card-body login-card-body">
        <h3 class="login-box-msg">Login</h3>

        <?php $form = \yii\bootstrap4\ActiveForm::begin(['id' => 'login-form']) ?>

        <!-- Username -->
        <?= $form->field($model,'username', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '
                {input}
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <!-- Password + toggle -->
        <?= $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback'],
            'inputTemplate' => '
                {input}
                <div class="input-group-append">
                    <div class="input-group-text" id="toggle-password" style="cursor:pointer;">
                        <span class="fas fa-eye"></span>
                    </div>
                </div>',
            'template' => '{beginWrapper}{input}{error}{endWrapper}',
            'wrapperOptions' => ['class' => 'input-group mb-3']
        ])
            ->label(false)
            ->passwordInput([
                'placeholder' => $model->getAttributeLabel('password'),
                'id' => 'password-input'
            ]) ?>

        <div class="vertical-center">
            <div>
                <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>

        <?php \yii\bootstrap4\ActiveForm::end(); ?>

    </div>
    <!-- /.login-card-body -->
</div>

<?php
// JS Toggle Password
$this->registerJs("
    $('#toggle-password').on('click', function() {
        var input = $('#password-input');
        var icon = $(this).find('span');
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
