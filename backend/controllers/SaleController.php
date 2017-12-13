<?php

namespace backend\controllers;

use Yii;
use backend\models\Sale;
use backend\models\SaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
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
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
      $perpage = Yii::$app->request->post('perpage');
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if($perpage!=''){
          //echo $perpage;
          $dataProvider->pagination->pageSize = (int)$perpage;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $perpage,
        ]);
    }

    /**
     * Displays a single Sale model.
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
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sale();

        if ($model->load(Yii::$app->request->post())) {
            $prodid = Yii::$app->request->post('product_id');
             $wh = Yii::$app->request->post('warehouse');
            $qty = Yii::$app->request->post('qty');
            $price = Yii::$app->request->post('price');
            $lineamt = Yii::$app->request->post('line_amount');
            $model->sale_date = strtotime($model->sale_date);
             $model->created_by = Yii::$app->user->identity->id;
            if( $model->save()){
                if(count($prodid)>0){
                    for($i=0;$i<=count($prodid)-1;$i++){
                        $modelline = new \backend\models\Saleline();
                        $modelline->sale_id = $model->id;
                        $modelline->product_id = $prodid[$i];
                        $modelline->warehouse_id = $wh[$i];
                        $modelline->qty = $qty[$i];
                        $modelline->price = $price[$i];
                        $modelline->line_amount=$lineamt[$i];
                        $modelline->save(false);
                    }
                }
                $this->updateAmount($model->id);
                 return $this->redirect(['update', 'id' => $model->id]);
            }
           
        }

        return $this->render('create', [
            'model' => $model,
            'runno' => $model::getLastNo(),
        ]);
    }

    /**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelline = \backend\models\Saleline::find()->where(['sale_id'=>$id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $prodid = Yii::$app->request->post('product_id');
            $qty = Yii::$app->request->post('qty');
            $wh = Yii::$app->request->post('warehouse');
            $price = Yii::$app->request->post('price');
            $lineamt = Yii::$app->request->post('line_amount');

            $model->sale_date = strtotime($model->sale_date);
            if($model->save()){
                \backend\models\Saleline::deleteAll(['sale_id'=>$id]);
                if(count($prodid)>0){
                    for($i=0;$i<=count($prodid)-1;$i++){
                        $modelline = new \backend\models\Saleline();
                        $modelline->sale_id = $model->id;
                        $modelline->product_id = $prodid[$i];
                        $modelline->warehouse_id = $wh[$i];
                        $modelline->qty = $qty[$i];
                        $modelline->price = $price[$i];
                        $modelline->line_amount=$lineamt[$i];
                        $modelline->save(false);
                    }
                }
                $this->updateAmount($id);
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
            'modelline' => $modelline,
            'status' => \backend\helpers\IssueStatus::getTypeById($model->status),
        ]);
    }

    public function updateAmount($id){
        $model = \backend\models\Saleline::find()->where(['sale_id'=>$id])->sum('line_amount');
        if($model){
            $model_order = \backend\models\Sale::find()->where(['id'=>$id])->one();
            if($model_order){
                $model_order->sale_amount = $model;
                $model_order->save(false);
            }
        }
    }

    /**
     * Deletes an existing Sale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      \backend\models\Saleline::deleteAll(['sale_id'=>$id]);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionBulkdelete()
    {
        if(Yii::$app->request->isAjax){
            $id = explode(",",Yii::$app->request->post('id'));
            if(count($id)>0){
                Sale::deleteAll(['id'=>$id]);
            }
        }
    
        return $this->redirect(['index']);
    }
    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionProductlist($q = null) {
      $query = $q;
      $model = \backend\models\Product::find()->where(['like','product_code',$query])->orFilterWhere(['like','name',$query])->all();
      if($model){
              echo Json::encode($model);
      }

}
public function actionAddline(){
    $data = Yii::$app->request->post('data');
    return $this->renderPartial('_addline',['data'=>$data]);
}
public function actionFirmorder(){
    if(Yii::$app->request->isAjax){
        $id = Yii::$app->request->post('saleid');

        if($id){
            $model = \backend\models\Saleline::find()->where(['sale_id'=>$id])->all();
            if(count($model)>0){
                 $data = [];
                 foreach($model as $value){
                     array_push($data,['product_id'=>$value->product_id,'qty'=>$value->qty,'warehouse'=>$value->warehouse_id]);
                 }
                   
                   // echo $data['product_id'];return;
                    $x = \backend\models\Trans::createTrans($data,1,$this->getSaleno($id));
                    if($x){
                        $session = Yii::$app->session;
                        $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                        return $this->redirect(['index']);
                    }
            }
            
        }
                   
    }
}
  public function getSaleno($id){
        $model = Sale::find()->where(['id'=>$id])->one();
        return count($model)>0?$model->sale_no:'';
    }
    public function actionCheckonhand(){
      if(Yii::$app->request->isAjax){
        $pdid = Yii::$app->request->post("pd");
        $whid = Yii::$app->request->post("wh");
        if($pdid !='' && $whid !=''){
           $model = \backend\models\Stockbalance::find()->where(['product_id'=>$pdid,'warehouse_id'=>$whid])->one();
           if(count($model)>0){
            return $model->qty;
           }else{
            return 0;
           }
        }else{
          return "Not found";
        }
      }
    }
}
