<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'category_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Category::find()->all(), 'id', 'name')
    ) ?>
    <?= $form->field($model, 'productCharacteristics')->widget(MultipleInput::className(), [
        'max' => 15,
        'columns' => [
            [
                'name' => 'name',
                'title' => 'Characteristic',
            ],
            [
                'name' => 'description',
                'title' => 'Description',
            ]
        ]
    ])->label(false); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
