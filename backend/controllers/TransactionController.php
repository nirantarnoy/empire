<?php

namespace backend\controllers;

use Yii;
use backend\models\Transaction;
use backend\models\TransactionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
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
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TransactionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transaction model.
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
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();
        $expendlist = \backend\models\Expense::find()->all();

        if ($model->load(Yii::$app->request->post())) {
             $title_id = Yii::$app->request->post('expend_title_id');
             $price = Yii::$app->request->post('price');
             $model->transdate = strtotime(date('d-m-Y'));
             $model->created_by = Yii::$app->user->identity->id;
            $model->status = 1;
            if($model->save()){ 
                if(count($title_id)>0){
                    $data = [];
                    for($i=0;$i<=count($title_id)-1;$i++){
                        $modelline = new \backend\models\Transactionline();
                        $modelline->trans_id = $model->id;
                        $modelline->title_id = $title_id[$i];
                        $modelline->amount = $price[$i];
                        if($modelline->save(false)){
                             
                        }
                    }
                    array_push($data,['product_id'=>'','qty'=>0,'warehouse'=>0]);
                    $x = \backend\models\Trans::createTrans($data,10,$model->id); //บันทึกรายจ่าย
                    if($x){
                        // $session = Yii::$app->session;
                        // $session->setFlash('msg','บันทึกรายการเรียบร้อย');
                        // return $this->redirect(['index']);
                    }
                }
                $this->updateAmount($model->id);
                return $this->redirect(['update', 'id' => $model->id]);  
            }

        }

        return $this->render('create', [
            'model' => $model,
            'runno'=> $model->getLastNo(),
            'status' => \backend\helpers\TransactionStatus::getTypeById(1),
            'expendlist' => Json::encode($expendlist),
        ]);
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $expendlist = \backend\models\Expense::find()->all();
        $model_line = \backend\models\Transactionline::find()->where(['trans_id'=>$id])->all();

        if ($model->load(Yii::$app->request->post())) {
             $title_id = Yii::$app->request->post('expend_title_id');
             $price = Yii::$app->request->post('price');
             $model->status = 1;
             if($model->save()){
                \backend\models\Transactionline::deleteAll(['trans_id'=>$id]);
                 if(count($title_id)>0){
                    for($i=0;$i<=count($title_id)-1;$i++){
                        $modelline = new \backend\models\Transactionline();
                        $modelline->trans_id = $model->id;
                        $modelline->title_id = $title_id[$i];
                        $modelline->amount = $price[$i];
                        $modelline->save(false);
                    }
                }
                $this->updateAmount($model->id);
                return $this->redirect(['update', 'id' => $model->id]);
             }
        }

        return $this->render('update', [
            'model' => $model,
            'status' => \backend\helpers\TransactionStatus::getTypeById($model->status),
            'expendlist' => Json::encode($expendlist),
            'model_line' => $model_line,
        ]);
    }

      public function updateAmount($id){
        $model = \backend\models\Transactionline::find()->where(['trans_id'=>$id])->sum('amount');
        if($model){
            $model_order = \backend\models\Transaction::find()->where(['id'=>$id])->one();
            if($model_order){
                $model_order->amount = $model;
                $model_order->save(false);
            }
        }
    }

    /**
     * Deletes an existing Transaction model.
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
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAddline(){
        if(Yii::$app->request->isAjax){
            return $this->renderPartial('_line');
        }
    }
    public function actionListproduct(){
        $model = \backend\models\Product::find()->all();
        if($model){
            $data = [];
             $data[] = ["product_id"=>"niran"];
             //return Json::encode($data);
            print_r(Json::encode($data));
           //return Json::encode($model,JSON_NUMERIC_CHECK);
        }
    }
}
