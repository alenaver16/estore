<?php

namespace app\controllers;

use app\models\Product;
use app\models\UploadImageForm;
use Yii;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
        \Yii::$app->getView()->registerJsFile('@web/js/backend/category.js', ['depends' => [\yii\web\YiiAsset::className()]]);
        return parent::beforeAction($action);
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        $imagesForm = new UploadImageForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveImage($model);
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'imagesForm' => $imagesForm
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $imagesForm = new UploadImageForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveImage($model);
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'imagesForm' => $imagesForm
        ]);
    }

    public function actionDeleteSelectedItems()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $itemsForDelete = Yii::$app->request->post('items');
        if ($itemsForDelete) {
            Product::updateAll(['category_id' => Category::TYPE_OTHER], ['category_id' => $itemsForDelete]);
            Category::deleteAll(['id' => $itemsForDelete]);
            return true;
        }
        return false;
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Product::updateAll(['category_id' => Category::TYPE_OTHER], ['category_id' => $id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function saveImage($model){
        $imagesForm = new UploadImageForm();
        $imagesForm->imageFiles = UploadedFile::getInstances($imagesForm, 'imageFiles');
        if ($imagesForm->imageFiles && $imagesForm->upload()) {
            foreach ($imagesForm->imageFiles as $imageFile) {
                $model->image = $imageFile->name;
                if ($model->validate()) {
                    $model->save();
                }
            }
        }
    }

    public function actionDeleteImage()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $categoryId = Yii::$app->request->post('categoryId');
        if ($categoryId) {
            Category::updateAll(['image' => ''], ['id' => $categoryId]);
            return true;
        }
        return false;
    }
}
