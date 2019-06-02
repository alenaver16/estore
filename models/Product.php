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
 * @property string $creation_date
 * @property string $edit_date
 * @property int $main_image_id
 * @property double $sale_price
 *
 * @property Order[] $orders
 * @property Category $category
 * @property ProductImg $mainImage
 * @property ProductCharacteristic[] $productCharacteristics
 * @property ProductImg[] $productImgs
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
            [['price', 'sale_price'], 'number', 'max' => 1000000],
            [['category_id', 'main_image_id'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['name'], 'unique'],
            [['creation_date', 'edit_date'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['main_image_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductImg::className(), 'targetAttribute' => ['main_image_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Назва',
            'price' => 'Ціна',
            'category_id' => 'Категорія',
            'creation_date' => 'Дата створення',
            'edit_date' => 'Дата редагування',
            'main_image_id' => 'Головне зображення',
            'sale_price' => 'Ціна зі знижкою',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMainImage()
    {
        return $this->hasOne(ProductImg::className(), ['id' => 'main_image_id']);
    }
}