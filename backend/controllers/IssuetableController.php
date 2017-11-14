<?php

namespace backend\controllers;

use Yii;
use backend\models\Issuetable;
use backend\models\IssuetableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IssuetableController implements the CRUD actions for Issuetable model.
 */
class IssuetableController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Issuetable models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IssuetableSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Issuetable model.
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
     * Creates a new Issuetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Issuetable();

        if ($model->load(Yii::$app->request->post())) {
             $prodid = Yii::$app->request->post('product_id');
            $qty = Yii::$app->request->post('qty');
            $price = Yii::$app->request->post('price');
            $lineamt = Yii::$app->request->post('line_amount');
            $model->status = 1;
            $model->request_by = Yii::$app->user->identity->id;
            $model->require_date = strtotime($model->require_date);
            if($model->save()){
                if(count($prodid)>0){
                    for($i=0;$i<=count($prodid)-1;$i++){
                        $modelline = new \backend\models\Issuedetail();
                        $modelline->issue_id = $model->id;
                        $modelline->product_id = $prodid[$i];
                        $modelline->req_qty = $qty[$i];
                        $modelline->price = $price[$i];
                        $modelline->line_amount=$lineamt[$i];
                        $modelline->created_by = Yii::$app->user->identity->id;
                        $modelline->save(false);
                    }
                }
             return $this->redirect(['update', 'id' => $model->id]);               
            }
        }
        return $this->render('create', [
            'model' => $model,
            'runno' => $model::getLastNo(),
            'status' => \backend\helpers\IssueStatus::getTypeById(1)


        ]);
}

    /**
     * Updates an existing Issuetable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelline = \backend\models\Issuedetail::find()->where(['issue_id'=>$id])->all();
        if ($model->load(Yii::$app->request->post())) {
            $prodid = Yii::$app->request->post('product_id');
            $qty = Yii::$app->request->post('qty');
            $price = Yii::$app->request->post('price');
            $lineamt = Yii::$app->request->post('line_amount');
             $model->require_date = strtotime($model->require_date);
            if($model->save()){
                \backend\models\Issuedetail::deleteAll(['issue_id'=>$id]);
                if(count($prodid)>0){
                    for($i=0;$i<=count($prodid)-1;$i++){
                        $modelline = new \backend\models\Issuedetail();
                        $modelline->issue_id = $model->id;
                        $modelline->product_id = $prodid[$i];
                        $modelline->req_qty = $qty[$i];
                        $modelline->price = $price[$i];
                        $modelline->line_amount=$lineamt[$i];
                         $modelline->updated_by = Yii::$app->user->identity->id;
                        $modelline->save(false);
                    }
                }
                return $this->redirect(['update', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
             'modelline' => $modelline,
             'status' => \backend\helpers\IssueStatus::getTypeById($model->status)
        ]);
    }

    /**
     * Deletes an existing Issuetable model.
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
     * Finds the Issuetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Issuetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Issuetable::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionAddline(){
    $data = Yii::$app->request->post('data');
    return $this->renderPartial('_addline',['data'=>$data]);
}
public function actionApprove(){
        $res = 0;
        if(Yii::$app->request->isAjax){
            
            $id = Yii::$app->request->post("id");

            if($id){
                $model = Issuetable::find()->where(['id'=>$id])->one();
                if($model){
                    $model->status = \backend\helpers\IssueStatus::ISSUE_CONFIRMED;
                    if($model->save(false)){
                        $res +=1;
                    }
                }
            }
            if($res > 0){
                $session = Yii::$app->session;
                $session->setFlash('success','อนุมัติใบเติมสินค้าแล้ว');
                return $this->redirect(['issuetable/update','id'=>$id]);
            }else{
                 $session = Yii::$app->session;
                $session->setFlash('error','ไม่สามารถอนุมัติใบเติมสินค้า');
                return $this->redirect(['issuetable/update','id'=>$id]);
            }
        }
    }
}
