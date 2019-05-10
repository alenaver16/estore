<?php
/* @var $this yii\web\View */
/* @var $cart \devanych\cart\Cart */
/* @var $item \devanych\cart\CartItem */

use yii\helpers\Html;
use yii\helpers\Url;

$cartItems = $cart->getItems();
?>

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Shopping Cart</h2>
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
                    <form action="search-product">
                        <input type="text" placeholder="Search products..." name="searchProduct">
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
                                    <ins>$<?= Html::encode($product->price); ?></ins>
                                    <?php if ($product->sale_price) { ?>
                                        <del>$<?= Html::encode($product->sale_price); ?></del>
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
                    <div class="woocommerce">
                        <?php if (!empty($cartItems)) { ?>
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                    <tr>
                                        <th class="product-remove">&nbsp;</th>
                                        <th class="product-thumbnail">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($cartItems as $item) { ?>
                                        <tr class="cart_item">
                                            <td class="product-remove">
                                                <a title="Remove this item" class="remove"
                                                   href="<?= Url::to(['cart/remove', 'id' => $item->getId()]) ?>">×</a>
                                            </td>

                                            <td class="product-thumbnail">
                                                <a href="<?= Url::to('@web/product/' . $item->getProduct()->id) ?>">
                                                    <img width="145" height="145" alt="poster_1_up"
                                                         class="shop_thumbnail"
                                                         src="/images/<?= $item->getProduct()->mainImage ? $item->getProduct()->mainImage->img : 'noimage.png' ?>">
                                                </a>
                                            </td>

                                            <td class="product-name">
                                                <a href="<?= Url::to('@web/product/' . $item->getProduct()->id) ?>"><?= $item->getProduct()->name ?></a>
                                            </td>

                                            <td class="product-price">
                                                <span class="amount">$<?= $item->getPrice() ?></span>
                                            </td>

                                            <td class="product-quantity">
                                                <div class="quantity buttons_added">
                                                    <input type="button" class="minus" value="-">
                                                    <input type="number" size="4" class="input-text qty text"
                                                           title="Qty" value="<?= $item->getQuantity() ?>" min="0"
                                                           step="1">
                                                    <input type="button" class="plus" value="+">
                                                </div>
                                            </td>

                                            <td class="product-subtotal">
                                                <span class="amount">$<?= $item->getCost() ?></span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <div class="coupon">
                                                <label for="coupon_code">Coupon:</label>
                                                <input type="text" placeholder="Coupon code" value="" id="coupon_code"
                                                       class="input-text" name="coupon_code">
                                                <input type="submit" value="Apply Coupon" name="apply_coupon"
                                                       class="button">
                                            </div>
                                            <input type="submit" value="Update Cart" name="update_cart" class="button">
                                            <a href="<?= Yii::$app->urlManager->createUrl('../site/checkout'); ?>" type="button"
                                               class="button">Proceed to Checkout</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                        <?php } ?>
                        <div class="cart-collaterals">

                            <?php if ($related) { ?>
                                <div class="cross-sells">
                                    <h2>You may be interested in...</h2>
                                    <ul class="products">
                                        <?php foreach ($related as $relatedItem) { ?>
                                            <li class="product">
                                                <a href="<?= Yii::$app->urlManager->createUrl(['site/product', 'id' => $relatedItem->id]) ?>">
                                                    <?php if ($relatedItem->mainImage) { ?>
                                                            <img src="/images/<?= $relatedItem->mainImage->img ?>" alt=""
                                                                 width="325" height="325"
                                                                 class="attachment-shop_catalog wp-post-image">
                                                    <?php } else { ?>
                                                            <img src="/images/noimage.png" alt=""
                                                                 width="325" height="325"
                                                                 class="attachment-shop_catalog wp-post-image">
                                                    <?php } ?>
                                                    <h3><?= $relatedItem->name ?></h3>
                                                    <span class="price"><span class="amount">$<?= $relatedItem->price ?></span></span>
                                                </a>

                                                <a class="add_to_cart_button" style="cursor: pointer" data-id="<?= $relatedItem->id ?>">Add to cart</a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            <?php } ?>

                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$<?= $cart->getTotalCost() ?></span></td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>Shipping and Handling</th>
                                        <td>Free Shipping</td>
                                    </tr>

                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">$<?= $cart->getTotalCost() ?></span></strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

