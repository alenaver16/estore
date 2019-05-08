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
            <?= $form->field($login, 'username') ?>
            <?= $form->field($login, 'password')->passwordInput() ?>
            <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'dark', 'name' => 'login-button']) ?>
            </div>
            <div class="form-group">
                <div>
                    <?= Html::a('Back to the shop', Yii::$app->urlManager->createUrl('site/index'), ['class' => 'dark']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?php $form = ActiveForm::begin([
                'id' => 'register',
                'action' => 'signup'
            ]) ?>
            <h3>Register</h3>
            <?= $form->field($signup, 'username') ?>
            <?= $form->field($signup, 'email') ?>
            <?= $form->field($signup, 'password')->passwordInput() ?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Register', ['class' => 'dark', 'name' => 'register-button']) ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <?= Html::a('Back to the shop', Yii::$app->urlManager->createUrl('site/index'), ['class' => 'dark']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>