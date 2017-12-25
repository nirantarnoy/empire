<?php

namespace backend\controllers;

use Yii;
use backend\models\Issuetable;
use backend\models\IssuetableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \backend\models\Trans;
/**
 * IssuetableController implements the CRUD actions for Issuetable model.
 */
class IssueapproveController extends Controller
{
	public function actionIndex(){
		$searchModel = new IssuetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['status'=>\backend\helpers\IssueStatus::ISSUE_CONFIRMED]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
	}
	public function actionTransissue($id){
	   if($id !=''){
	   	$issue_no = '';
	   	    $modelissue = \backend\models\Issuetable::find()->where(['id'=>$id])->one();
	   	    if($modelissue){
	   	   			$issue_no = $modelissue->issue_no;
	   	    }

	   		$model = \backend\models\Issuedetail::find()->where(['issue_id'=>$id])->all();
		   	 $modelWarehouse = \backend\models\Warehouse::find()->all();
	         return $this->render('_transfer',[
	                'model'=>$model,
	                'modelWarehouse'=>$modelWarehouse,
	                'issue_no'=>$issue_no,
	                'issue_id'=>$id,
	               ]);
	   }
			
	}
	public function actionTransfersubmit(){
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            //echo $data['issue_id'];return;
            //print_r($data);return;
            if(count($data)>0){
                for($i=0;$i<=count($data['product_id'])-1;$i++){
                  //  echo $data['product_id'][$i];return;
                    $datalist = []; // ต้นทาง
                    if($data['qty'][$i] > 0){
                         array_push($datalist,['product_id'=>$data['product_id'][$i],'qty'=>$data['qty'][$i],'warehouse'=>$data['fromwarehouse'][$i]]);
                    }
                    $x =Trans::createTrans($datalist,1,'TRANSFER');

                    $datalist2 = []; // ปลายทาง
                    if($data['qty'][$i] > 0){
                         array_push($datalist2,['product_id'=>$data['product_id'][$i],'qty'=>$data['qty'][$i],'warehouse'=>$data['towarehouse'][$i]]);
                    }
                    $x =Trans::createTrans($datalist2,0,'TRANSFER');

                    $session = Yii::$app->session;
                    if($x){
                    	$model = \backend\models\Issuetable::find()->where(['id'=>$data["issue_id"]])->one();
                    	if($model){
                    		$model->status = \backend\helpers\IssueStatus::ISSUE_COMPLETED;
                    		$model->save(false);
                    	}
                        $session->setFlash('success','บันทึกรายการสำเร็จ ');
                        return $this->redirect(['issueapprove/index']);   
                   }

                }

            }
        }
    }

}