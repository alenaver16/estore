<?php

namespace app\controllers;

use app\models\ProductCharacteristic;
use app\models\ProductImg;
use app\models\UploadImageForm;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        \Yii::$app->getView()->registerJsFile('@web/js/backend/product.js', ['depends' => [\yii\web\YiiAsset::className()]]);
        return parent::beforeAction($action);
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $imagesForm = new UploadImageForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                $this->saveCharacteristic($model);
                $this->saveImage($model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'imagesForm' => $imagesForm
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagesForm = new UploadImageForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->save();
                ProductCharacteristic::deleteAll(['product_id' => $model->id]);
                $this->saveCharacteristic($model);
                $this->saveImage($model);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'imagesForm' => $imagesForm
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        ProductCharacteristic::deleteAll(['product_id' => $id]);
        ProductImg::deleteAll(['product_id' => $id]);
        return $this->redirect(['index']);
    }
    public function actionDeleteSelectedItems()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $itemsForDelete = Yii::$app->request->post('items');
        if ($itemsForDelete) {
            Product::deleteAll(['id' => $itemsForDelete]);
            ProductCharacteristic::deleteAll(['product_id' => $itemsForDelete]);
            ProductImg::deleteAll(['product_id' => $itemsForDelete]);
            return true;
        }
        return false;
    }

    public function actionDeleteImage()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $imgId = Yii::$app->request->post('imgId');
        if ($imgId) {
            ProductImg::deleteAll(['id' => $imgId]);
            return true;
        }
        return false;
    }

    public function actionSetMainImage()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $imgId = Yii::$app->request->post('imgId');
        if ($imgId) {
            ProductImg::deleteAll(['id' => $imgId]);
            return true;
        }
        return false;
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getCharacteristic($model)
    {
        $res = '';
        foreach ($model->productCharacteristics as $characteristic) {
            $res .= '<p>' . $characteristic->name . ' : ' . $characteristic->description . '</p>';
        }
        return $res ? $res : '<p>No characteristic</p>';
    }

    public function saveCharacteristic($model)
    {
        $request = (Yii::$app->request->post());
        $characteristicData = $request['Product']['productCharacteristics'];
        foreach ($characteristicData as $characteristic) {
            $productCharacteristic = new ProductCharacteristic();
            $productCharacteristic->product_id = $model->id;
            $productCharacteristic->name = $characteristic['name'];
            $productCharacteristic->description = $characteristic['description'];
            if ($productCharacteristic->validate()) {
                $productCharacteristic->save();
            }
        }
    }

    public function saveImage($model){
        $imagesForm = new UploadImageForm();
        $imagesForm->imageFiles = UploadedFile::getInstances($imagesForm, 'imageFiles');
        if ($imagesForm->imageFiles && $imagesForm->upload()) {
            foreach ($imagesForm->imageFiles as $imageFile) {
                $productImage = new ProductImg();
                $productImage->product_id = $model->id;
                $productImage->img = $imageFile->name;
                if ($productImage->validate()) {
                    $productImage->save();
                }
            }
        }
    }
}
