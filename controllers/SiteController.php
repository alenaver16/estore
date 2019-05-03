<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignUpForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'frontend';
        return $this->render('index');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionProducts()
    {
        $this->layout = 'frontend';

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'sort' => [
                'defaultOrder' => ['name' => SORT_DESC ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('products', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays product page.
     *
     * @return string
     */
    public function actionProduct($id)
    {
        $this->layout = 'frontend';
        $model = Product::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Page not found');
        }
        $relatedProducts = Product::find()->where(['category_id' => $model->category_id])
            ->andWhere(['<>', 'id', $id])
            ->orderBy(['id' => SORT_DESC])
            ->limit(6)->all();

        $recentlyProducts = Product::find()->where(['<>', 'id', $id])
            ->orderBy(['id' => SORT_DESC])
            ->limit(5)->all();

        $products = Product::find()->where(['<>', 'id', $id])
            ->orderBy(['rand()' => SORT_DESC])
            ->limit(4)->all();

        return $this->render('product', [
            'model' => $model,
            'related' => $relatedProducts,
            'recently' => $recentlyProducts,
            'products' => $products
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    /**
     * Sign up action.
     *
     * @return Response|string
     */
    public function actionSignup(){
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new SignUpForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $user = new User();
            $user->setAttributes($model->attributes);
            $user->role = 'client';
            $user->password = \Yii::$app->security->generatePasswordHash($model->password);
            $date = new \DateTime('now');
            $user->registration_date = $date->format('Y-m-d H:i:s');
            if($user->validate()) {
                if ($user->save()) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', compact('model'));
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
