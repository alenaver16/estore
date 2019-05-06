<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<div class="body">
    <div class="veen">
        <div class="login-btn splits">
            <p>Already an user?</p>
            <button class="active">Login</button>
        </div>
        <div class="rgstr-btn splits">
            <p>Don't have an account?</p>
            <button>Register</button>
        </div>
        <div class="wrapper">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'action' => 'login'
            ]); ?>
            <h3>Login</h3>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => false]) ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => false]) ?>
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>
            <div class="form-group">
                <div class="col-lg-offset-1 col-lg-11">
                    <?= Html::submitButton('Login', ['class' => 'dark', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?php $form = ActiveForm::begin([
                'id' => 'register',
                'action' => 'signup'
            ]) ?>
            <h3>Register</h3>
            <input type="text" name="username">
            <input type="text" name="first_name">
            <input type="text" name="last_name">
            <input type="text" name="email">
            <input type="text" name="phone">
            <input type="text" name="password">

            <div class="form-group">
                <div>
                    <?= Html::submitButton('Register', ['class' => 'dark', 'name' => 'register-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>