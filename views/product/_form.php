<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $productImages app\models\UploadImageForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map(Category::find()->all(), 'id', 'name')
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
    <?php if ($model->productImages) {
        foreach ($model->productImages as $image) { ?>
            <img src="/images/<?= $image->img ?>" alt="">
        <?php }
    } ?>
    <?= $form->field($imagesForm, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>