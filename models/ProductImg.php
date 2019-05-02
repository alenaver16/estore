<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_img".
 *
 * @property int $id
 * @property resource $img
 * @property int $product_id
 *
 * @property ProductImg $product
 * @property ProductImg[] $productImgs
 */
class ProductImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img', 'product_id'], 'required'],
            [['img'], 'string', 'max'=> 100],
            [['product_id'], 'integer'],
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
            'img' => 'Image',
            'product_id' => 'Product',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getProductImgs()
    {
        return $this->hasMany(ProductImg::className(), ['product_id' => 'id']);
    }

}
