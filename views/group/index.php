<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerJsFile('/assets/8d9c8530/yii.gridView.js', [
    'depends' => [
        \yii\web\YiiAsset::className()
    ]
]);
$this->registerJsFile('@web/js/backend/group.js', [
    'depends' => [
        \yii\web\YiiAsset::className()
    ]
]);

$this->title = 'Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Group', ['create'], ['class' => 'btn btn-success']) ?>
        <input type="button" class="btn btn-danger" value="Delete selected" id="deleteSelectedButton" >
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        "id" => "groupGrid",
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'id',
            'name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
