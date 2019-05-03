<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use app\models\Category;
use \app\models\ProductImg;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $productImages app\models\UploadImageForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'sale_price')->textInput() ?>
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

    <?php if ($model->productImages) { ?>
        <h4>Images:</h4>
        <hr>
        <div class="product-images-block">
            <div class="responsiveGrid">
                <?php foreach ($model->productImages as $image) { ?>
                    <div class="tileData">
                        <div class="tile">
                            <div class="title"><?= $image->img ?></div>
                            <div class="back-img-container">
                                <img src="/images/<?= $image->img ?>" alt="<?= $model->name; ?>">
                                <span class="close js-delete-img" data-img="<?= $image->id ?>">&times;</span>
                                <span class="glyphicon glyphicon-eye-open js-set-main-img" data-img="<?= $image->id ?>"
                                      <?= ProductImg::isMainImg($image->id) ? 'style="opacity: 1; cursor: pointer;"' : 'style="opacity: 0.2; cursor: pointer;"'?>>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?= $form->field($imagesForm, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>