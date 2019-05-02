<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('/assets/8d9c8530/yii.gridView.js', [
    'depends' => [
        \yii\web\YiiAsset::className()
    ]
]);
$this->registerJsFile('@web/js/backend/category.js', [
    'depends' => [
        \yii\web\YiiAsset::className()
    ]
]);

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
        <input type="button" class="btn btn-danger" value="Delete selected" id="deleteSelectedButton" >
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        "id" => "categoryGrid",
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'name',
            [
                'attribute' => 'group_id',
                'value' => 'group.name',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
