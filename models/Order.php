<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property string $order_date
 * @property int $order_product_id
 * @property double $total_price
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $postcode
 * @property string $note
 *
 * @property OrderProduct[] $orderProducts
 * @property User $user
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['total_price', 'first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address', 'postcode'], 'required'],
            [['total_price'], 'number'],
            [['note'], 'string'],
            [['order_date', 'first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address', 'postcode', 'note'], 'safe'],
            [['first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address', 'postcode'], 'string', 'max' => 40],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_price' => 'Price',
            'user_id' => 'User ID',
            'order_date' => 'Order Date',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone Number',
            'country' => 'Country',
            'city' => 'City',
            'address' => 'Address',
            'postcode' => 'Postcode',
            'note' => 'Note'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }
}