<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \app\models\ProductImg;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="product-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'price',
            [
                'label' => 'Category',
                'value' => $model->category->name
            ],
            [
                'label' => 'Group',
                'value' => $model->category->group->name
            ],
            [
                'label' => 'Characteristic',
                'value' => \Yii::$app->controller->getCharacteristic($model),
                'format' => 'raw'
            ],
            'creation_date',
            'edit_date',
            'sale_price',
        ],
    ]) ?>


    <?php if ($model->productImages) { ?>
        <h4>Images:</h4>
        <hr>
        <div class="product-images-block">
            <div class="responsiveGrid">
                <?php foreach ($model->productImages as $image) { ?>
                    <div class="tileData">
                        <div class="tile">
                            <div class="title"><?= $image->img ?></div>
                            <div class="back-img-container">
                                <img src="/images/<?= $image->img ?>" alt="<?= $model->name; ?>">
                                <span class="glyphicon glyphicon-eye-open js-set-main-img" data-img="<?= $image->id ?>"
                                      <?= ProductImg::isMainImg($image->id) ? 'style="opacity: 1; cursor: pointer;"' : 'style="opacity: 0.2; cursor: pointer;"'?>>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>