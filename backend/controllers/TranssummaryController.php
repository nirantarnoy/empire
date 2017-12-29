<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
//use backend\models\TransactionsumSearch;
use backend\models\SummarydaySearch;
use backend\models\SumdaybyempSearch;
use kartik\mpdf\Pdf;
date_default_timezone_set('Asia/Bangkok');
class TranssummaryController extends Controller
{
  public $enableCsrfValidation = false;
	public function actionIndex()
    {
       // print strtotime('14-11-2017');
       // print date('d-m-Y',strtotime('14-11-2017'));
        $checkdate = "";
        $Sdate = "";
        $Edate = "";
        $income = 0;
        $expense = 0;
        $expense2 = 0;
        $expense3 = 0;
        $expense4 = 0;
        $purch = 0;
        $emp_amount = 0;
        $headoffice_sum = 0;

    	  $searchModel = new SumdaybyempSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->isGet){
            $Sdate = strtotime(Yii::$app->request->get('Startdate'));
            $Edate = strtotime(Yii::$app->request->get('Enddate'));
            // $checkdate = strtotime(Yii::$app->request->get('Startdate'));
            //  echo strtotime('28-12-2017');
            //  echo time();
            // // echo time();
            // // echo date('d-m-Y',1513378800);
            //  return;
         
            //  $Sdate = date('d-m-Y',strtotime(Yii::$app->request->get('Startdate')));
            // $Edate = date('d-m-Y',strtotime(Yii::$app->request->get('Enddate')));
             $checkdate = date('Y',strtotime(Yii::$app->request->get('Startdate')));
 //echo date_format($Sdate2,'d-m-Y');return;
               // echo date('d-m-Y',$Sdate)."<br/>";//return;
            
          
            if(($Sdate != "" && $checkdate !='1970') || ($Edate != "" && $checkdate !='1970')){
              // 
             // $newsdate = strtotime($Sdate);
              //echo $newsdate;
              // $dataProvider->query->where(['>=','unix_date',$Sdate])->andFilterWhere(['<=','unix_date',$Edate])->orderby(['unix_date'=>SORT_DESC]);
               if(\backend\models\User::findUserGroup(Yii::$app->user->identity->id) != 'Administrator'){
                   $dataProvider->query->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->andFilterWhere(['created_by'=>Yii::$app->user->identity->id])->orderby(['unix_date'=>SORT_DESC]);
                   $income = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('income_amount');
                   $purch = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('purchase_amount');
                   $expense = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_1');
                   $expense2 = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_2');
                   $expense3 = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_3');
                   $expense4 = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->andFilterWhere(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_4');
                    
                   $modelx = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->all();
                   if($modelx){
                     foreach ($modelx as$value) {
                       if($value->emp_amount!=''){
                        if($value->emp_amount < 250){
                          $emp_amount += 250;
                        }else{
                          $emp_amount += $value->emp_amount;
                        }
                       }
                        
                     }
                   }
               }else{
                    $dataProvider->query->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->orderby(['unix_date'=>SORT_DESC]);
                   $income = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('income_amount');
                   $purch = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('purchase_amount');
                   $expense = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_1');
                   $expense2 = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_2');
                   $expense3 = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_3');
                   $expense4 = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('expense_amount_4');
                   
                   $headoffice_sum = \common\models\VSumExpenseCenter::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->sum('sum_amount');
                   
                   $modelx = \backend\models\SumdaybyempSearch::find()->where(['and',['>=','unix_date',$Sdate],['<=','unix_date',($Edate + 86400)]])->all();
                   if($modelx){
                     foreach ($modelx as$value) {
                       if($value->emp_amount!=''){
                        if($value->emp_amount < 250){
                          $emp_amount += 250;
                        }else{
                          $emp_amount += $value->emp_amount;
                        }
                       }
                      
                        
                     }
                   }
               }
              
            }else{
                  if(\backend\models\User::findUserGroup(Yii::$app->user->identity->id) != 'Administrator'){
                   $dataProvider->query->andFilterWhere(['created_by'=>Yii::$app->user->identity->id])->orderby(['unix_date'=>SORT_DESC]);
                   $income = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('income_amount');
                   $purch = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('purchase_amount');
                   $expense = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('expense_amount_1');
                   $expense2 = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('expense_amount_2');
                   $expense3 = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('expense_amount_3');
                   $expense4 = \backend\models\SumdaybyempSearch::find()->where(['created_by'=>Yii::$app->user->identity->id])->sum('expense_amount_4');


                  $modelx = \backend\models\SumdaybyempSearch::find()->all();
                   if($modelx){
                     foreach ($modelx as$value) {
                       if($value->emp_amount!=''){
                        if($value->emp_amount < 250){
                          $emp_amount += 250;
                        }else{
                          $emp_amount += $value->emp_amount;
                        }
                       }
                        
                     }
                   }

                 }else{
                   $dataProvider->query->orderby(['unix_date'=>SORT_DESC]);
                   $income = \backend\models\SumdaybyempSearch::find()->sum('income_amount');
                   $purch = \backend\models\SumdaybyempSearch::find()->sum('purchase_amount');
                   $expense = \backend\models\SumdaybyempSearch::find()->sum('expense_amount_1');
                   $expense2 = \backend\models\SumdaybyempSearch::find()->sum('expense_amount_2');
                   $expense3 = \backend\models\SumdaybyempSearch::find()->sum('expense_amount_3');
                   $expense4 = \backend\models\SumdaybyempSearch::find()->sum('expense_amount_4');

                   $headoffice_sum = \common\models\VSumExpenseCenter::find()->sum('sum_amount');
                   
                   $modelx = \backend\models\SumdaybyempSearch::find()->all();
                   if($modelx){
                     foreach ($modelx as$value) {
                       if($value->emp_amount!=''){
                        if($value->emp_amount < 250){
                          $emp_amount += 250;
                        }else{
                          $emp_amount += $value->emp_amount;
                        }
                       }
                        
                     }
                   }
                 }
            }
        }
       
        $Sdate = date('d-m-Y',$Sdate);
        $Edate = date('d-m-Y',$Edate);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'Sdate' => $Sdate,
            'Edate' => $Edate,
            'income' => $income,
            'expense' => $expense,
            'expense2' => $expense2,
            'expense3' => $expense3,
            'expense4' => $expense4,
            'purch' => $purch,
            'emp_amount'=>$emp_amount,
            'headoffice_sum'=>$headoffice_sum,
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
    public function actionDailyreport(){
      $cdate = Yii::$app->request->post('Cdate');
      $center_expense = null;
      if($cdate != ''){
          if(\backend\models\User::findUserGroup(Yii::$app->user->identity->id) != 'Administrator'){
            $model = \common\models\VSumDayByEmp::find()->where(['created_at'=>$cdate,'created_by'=>Yii::$app->user->identity->id])->all();
             $center_expense = \common\models\VSumExpenseCenter::find()->where(['create_date'=>$cdate])->all();
          }else{
            $model = \common\models\VSumDayByEmp::find()->where(['created_at'=>$cdate])->all();
            $center_expense = \common\models\VSumExpenseCenter::find()->where(['create_date'=>$cdate])->all();
          }
          
      }else{
         if(\backend\models\User::findUserGroup(Yii::$app->user->identity->id) != 'Administrator'){
          $model = \common\models\VSumDayByEmp::find()->where(['created_by'=>Yii::$app->user->identity->id])->all();
        }else{
          $model = \common\models\VSumDayByEmp::find()->all();
          $center_expense = \common\models\VSumExpenseCenter::find()->where(['create_date'=>$cdate])->all();
        }
      }
    
      return $this->render('daily',[
          'model'=>$model,
          'cdate'=>$cdate,
          'center_expense' => $center_expense,
        ]);
    }
	
}