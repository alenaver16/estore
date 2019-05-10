<?php
/**
 * @var \app\models\OrderForm $orderForm ;
 * @var \app\models\OrderProductForm $orderProductForm
 * @var $cart \devanych\cart\Cart
 * @var $item \devanych\cart\CartItem
 */

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

$cart = Yii::$app->cart;
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

            <?php if ($cartItems){ ?>
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <div class="woocommerce-info">Returning customer? <a class="showlogin" data-toggle="collapse"
                                                                             href="#login-form-wrap"
                                                                             aria-expanded="false"
                                                                             aria-controls="login-form-wrap">Click here
                                to login</a>
                        </div>

                                                <form id="login-form-wrap" class="login collapse" method="post">


                                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you
                                                        are a new customer please proceed to the Billing &amp; Shipping section.</p>

                                                    <p class="form-row form-row-first">
                                                        <label for="username">Username or email <span class="required">*</span>
                                                        </label>
                                                        <input type="text" id="username" name="username" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-last">
                                                        <label for="password">Password <span class="required">*</span>
                                                        </label>
                                                        <input type="password" id="password" name="password" class="input-text">
                                                    </p>
                                                    <div class="clear"></div>


                                                    <p class="form-row">
                                                        <input type="submit" value="Login" name="login" class="button">
                                                        <label class="inline" for="rememberme"><input type="checkbox" value="forever"
                                                                                                      id="rememberme" name="rememberme">
                                                            Remember me </label>
                                                    </p>
                                                    <p class="lost_password">
                                                        <a href="#">Lost your password?</a>
                                                    </p>

                                                    <div class="clear"></div>
                                                </form>

                        <div class="woocommerce-info">Have a coupon? <a class="showcoupon" data-toggle="collapse"
                                                                        href="#coupon-collapse-wrap"
                                                                        aria-expanded="false"
                                                                        aria-controls="coupon-collapse-wrap">Click here
                                to enter your code</a>
                        </div>

                        <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                            <p class="form-row form-row-first">
                                <input type="text" value="" id="coupon_code" placeholder="Coupon code"
                                       class="input-text" name="coupon_code">
                            </p>

                                                        <p class="form-row form-row-last">
                                                            <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                                        </p>

                            <div class="clear"></div>
                        </form>

                        <form enctype="multipart/form-data" action="../site/checkout" class="checkout" method="post"
                              name="checkout">

                            <div id="customer_details" class="col2-set">
                                <div class="woocommerce-billing-fields">
                                    <h3>Billing Details</h3>
                                    <?php $form = ActiveForm::begin(); ?>
                                    <?= $form->field($orderForm, 'first_name'); ?>
                                    <?= $form->field($orderForm, 'last_name'); ?>
                                    <?= $form->field($orderForm, 'email'); ?>
                                    <?= $form->field($orderForm, 'phone'); ?>
                                    <?= $form->field($orderForm, 'country'); ?>
                                    <?= $form->field($orderForm, 'city')->textInput(['placeholder' => 'Town / City']); ?>
                                    <?= $form->field($orderForm, 'address')->textInput(['placeholder' => 'Street, apartment, suite, unit etc.']); ?>
                                    <?= $form->field($orderForm, 'postcode')->textInput(['placeholder' => 'Postcode / Zip']); ?>
                                    <?= $form->field($orderForm, 'note')->textarea(['rows' => "5"]); ?>

                                    <div class="create-account">
                                        <p>Create an account by entering the information below. If you are a
                                            returning customer please login at the top of the page.</p>
                                        <p id="account_password_field" class="form-row validate-required">
                                            <label class="" for="account_password">Account password <abbr
                                                        title="required" class="required">*</abbr>
                                            </label>
                                            <input type="password" value="" placeholder="Password"
                                                   id="account_password" name="account_password" class="input-text">
                                        </p>
                                        <div class="clear"></div>
                                    </div>

                                </div>
                            </div>

                            <h3 id="order_review_heading">Your order</h3>
                            <div id="order_review" style="position: relative;">
                                <table class="shop_table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($cartItems as $cartItem) { ?>
                                        <?= $form->field($orderProductForm, 'count', ['template' => '{input}'])->hiddenInput(['value' => $cartItem->getQuantity(), 'name' => 'OrderProductForm[' . $cartItem->getProduct()->id . '][count]']); ?>
                                        <?= $form->field($orderProductForm, 'price', ['template' => '{input}'])->hiddenInput(['value' => $cartItem->getPrice(), 'name' => 'OrderProductForm[' . $cartItem->getProduct()->id . '][price]']); ?>
                                        <?= $form->field($orderProductForm, 'product_id', ['template' => '{input}'])->hiddenInput(['value' => $cartItem->getProduct()->id, 'name' => 'OrderProductForm[' . $cartItem->getProduct()->id . '][product_id]']); ?>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                <?= $cartItem->getProduct()->name ?> <strong
                                                        class="product-quantity">× <?= $cartItem->getQuantity() ?></strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">$ <?= $cartItem->getPrice() ?></span></td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>

                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$<?= $cart->getTotalCost() ?></span>
                                        </td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>Shipping and Handling</th>
                                        <td>

                                            Free Shipping
                                            <input type="hidden" class="shipping_method" value="free_shipping"
                                                   id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                        </td>
                                    </tr>


                                    <tr class="order-total">
                                        <?= $form->field($orderForm, 'total_price', ['template' => '{input}'])->hiddenInput(['value' => $cart->getTotalCost()]); ?>
                                        <th>Order Total</th>
                                        <td><strong><span class="amount">$<?= $cart->getTotalCost() ?></span></strong>
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>

                                <p>*Make your payment directly into our bank account. Please use your Order ID as the
                                    payment reference. Your order won’t be shipped until the funds have cleared in our
                                    account.</p>

                            </div>
                            <input type="submit" data-value="Place order" value="Place order" id="place_order"
                                   class="button alt">
                            <?php ActiveForm::end(); ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <p class="sidebar-title">You don't have any <a
                        href="<?= Yii::$app->urlManager->createUrl('../site/products') ?>">products</a> in your <a
                        href="<?= Yii::$app->urlManager->createUrl('../cart/index') ?>">cart</a>.<br>Please choose some
                product to checkout.</p>
        <?php } ?>
    </div>
</div>
</div>