<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
    <?php
        echo $form->field($characteristic, 'characteristic')->widget(MultipleInput::className(), [
            'max' => 2,
            //'min'               => 1, // should be at least 2 rows
            //'allowEmptyList'    => false,
            //'enableGuessTitle'  => true,
            //'addButtonPosition' => MultipleInput::POS_HEADER, // show add button in the header
            'columns' => [
                [
                    'name'  => 'name',
                    'title' => 'Водители',
                ],
//                [
//                    'name'  => 'driver_id',
//                    'type'  => 'dropDownList',
//                    'title' => 'Водители',
//                    'options' => ['label' => false],
//                    'items' => [
//                        'prompt' => 'пожалуйста, выберите водителя',
//                        ArrayHelper::map(app\models\Drivers::find()->all(), 'id', 'name')
//                    ]
//                ],
//                [
//                    'name'  => 'distance',
//                    'title' => 'Дистанция водителя',
//                    //'enableError' => true,
//                    'options' => [
//                    'class' => 'input-priority'
//                    ]
//                ]
            ]
        ])
        ->label(false);
        ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
