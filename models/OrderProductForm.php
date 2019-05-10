<?php

namespace app\models;

use Yii;
use yii\base\Model;

class OrderProductForm extends Model
{
    public $count;
    public $price;
    public $product_id;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'product_id'], 'integer'],
            [['price', 'product_id'], 'required'],
            [['price'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Count',
            'price' => 'Price',
            'product_id' => 'Product ID',
        ];
    }
}