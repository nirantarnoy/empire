<?php

namespace backend\controllers;

use Yii;
use backend\models\Stockbalance;
use backend\models\StockbalanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Trans;
use yii\helpers\Json;
/**
 * StockbalanceController implements the CRUD actions for Stockbalance model.
 */
class StockbalanceController extends Controller
{
     public $enableCsrfValidation = false;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST','GET'],
                ],
            ],
        ];
    }

    /**
     * Lists all Stockbalance models.
     * @return mixed
     */
    public function actionIndex()
    {
       $perpage = Yii::$app->request->post('perpage');
        $searchModel = new StockbalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andFilterWhere(['stockbalance.created_by'=>Yii::$app->user->identity->id]);
         if($perpage!=''){
          //echo $perpage;
          $dataProvider->pagination->pageSize = (int)$perpage;
        }
        if(Yii::$app->request->post('hasEditable')){
            $rowid = Yii::$app->request->post('editableKey');
            $stock = Stockbalance::findOne($rowid);
            $out = Json::encode(['output'=>'','message'=>'']);
            $oldqty = $this->findOldqty($rowid);

            $newqty = 0;
            $dataupdate = [];
            $stocktype = 0;

            $post = [];
            $posted = current($_POST['Stockbalance']);
            $post['Stockbalance']= $posted;
            if($stock->load($post)){
                if($stock->qty > 0){
                    $newqty = $stock->qty - $oldqty;
                }else{
                    $newqty = $oldqty* -1;
                }
                if($stock->qty > $oldqty){
                    $stocktype = 0; // in
                }else{
                    $stocktype = 1; // out
                }
                if($stock->qty != $oldqty){
                     array_push($dataupdate,['product_id'=>$stock->product_id,'qty'=>$newqty,'warehouse'=>$stock->warehouse_id]);
                }
                
            }
            if(count($dataupdate)>0){
                 $x =\backend\models\Trans::createTrans($dataupdate,$stocktype,'ADJUST');
            }
            
            echo $out;
            return;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $perpage,
        ]);
    }
    public function findOldqty($id){
        $model = Stockbalance::findOne($id);
        return count($model)>0?$model->qty:0;
    }

    /**
     * Displays a single Stockbalance model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Stockbalance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stockbalance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stockbalance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stockbalance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Stockbalance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Stockbalance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Stockbalance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionTransfer(){
        if(Yii::$app->request->isAjax){
            $id = \Yii::$app->request->post('id');
            if($id){
                $model = Stockbalance::find()->where(['id'=>$id])->all();
                if($model){
                    $session = \Yii::$app->session;
                    $session->set('transfer',$model);
                    return $this->redirect(['stockbalance/transferstock']);
                }
            }else{
                return;
            }
        }
    }
    public function actionTransferstock(){
       $session = \Yii::$app->session;
       $model = $session->get('transfer');

       $modelWarehouse = \backend\models\Warehouse::find()->all();
       return $this->render('_transfer',[
                'model'=>$model,
                'modelWarehouse'=>$modelWarehouse,
                ]);
    }
    public function actionTransfersubmit(){
        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            //print_r($data);return;
            if(count($data)>0){
                for($i=0;$i<=count($data['product_id'])-1;$i++){
                  //  echo $data['product_id'][$i];return;
                    $datalist = []; // ต้นทาง
                    if($data['qty'][$i] > 0){
                         array_push($datalist,['product_id'=>$data['product_id'][$i],'qty'=>$data['qty'][$i],'warehouse'=>$data['warehouse_id'][$i]]);
                    }
                    $x =Trans::createTrans($datalist,1,'TRANSFER');

                    $datalist = []; // ปลายทาง
                    if($data['qty'][$i] > 0){
                         array_push($datalist,['product_id'=>$data['product_id'][$i],'qty'=>$data['qty'][$i],'warehouse'=>$data['towarehouse'][$i]]);
                    }
                    $x =Trans::createTrans($datalist,0,'TRANSFER');


                }

            }
        }
    }
}
