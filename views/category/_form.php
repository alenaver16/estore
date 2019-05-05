<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'group_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Group::find()->all(), 'id', 'name')
    ) ?>
    <?php if ($model->image) { ?>
        <hr>
        <div class="product-images-block">
            <div class="responsiveGrid">
                    <div class="tileData">
                        <div class="tile">
                            <div class="title"><?= $model->image ?></div>
                            <div class="back-img-container">
                                <img src="/images/<?= $model->image ?>" alt="<?= $model->name; ?>">
                                <span class="close js-delete-img" data-img="<?= $model->id ?>">&times;</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <?php } ?>
    <?= $form->field($imagesForm, 'imageFiles[]')->fileInput(['accept' => 'image/*']) ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
