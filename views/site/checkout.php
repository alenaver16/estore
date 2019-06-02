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
                    <h2>Оформити замовлення</h2>
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
                    <h2 class="sidebar-title">Пошук товарів</h2>
                    <form action="search-product">
                        <input type="text" placeholder="Пошук товарів..." name="searchProduct">
                        <input type="submit" value="Search">
                    </form>
                </div>

                <?php if ($products) { ?>
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Товари</h2>
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
                        <h2 class="sidebar-title">Найновіші товари</h2>
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
                        <div class="woocommerce-info">Маєте акаунт? <a class="showlogin" data-toggle="collapse"
                                                                             href="#login-form-wrap"
                                                                             aria-expanded="false"
                                                                             aria-controls="login-form-wrap">Натиснуть щоб увійти</a>
                        </div>

                                                <form id="login-form-wrap" class="login collapse" method="post">
                                                    <p class="form-row form-row-first">
                                                        <label for="username">Ім'я користувача чи email <span class="required">*</span>
                                                        </label>
                                                        <input type="text" id="username" name="username" class="input-text">
                                                    </p>
                                                    <p class="form-row form-row-last">
                                                        <label for="password">Пароль <span class="required">*</span>
                                                        </label>
                                                        <input type="password" id="password" name="password" class="input-text">
                                                    </p>
                                                    <div class="clear"></div>


                                                    <p class="form-row">
                                                        <input type="submit" value="Login" name="login" class="button">
                                                        <label class="inline" for="rememberme"><input type="checkbox" value="forever"
                                                                                                      id="rememberme" name="rememberme">
                                                            Запам'ятати мене </label>
                                                    </p>
                                                    <p class="lost_password">
                                                        <a href="#">Забули пароль?</a>
                                                    </p>

                                                    <div class="clear"></div>
                                                </form>

                        <div class="woocommerce-info">Маєте промокод? <a class="showcoupon" data-toggle="collapse"
                                                                        href="#coupon-collapse-wrap"
                                                                        aria-expanded="false"
                                                                        aria-controls="coupon-collapse-wrap">Натисніть сюди, щоб ввести промокод</a>
                        </div>

                        <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                            <p class="form-row form-row-first">
                                <input type="text" value="" id="coupon_code" placeholder="Промокод"
                                       class="input-text" name="coupon_code">
                            </p>

                                                        <p class="form-row form-row-last">
                                                            <input type="submit" value="Промокод" name="apply_coupon" class="button">
                                                        </p>

                            <div class="clear"></div>
                        </form>

                        <form enctype="multipart/form-data" action="../site/checkout" class="checkout" method="post"
                              name="checkout">

                            <div id="customer_details" class="col2-set">
                                <div class="woocommerce-billing-fields">
                                    <h3>Деталі замовлення</h3>
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
                                        <p>Створіть обліковий запис, ввівши наведену нижче інформацію. Якщо ви вже маєте акаунт, будь ласка, увійдіть.</p>
                                        <p id="account_password_field" class="form-row validate-required">
                                            <label class="" for="account_password">Пароль <abbr
                                                        title="required" class="required">*</abbr>
                                            </label>
                                            <input type="password" value="" placeholder="Пароль"
                                                   id="account_password" name="account_password" class="input-text">
                                        </p>
                                        <div class="clear"></div>
                                    </div>

                                </div>
                            </div>

                            <h3 id="order_review_heading">Ваше замовлення</h3>
                            <div id="order_review" style="position: relative;">
                                <table class="shop_table">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Товари</th>
                                        <th class="product-total">Взагалі</th>
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
                                                <span class="amount">₴ <?= $cartItem->getPrice() ?></span></td>

                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    <tfoot>

                                    <tr class="cart-subtotal">
                                        <th>Загальна вартість товарів</th>
                                        <td><span class="amount">$<?= $cart->getTotalCost() ?></span>
                                        </td>
                                    </tr>

                                    <tr class="shipping">
                                        <th>Доставка</th>
                                        <td>

                                            Безкоштовна доставка
                                            <input type="hidden" class="shipping_method" value="free_shipping"
                                                   id="shipping_method_0" data-index="0" name="shipping_method[0]">
                                        </td>
                                    </tr>


                                    <tr class="order-total">
                                        <?= $form->field($orderForm, 'total_price', ['template' => '{input}'])->hiddenInput(['value' => $cart->getTotalCost()]); ?>
                                        <th>Загальна вартість замовлення</th>
                                        <td><strong><span class="amount">$<?= $cart->getTotalCost() ?></span></strong>
                                        </td>
                                    </tr>

                                    </tfoot>
                                </table>

                                <div id="payment">
                                    <ul class="payment_methods methods">
                                        <li class="payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                            <label for="payment_method_bacs">Оплата за реквізитами</label>
                                            <div class="payment_box payment_method_bacs">
                                                <p>Зробіть платіж безпосередньо на нашому банківському рахунку. Використовуйте свій ідентифікатор замовлення як посилання на оплату. Реквізити для оплати відправлені вам на елетронну пошту. Ваше замовлення не буде відправлено, доки кошти не буде очищено в нашому обліковому записі.</p>
                                            </div>
                                        </li>
                                        <li class="payment_method_paypal">
                                            <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">
                                            <label for="payment_method_paypal">Приват 24<img src="../images/privat.jpg" width="100" height="70">
                                            </label>
                                            <div style="display:none;" class="payment_box payment_method_paypal">
                                                <p>Розрахуйтеся за допомогою Приват 24.</p>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="form-row place-order">
                                        <input type="submit" data-value="Place order" value="Place order" id="place_order"
                                               class="button alt">
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <p class="sidebar-title">Ви не маєте жодного <a
                        href="<?= Yii::$app->urlManager->createUrl('../site/products') ?>">товару</a> у вашому <a
                        href="<?= Yii::$app->urlManager->createUrl('../cart/index') ?>">кошику</a>.<br>Будь ласка оберіть продукт для замовлення.</p>
        <?php } ?>
    </div>
</div>
</div>