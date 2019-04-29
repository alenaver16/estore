<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_characteristic".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $product_id
 *
 * @property Product $product
 */
class ProductCharacteristic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'product_id'], 'required'],
            [['description'], 'string'],
            [['product_id'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['name'], 'unique'],
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
            'name' => 'Name',
            'description' => 'Description',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
