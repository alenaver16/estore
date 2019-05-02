<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property double $price
 * @property int $category_id
 *
 * @property Order[] $orders
 * @property Category $category
 * @property ProductCharacteristic[] $productCharacteristics
 * @property ProductImg[] $productImages
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'category_id'], 'required'],
            [['price'], 'number', 'max' => 1000000],
            [['category_id', 'sale_price'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['name'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'category_id' => 'Category',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCharacteristics()
    {
        return $this->hasMany(ProductCharacteristic::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImg::className(), ['product_id' => 'id']);
    }
}