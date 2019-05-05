<?php
/* @var $this yii\web\View */

/* @var $model app\models\Category */

use \yii\helpers\Html;

?>
<div class="col-md-3 col-sm-6">
    <div class="single-shop-product">
        <div class="product-upper">
            <?php if ($model->image) { ?>
                <div class="img-container">
                    <img src="/images/<?= $model->image ?>" alt="" class="main-product-img">
                </div>
            <?php } else { ?>
                <div class="img-container">
                    <img src="/images/noimage.png" alt="" class="main-product-img">
                </div>
            <?php } ?>
        </div>
        <h2><?= Html::a(Html::encode($model->name), Yii::$app->urlManager->createUrl(['site/category', 'id' => $model->id])); ?></h2>
    </div>
</div>