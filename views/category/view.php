<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">
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
            [
                'label' => 'Group',
                'value' => $model->group->name
            ],
        ],
    ]) ?>
    <?php if ($model->image) { ?>
        <hr>
        <div class="product-images-block">
            <div class="responsiveGrid">
                    <div class="tileData">
                        <div class="tile">
                            <div class="title"><?= $model->image ?></div>
                            <div class="back-img-container">
                                <img src="/images/<?= $model->image ?>" alt="<?= $model->name; ?>">
                                <span class="close js-delete-img" data-img="<?= $model->id ?>">&times;</span>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <?php } ?>
</div>
