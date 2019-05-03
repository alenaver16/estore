<?php
/* @var $this yii\web\View */

/* @var $model app\models\Product */

use \yii\helpers\Html;

?>
<div class="col-md-3 col-sm-6">
    <div class="single-shop-product">
        <div class="product-upper">
            <?php if ($model->mainImage) { ?>
                <div class="img-container">
                    <img src="/images/<?= $model->mainImage->img ?>" alt="" class="main-product-img">
                </div>
            <?php } else { ?>
                <div class="img-container">
                    <img src="/images/noimage.png" alt="" class="main-product-img">
                </div>
            <?php } ?>
        </div>
        <h2><?= Html::a(Html::encode($model->name), Yii::$app->urlManager->createUrl(['site/product', 'id' => $model->id])); ?></h2>
        <div class="product-carousel-price">
            <ins>$<?= Html::encode($model->price); ?></ins>
            <?php if ($model->sale_price) { ?>
                <del>$<?= Html::encode($model->sale_price); ?></del>
            <?php } ?>
        </div>
        <div class="product-option-shop">
            <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow"
               href="/canvas/shop/?add-to-cart=70">Add to cart</a>
        </div>
    </div>
</div>