<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Modelfile;
use backend\models\Productimage;
use backend\models\StockbalanceSearch;
use backend\models\ViewStockSearch;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $modelfile = new Modelfile();

        if($modelfile->load(Yii::$app->request->post())){
           $uploaded = UploadedFile::getInstances($modelfile,"file");
           if(!empty($uploaded)){
              echo 'yd';
           }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelfile' => $modelfile,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $modelfile = new Modelfile();
        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {
             $uploaded = UploadedFile::getInstances($modelfile, 'file');
             
            if($model->save()){
                if(!empty($uploaded)){
                  foreach($uploaded as $file){
                        $upfiles = time() . "." . $file->getExtension();                        
                        $modelimage = new Productimage();
                        if ($file->saveAs('../web/uploads/images/' . $upfiles)) {
                           $modelimage->image = $upfiles;
                        }
                        $modelimage->product_id = $model->id;
                        $modelimage->save();
                  }
                }
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelfile' => $modelfile,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $searchModel = new StockbalanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $searchModel2 = new ViewStockSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        $dataProvider2->query->where(['product_id'=>$id])->orderby(['created_at'=>SORT_DESC]);

        $model_trans = \common\models\ViewTrans::find()->where(['product_id'=>$id])->all();

        $imagelist = Productimage::find()->where(['product_id'=>$id])->all();
         $modelfile = new Modelfile();
        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {
           // $oldlogo = Yii::$app->request->post('old_photo');
            $uploaded = UploadedFile::getInstances($modelfile, 'file');
            // if(!empty($uploaded)){
            //       $upfiles = time() . "." . $uploaded->getExtension();

            //         //if ($uploaded->saveAs('../uploads/products/' . $upfiles)) {
            //         if ($uploaded->saveAs('../web/uploads/logo/' . $upfiles)) {
            //            $model->photo = $upfiles;
            //         }
            // }else{
            //      $model->photo = $oldlogo;
            // }
            if($model->save()){
                if(!empty($uploaded)){
                  foreach($uploaded as $file){
                      //  $upfiles = time() . "." . $file->getExtension();                        
                        $upfiles = $file;                        
                        $modelimage = new Productimage();
                        if ($file->saveAs('../web/uploads/images/' . $upfiles)) {
                           $modelimage->image = $upfiles;
                        }
                        $modelimage->product_id = $model->id;
                        $modelimage->save(false);
                  }
                }else{
                    //$model->photo = $oldlogo;
                }
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelfile' => $modelfile,
                'imagelist' => $imagelist,
                'dataProvider' => $dataProvider,
                'dataProvider2' => $dataProvider2,
                'model_trans' => $model_trans,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionShowsubcategory($id){
      $model = \backend\models\Subcategory::find()->where(['category_id' => $id])->all();
        $i = 0;
      if (count($model) > 0) {
          foreach ($model as $value) {
              if($i == 0){
                    echo "<option>เลือกหมวดย่อย </option>";
                    echo "<option value='$value->id'>$value->name</option>";
                    $i+=1;
              }else{
                    echo "<option value='$value->id'>$value->name</option>";
              }

          }
      } else {
          echo "<option value='0'>-</option>";
      }

    }
    public function actionShowmodel($id){
      $model = \backend\models\Productmodel::find()->where(['brand_id' => $id])->all();
        $i = 0;
      if (count($model) > 0) {
          foreach ($model as $value) {
              if($i == 0){
                    echo "<option>เลือกรุ่นสินค้า </option>";
                    echo "<option value='$value->id'>$value->name</option>";
                    $i+=1;
              }else{
                    echo "<option value='$value->id'>$value->name</option>";
              }

          }
      } else {
          echo "<option value='0'>-</option>";
      }

    }
    public function actionImportproduct(){
      if(Yii::$app->request->isPost){
        print_r(Yii::$app->request->post());
      }
    }

}
