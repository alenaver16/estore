<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<div class="body">
    <div class="veen">
        <div class="login-btn splits">
            <p>Already an user?</p>
            <button class="active">Увійти</button>
        </div>
        <div class="rgstr-btn splits">
            <p>Вже маєте акаунт?</p>
            <button>Зареєструватися</button>
        </div>
        <div class="wrapper">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'action' => 'login-signup'
            ]); ?>
            <h3>Увійти</h3>
            <?= $form->field($login, 'username') ?>
            <?= $form->field($login, 'password')->passwordInput() ?>
            <div class="form-group">
                    <?= Html::submitButton('Увійти', ['class' => 'dark', 'name' => 'login-button']) ?>
            </div>
            <div class="form-group">
                <div>
                    <?= Html::a('Повернутися до магазину', Yii::$app->urlManager->createUrl('site/index'), ['class' => 'dark']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

            <?php $form = ActiveForm::begin([
                'id' => 'register',
                'action' => 'login-signup'
            ]) ?>
            <h3>Зареєструватися</h3>
            <?= $form->field($signup, 'username') ?>
            <?= $form->field($signup, 'email') ?>
            <?= $form->field($signup, 'password')->passwordInput() ?>
            <div class="form-group">
                <div>
                    <?= Html::submitButton('Зареєструватися', ['class' => 'dark', 'name' => 'register-button']) ?>
                </div>
            </div>
            <div class="form-group">
                <div>
                    <?= Html::a('Повернутися до магазину', Yii::$app->urlManager->createUrl('site/index'), ['class' => 'dark']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>