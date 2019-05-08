<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
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

    public function beforeAction($action)
    {
        $this->layout = 'frontend';
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = 'frontend';
        $model = Product::find()->limit(6)->orderBy(['id' => SORT_DESC])->all();
        $productSellers = Product::find()->limit(3)->orderBy(['name' => SORT_ASC])->all();
        $productView = Product::find()->limit(3)->orderBy(['id' => SORT_ASC])->all();
        $productRecently = Product::find()->limit(3)->orderBy(['id' => SORT_DESC])->all();
        return $this->render('index', [
            'models' => $model,
            'productSellers' => $productSellers,
            'productView' => $productView,
            'productRecently' => $productRecently
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionProducts()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('products', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategories()
    {
        $this->layout = 'frontend';

        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('categories', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCategory($id)
    {
        $this->layout = 'frontend';

        $categoryName = Category::findOne(['id' => $id])->name;
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->andWhere(['category_id'=>$id]),
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('category', [
            'dataProvider' => $dataProvider,
            'categoryName' => $categoryName
        ]);
    }

    /**
     * Displays product page.
     *
     * @return string
     */
    public function actionProduct($id)
    {
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

    public function actionCheckout(){
        $this->layout = 'frontend';
        return $this->render('checkout');
    }

    public function actionSearchProduct($searchProduct){
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->where(['like', 'name', $searchProduct]),
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

    public function actionLoginSignup()
    {
        $this->layout = 'empty';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login = new LoginForm();
        $signup = new SignUpForm();
        if($signup->load(\Yii::$app->request->post()) && $signup->validate()){
            $user = new User();
            $user->setAttributes($signup->attributes);
            $user->role = 'client';
            $user->password = \Yii::$app->security->generatePasswordHash($signup->password);
            $date = new \DateTime('now');
            $user->registration_date = $date->format('Y-m-d H:i:s');
            if($user->validate()) {
                if ($user->save()) {
                    return $this->goHome();
                }
            }
        }
        if ($login->load(Yii::$app->request->post()) && $login->login()) {
            return $this->goBack();
        }

        return $this->render('login-signup', ['login' => $login, 'signup' => $signup]);
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
        $this->layout = 'frontend';
        return $this->render('contact');
    }

    public function actionSendContactEmail($name, $email, $message){
        Yii::$app->mailer->compose('contact',  [
            'name' => $name,
            'email' => $email,
            'message' => $message
        ])
        ->setFrom('from@domain.com')
            ->setTo('alenavereshaka16@gmail.com')
            ->setSubject('Message subject')
            ->send();
    }
}
