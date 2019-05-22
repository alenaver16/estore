<?php
namespace app\controllers;


use app\models\Order;
use app\models\OrderProduct;
use yii\db\Query;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Class ReportController
 * @package app\controllers
 */
class ReportController extends Controller
{
    public function beforeAction($action)
    {
        \Yii::$app->getView()->registerJsFile('@web/js/report.js', ['depends' => [\yii\web\YiiAsset::className()]]);
        return parent::beforeAction($action);
    }

    public function actionIndex(){
        $ordersByCategory = (new Query())
            ->select('AVG(o.total_price) as value, c.name as category')
            ->from('order o')
            ->join('JOIN', 'order_product op', 'op.order_id = o.id')
            ->join('JOIN', 'product p', 'op.product_id = p.id')
            ->join('JOIN', 'category c', 'p.category_id = c.id')
            ->groupBy('c.id')
            ->all();
        foreach ($ordersByCategory as &$item) {
            $color = sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255));
            $item['color'] = $color;
        }
        $ordersByCategory = json_encode($ordersByCategory);


        $ordersByDate = (new Query())
            ->select('sum(o.total_price) as price, count(1) as count, date(order_date) as date')
            ->from('order o')
            ->groupBy('date(order_date)')
            ->all();
        $ordersByDateArray = [];
        foreach ($ordersByDate as $item) {
            $ordersByDateArray['date'][] = date('d M',strtotime($item['date']));
            $ordersByDateArray['price'][] = $item['price']/1000;
            $ordersByDateArray['count'][] = $item['count'];
        }
        $ordersByDate = json_encode($ordersByDateArray);

        return $this->render('index', [
            'ordersByCategory' => $ordersByCategory,
            'ordersByDate' => $ordersByDate
        ]);
    }
}