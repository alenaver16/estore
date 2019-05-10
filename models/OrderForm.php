<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignUpForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class OrderForm extends Model
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $country;
    public $city;
    public $address;
    public $postcode;
    public $note;



    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address', 'postcode', 'total_price'], 'required'],
            [['first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address', 'postcode', 'note', 'total_price'], 'safe'],
            [['email'], 'email'],
            [['total_price'], 'number'],
            [['first_name', 'last_name', 'email', 'phone', 'country', 'city', 'address', 'postcode'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 100],
            [['phone', 'role'], 'string', 'max' => 20],
            [['username'], 'unique', 'targetClass' => User::className()],
            [['email'], 'unique', 'targetClass' => User::className()],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Count',
            'price' => 'Price',
            'product_id' => 'Product ID',
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


}