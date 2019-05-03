<?php
/* @var $model app\models\Product */
/* @var $related app\models\Product */
/* @var $recently app\models\Product */

/* @var $products app\models\Product */

use \yii\helpers\Html;

?>
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shop</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-sidebar">
                    <h2 class="sidebar-title">Search Products</h2>
                    <form action="">
                        <input type="text" placeholder="Search products...">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <?php if ($products) { ?>
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        <?php /* @var $product app\models\Product */ ?>
                        <?php foreach ($products as $product) { ?>
                            <div class="thubmnail-recent">
                                <?php if ($product->mainImage) { ?>
                                    <img src="/images/<?= $product->mainImage->img ?>" class="recent-thumb" alt="">
                                <?php } else { ?>
                                    <img src="/images/noimage.png" class="recent-thumb" alt="">
                                <?php } ?>
                                <h2>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $product->id]) ?>">
                                        <?= Html::encode($product->name); ?></a></h2>
                                <div class="product-sidebar-price">
                                    <ins>$<?= Html::encode($model->price); ?></ins>
                                    <?php if ($model->sale_price) { ?>
                                        <del>$<?= Html::encode($model->sale_price); ?></del>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($recently) { ?>
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            <?php /* @var $recentlyItem app\models\Product */ ?>
                            <?php foreach ($recently as $recentlyItem) { ?>
                                <li>
                                    <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $recentlyItem->id]) ?>">
                                        <?= Html::encode($recentlyItem->name); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>

            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="product-breadcroumb">
                        <?= Html::a('Home', Yii::$app->urlManager->createUrl(['site/index'])); ?>
                        <?= Html::a(Html::encode($model->category->name), Yii::$app->urlManager->createUrl(['site/category', 'id' => $model->category_id])); ?>
                        <?= Html::a(Html::encode($model->name)); ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-images">
                                <div class="product-main-img">
                                    <?php if ($model->mainImage) { ?>
                                        <div class="img-container">
                                            <img src="/images/<?= $model->mainImage->img ?>" alt=""
                                                 class="main-product-img">
                                        </div>
                                    <?php } else { ?>
                                        <div class="img-container">
                                            <img src="/images/noimage.png" alt="" class="main-product-img">
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="product-gallery">
                                    <?php foreach ($model->productImages as $image) { ?>
                                        <img src="/images/<?= $image->img ?>" alt="<?= $model->name; ?>">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="product-inner">
                                <h2 class="product-name"><?= Html::encode($model->name); ?></h2>
                                <div class="product-inner-price">
                                    <ins>$<?= Html::encode($model->price); ?></ins>
                                    <?php if ($model->sale_price) { ?>
                                        <del>$<?= Html::encode($model->sale_price); ?></del>
                                    <?php } ?>
                                </div>

                                <form action="" class="cart">
                                    <div class="quantity">
                                        <input type="number" size="4" class="input-text qty text" title="Qty" value="1"
                                               name="quantity" min="1" step="1">
                                    </div>
                                    <button class="add_to_cart_button" type="submit">Add to cart</button>
                                </form>

                                <div class="product-inner-category">
                                    <p>
                                        Category: <?= Html::a(Html::encode($model->category->name), Yii::$app->urlManager->createUrl(['site/category', 'id' => $model->category_id])); ?>
                                        .
                                        Tags: <a href="">awesome</a>,
                                        <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>.
                                    </p>
                                </div>

                                <div role="tabpanel">
                                    <ul class="product-tab" role="tablist">
                                        <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                                                  role="tab" data-toggle="tab">Description</a>
                                        </li>
                                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab"
                                                                   data-toggle="tab">Reviews</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home">
                                            <h2>Product Characteristics</h2>
                                            <?php if ($model->productCharacteristics) { ?>
                                                <?php /* @var $characteristic app\models\ProductCharacteristic */ ?>
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Characteristic</th>
                                                        <th>Description</th>
                                                    </tr>
                                                    </thead>
                                                    <?php foreach ($model->productCharacteristics as $characteristic) { ?>
                                                        <tr>
                                                            <td><?= $characteristic->name; ?></td>
                                                            <td><?= $characteristic->description; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </table>
                                            <?php } ?>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile">
                                            <h2>Reviews</h2>
                                            <div class="submit-review">
                                                <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                <p><label for="email">Email</label> <input name="email" type="email">
                                                </p>
                                                <div class="rating-chooser">
                                                    <p>Your rating</p>

                                                    <div class="rating-wrap-post">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <p><label for="review">Your review</label> <textarea name="review" id=""
                                                                                                     cols="30"
                                                                                                     rows="10"></textarea>
                                                </p>
                                                <p><input type="submit" value="Submit"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php if ($related) { ?>
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                <?php /* @var $relatedItem app\models\Product */ ?>
                                <?php foreach ($related as $relatedItem) { ?>
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            <?php if ($relatedItem->mainImage) { ?>
                                                <div class="img-container">
                                                    <img src="/images/<?= $relatedItem->mainImage->img ?>" alt=""
                                                         class="main-product-img">
                                                </div>
                                            <?php } else { ?>
                                                <div class="img-container">
                                                    <img src="/images/noimage.png" alt="" class="main-product-img">
                                                </div>
                                            <?php } ?>
                                            <div class="product-hover">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/add-to-cart', 'id' => $relatedItem->id]) ?>"
                                                   class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>Add to
                                                    cart
                                                </a>
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $relatedItem->id]) ?>"
                                                   class="view-details-link"><i class="fa fa-link"></i> See details
                                                </a>
                                            </div>
                                        </div>

                                        <h2>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $relatedItem->id]) ?>">
                                                <?= Html::encode($relatedItem->name) ?>
                                            </a></h2>
                                        <div class="product-carousel-price">
                                            <ins>$<?= Html::encode($model->price); ?></ins>
                                            <?php if ($model->sale_price) { ?>
                                                <del>$<?= Html::encode($model->sale_price); ?></del>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>