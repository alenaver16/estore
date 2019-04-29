<?php

namespace app\controllers;

use app\models\ProductCharacteristic;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $productCharacteristic = new ProductCharacteristic();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveCharacteristic($model);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'characteristic' => $productCharacteristic
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ProductCharacteristic::deleteAll(['product_id' => $model->id]);
            $this->saveCharacteristic($model);
//            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('update', [
            'model' => $model
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
        return $this->redirect(['index']);
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
//            print_r($productCharacteristic->errors);
        }
    }
}
