<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
//use backend\models\TransactionsumSearch;
use backend\models\SummarydaySearch;
use kartik\mpdf\Pdf;

class TranssummaryController extends Controller
{
  public $enableCsrfValidation = false;
	public function actionIndex()
    {
        $checkdate = "";
        $Sdate = "";
        $Edate = "";
        $income = 0;
        $expense = 0;
        $purch = 0;
    	$searchModel = new SummarydaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->isGet){
            $Sdate = date('d-m-Y',strtotime(Yii::$app->request->get('Startdate')));
            $Edate = date('d-m-Y',strtotime(Yii::$app->request->get('Enddate')));
            $checkdate = date('Y',strtotime(Yii::$app->request->get('Startdate')));
 //echo date_format($Sdate2,'d-m-Y');return;

          
            if(($Sdate != "" && $checkdate !='1970') || ($Edate != "" && $checkdate !='1970')){
               $dataProvider->query->where(['>=','created_at',$Sdate])->andFilterWhere(['<=','created_at',$Edate])->orderby(['created_at'=>SORT_DESC]);
               $income = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','created_at',$Sdate],['<=','created_at',$Edate]])->sum('sale_amount');
               $purch = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','created_at',$Sdate],['<=','created_at',$Edate]])->sum('purchase_amount');
               $expense = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','created_at',$Sdate],['<=','created_at',$Edate]])->sum('expense_amount');
            }else{
               $income = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('sale_amount');
               $purch = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('purchase_amount');
               $expense = \backend\models\SummarydaySearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('expense_amount');
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Sdate' => $Sdate,
            'Edate' => $Edate,
            'income' => $income,
            'expense' => $expense,
            'purch' => $purch,
        ]);
	}
  
  public function actionShowreport(){
    $product_group = '';
    $product = '';
    $warehouse = '';
    if(Yii::$app->request->isPost){
      $product_group = Yii::$app->request->post('product_group');
      $product = Yii::$app->request->post('product');
      $warehouse = Yii::$app->request->post('warehouse');
    }
   // $model = \common\models\VProductSum::find()->select(['v_product_sum.product_code','v_product_sum.name','t1.total_qty','t1.total_amount'])->innerJoin('v_product_sum_all t1','v_product_sum.id=t1.id')->distinct()->orderby(['v_product_sum.id'=>SORT_ASC])->all();
   
    $model = \common\models\VProductSumAll::find()->orderby(['id'=>SORT_ASC])->where(['like','product_code',$product])->andFilterWhere(['like','category_id',$product_group])->all(); // group by code
    $model_wh = \common\models\VProductSum::find()->select(['warhouse_name'])->distinct()->where(['like','warehouse_id',$warehouse])->all(); // select distinct warehouse
    $model2 = \common\models\VProductSum::find()->where(['like','product_code',$product])->andFilterWhere(['like','category_id',$product_group])->andFilterWhere(['like','warehouse_id',$warehouse])->all(); // sum all warehouse
    $model_sumall = \common\models\VProductSumAll::find()->orderby(['id'=>SORT_DESC])->all(); // ยอดรวม
    //print_r($model);return;
    return $this->render('_test',
                        [
                        'model'=>$model,
                        'model2'=>$model2,
                        'model_wh'=>$model_wh,
                        'model_sumall'=>$model_sumall,
                        'group' => $product_group,
                        'product' => $product,
                        'warehouse' => $warehouse,
                        ]);
       //  $from_date = '';
       //  $to_date = '';

       //  $from_date = date('d-m-Y',strtotime(Yii::$app->request->get('from_date')));
       //  $to_date = date('d-m-Y',strtotime(Yii::$app->request->get('to_date')));
         
       // // $sql = "SELECT * FROM view_issue where created_at >=".$from_date." and created_at <=".$to_date;
       // $sql = "SELECT * FROM view_issue";
       //  $qury = Yii::$app->db->createCommand($sql);
       //  $modellist = $qury->queryAll();

       //  $pdf = new Pdf([
       //          'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
       //          'format' => Pdf::FORMAT_A4, 
       //          'orientation' => Pdf::ORIENT_LANDSCAPE,
       //          'destination' => Pdf::DEST_BROWSER, 
       //          'content' => $this->renderPartial('_report',[
       //              'list'=>$modellist,  
       //              'from_date'=> $from_date,
       //              'to_date' => $to_date,
       //              ]),
       //          //'content' => "nira",
       //          'cssFile' => '@backend/web/css/pdf.css',
       //          'options' => [
       //              'title' => 'รายงานใบเบิกเคมี',
       //              'subject' => ''
       //          ],
       //          'methods' => [
       //             // 'SetHeader' => ['Generated By: Krajee Pdf Component||Generated On: ' . date("r")],
       //             // 'SetFooter' => ['|Page {PAGENO}|'],
       //          ]
       //      ]);
       //       return $pdf->render();
    }
	
}