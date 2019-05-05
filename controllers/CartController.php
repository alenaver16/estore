<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use app\models\Product;

class CartController extends Controller
{
    /**
     * @var \devanych\cart\Cart $cart
     */
    private $cart;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->cart = Yii::$app->cart;
    }

    public function actionIndex()
    {
        $this->layout = 'frontend';
        $recentlyProducts = Product::find()
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)->all();

        $products = Product::find()
            ->orderBy(['rand()' => SORT_DESC])
            ->limit(4)->all();

        $relatedProducts = Product::find()
            ->orderBy(['name' => SORT_DESC])
            ->limit(2)->all();

        return $this->render('index', [
            'cart' => $this->cart,
            'recently' => $recentlyProducts,
            'products' => $products,
            'related' => $relatedProducts
        ]);
    }

    public function actionAdd($id = null , $qty = 1)
    {
        if(!$id){
            $id = Yii::$app->request->post('id');
        }
        try {
            $product = $this->getProduct($id);
            $quantity = $this->getQuantity($qty, 10);
            if ($item = $this->cart->getItem($product->id)) {
                $this->cart->plus($item->getId(), $quantity);
            } else {
                $this->cart->add($product, $quantity);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionChange($id, $qty = 1)
    {
        try {
            $product = $this->getProduct($id);
            $quantity = $this->getQuantity($qty, $product->quantity);
            if ($item = $this->cart->getItem($product->id)) {
                $this->cart->change($item->getId(), $quantity);
            }
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionRemove($id)
    {
        try {
            $product = $this->getProduct($id);
            $this->cart->remove($product->id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionClear()
    {
        $this->cart->clear();
        return $this->redirect(['index']);
    }

    /**
     * @param integer $id
     * @return Product the loaded model
     * @throws \DomainException if the product cannot be found
     */
    private function getProduct($id)
    {
        if (($product = Product::findOne((int)$id)) !== null) {
            return $product;
        }
        throw new \DomainException('Товар не найден');
    }

    /**
     * @param integer $qty
     * @param integer $maxQty
     * @return integer
     * @throws \DomainException if the product cannot be found
     */
    private function getQuantity($qty, $maxQty)
    {
        $quantity = (int)$qty > 0 ? (int)$qty : 1;
        if ($quantity > $maxQty) {
            throw new \DomainException('Товара в наличии всего ' . Html::encode($maxQty) . ' шт.');
        }
        return $quantity;
    }
}