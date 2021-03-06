<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductCharacteristicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Характеристики товару';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-characteristic-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Characteristic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            'product_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
