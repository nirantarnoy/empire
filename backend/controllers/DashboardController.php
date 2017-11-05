<?php

namespace backend\controllers;

use Yii;
use backend\models\Brand;
use backend\models\BrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ProductSearch;

use backend\models\Sale;
use common\models\ViewBestSaller;
use common\models\ViewBalanceAmount;

class DashboardController extends Controller
{
	public function actionIndex(){
		$sdate = '';
        $edate = '';
		$model_sum_sale = Sale::find()->sum('sale_amount');
		$searchModel = new ProductSearch();
        $model_under_stock = $searchModel->search(Yii::$app->request->queryParams);
		$model_under_stock->query->where(['<=','qty','min_qty']);

        
        $model_best = ViewBestSaller::find()->limit(10)->orderby(['sale_qty'=>SORT_DESC])->all();
        $model_balance = ViewBalanceAmount::find()->sum('balance_amount');
  		$model_inventory = ViewBalanceAmount::find()->sum('qty');

		return $this->render('index',[
			'model_sum_sale'=> $model_sum_sale,
			'model_under_stock'=> $model_under_stock,
			'model_best' => $model_best,
			'model_balance' => $model_balance,
			'model_inventory' => $model_inventory,
			'Sdate' => $sdate,
            'Edate' => $edate,
		]);
	}

}