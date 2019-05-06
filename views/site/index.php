<?php

use yii\helpers\Html;

?>
<div class="slider-area">
    <div class="zigzag-bottom"></div>
    <div id="slide-list" class="carousel carousel-fade slide" data-ride="carousel">

        <div class="slide-bulletz">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ol class="carousel-indicators slide-indicators">
                            <li data-target="#slide-list" data-slide-to="0" class="active"></li>
                            <li data-target="#slide-list" data-slide-to="1"></li>
                            <li data-target="#slide-list" data-slide-to="2"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="single-slide">
                    <div class="slide-bg slide-one"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>We are awesome</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur,
                                                dolorem, excepturi. Dolore aliquam quibusdam ut quae iure vero
                                                exercitationem ratione!</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi ab
                                                molestiae minus reiciendis! Pariatur ab rerum, sapiente ex nostrum
                                                laudantium.</p>
                                            <a href="" class="readmore">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide">
                    <div class="slide-bg slide-two"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>We are great</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                                                aspernatur, dolorum harum molestias tempora deserunt voluptas possimus
                                                quos eveniet, vitae voluptatem accusantium atque deleniti inventore.
                                                Enim quam placeat expedita! Quibusdam!</p>
                                            <a href="" class="readmore">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="single-slide">
                    <div class="slide-bg slide-three"></div>
                    <div class="slide-text-wrapper">
                        <div class="slide-text">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="slide-content">
                                            <h2>We are superb</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores,
                                                eius?</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti
                                                voluptates necessitatibus dicta recusandae quae amet nobis sapiente
                                                explicabo voluptatibus rerum nihil quas saepe, tempore error odio quam
                                                obcaecati suscipit sequi.</p>
                                            <a href="" class="readmore">Learn more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div> <!-- End slider area -->

<div class="promo-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-refresh"></i>
                    <p>30 Days return</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-truck"></i>
                    <p>Free shipping</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-lock"></i>
                    <p>Secure payments</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo">
                    <i class="fa fa-gift"></i>
                    <p>New products</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <?php if ($models) { ?>
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Latest Products</h2>
                        <div class="product-carousel">
                            <?php foreach ($models as $model) { ?>
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <?php if ($model->mainImage) { ?>
                                            <img src="/images/<?= $model->mainImage->img ?>" alt="">
                                        <?php } else { ?>
                                            <img src="/images/noimage.png" alt="">
                                        <?php } ?>
                                        <div class="product-hover">
                                            <a href="<?= Yii::$app->urlManager->createUrl(['cart/add', 'id' => $model->id]) ?>"
                                               class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Add to cart</a>
                                            <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $model->id]) ?>"
                                               class="view-details-link"><i class="fa fa-link"></i>
                                                See details</a>
                                        </div>
                                    </div>
                                    <h2><?= Html::a(Html::encode($model->name), Yii::$app->urlManager->createUrl(['site/product', 'id' => $model->id])); ?></h2>
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
                </div>
            <?php } ?>
        </div>
    </div>
</div> <!-- End main content area -->

<div class="brands-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brand-wrapper">
                    <h2 class="section-title">Brands</h2>
                    <div class="brand-list">
                        <img src="../img/services_logo__1.jpg" alt="">
                        <img src="../img/services_logo__2.jpg" alt="">
                        <img src="../img/services_logo__3.jpg" alt="">
                        <img src="../img/services_logo__4.jpg" alt="">
                        <img src="../img/services_logo__1.jpg" alt="">
                        <img src="../img/services_logo__2.jpg" alt="">
                        <img src="../img/services_logo__3.jpg" alt="">
                        <img src="../img/services_logo__4.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End brands area -->

<div class="product-widget-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top Sellers</h2>
                    <a href="<?= Yii::$app->urlManager->createUrl('site/products') ?>" class="wid-view-more">View
                        All</a>
                    <?php foreach ($productSellers as $model) { ?>
                        <div class="single-wid-product">
                            <?php if ($model->mainImage) { ?>
                                <img src="/images/<?= $model->mainImage->img ?>" alt="" class="product-thumb">
                            <?php } else { ?>
                                <img src="/images/noimage.png" alt="" class="product-thumb">
                            <?php } ?>
                            <h2><?= Html::a(Html::encode($model->name), Yii::$app->urlManager->createUrl(['site/product', 'id' => $model->id])); ?></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$<?= Html::encode($model->price); ?></ins>
                                <?php if ($model->sale_price) { ?>
                                    <del>$<?= Html::encode($model->sale_price); ?></del>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Recently Viewed</h2>
                    <a href="<?= Yii::$app->urlManager->createUrl('site/products') ?>" class="wid-view-more">View
                        All</a>
                    <?php foreach ($productView as $model) { ?>
                        <div class="single-wid-product">
                            <?php if ($model->mainImage) { ?>
                                <img src="/images/<?= $model->mainImage->img ?>" alt="" class="product-thumb">
                            <?php } else { ?>
                                <img src="/images/noimage.png" alt="" class="product-thumb">
                            <?php } ?>
                            <h2><?= Html::a(Html::encode($model->name), Yii::$app->urlManager->createUrl(['site/product', 'id' => $model->id])); ?></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$<?= Html::encode($model->price); ?></ins>
                                <?php if ($model->sale_price) { ?>
                                    <del>$<?= Html::encode($model->sale_price); ?></del>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-product-widget">
                    <h2 class="product-wid-title">Top New</h2>
                    <a href="<?= Yii::$app->urlManager->createUrl('site/products') ?>" class="wid-view-more">View
                        All</a>
                    <?php foreach ($productRecently as $model) { ?>
                        <div class="single-wid-product">
                            <?php if ($model->mainImage) { ?>
                                <img src="/images/<?= $model->mainImage->img ?>" alt="" class="product-thumb">
                            <?php } else { ?>
                                <img src="/images/noimage.png" alt="" class="product-thumb">
                            <?php } ?>
                            <h2><?= Html::a(Html::encode($model->name), Yii::$app->urlManager->createUrl(['site/product', 'id' => $model->id])); ?></h2>
                            <div class="product-wid-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product-wid-price">
                                <ins>$<?= Html::encode($model->price); ?></ins>
                                <?php if ($model->sale_price) { ?>
                                    <del>$<?= Html::encode($model->sale_price); ?></del>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>