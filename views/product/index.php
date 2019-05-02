<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('/assets/8d9c8530/yii.gridView.js', [
    'depends' => [
        \yii\web\YiiAsset::className()
    ]
]);
$this->registerJsFile('@web/js/backend/product.js', [
    'depends' => [
        \yii\web\YiiAsset::className()
    ]
]);
$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
        <input type="button" class="btn btn-danger" value="Delete selected" id="deleteSelectedButton" >
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        "id" => "productGrid",
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'name',
            'price',
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
            ],
            [
                'attribute' => 'Group',
                'value' => 'category.group.name',
            ],
//            [
//                'attribute' => 'Characteristic',
//                'value' => 'productCharacteristic.name',
//            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
