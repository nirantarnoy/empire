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
use kartik\mpdf\Pdf;
/**
 * ProductController implements the CRUD actions for Product model.
 */

class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
      $session = new Yii::$app->session();
        $session->open();
        $name_search = '';
        $cat_search = '';
        $cost_start = '';
        $cost_end = '';
        $perpage = 20;
        
      
        if(Yii::$app->request->isPost){
          //echo "POST";
          //print_r(Yii::$app->request->post());return;
          if(!isset($session['name_search'])){
           // echo "NO";
              $name_search = Yii::$app->request->post("name_search");
              $cat_search = Yii::$app->request->post("cat_id");
              $cost_start = Yii::$app->request->post("cost_start");
              $cost_end = Yii::$app->request->post("cost_end");
              $perpage = Yii::$app->request->post('perpage');

             // echo $session['name_search'];

              $session['name_search'] = $name_search;
              $session['cat_search'] = $cat_search;
              $session['cost_start'] = $cost_start;
              $session['cost_end'] = $cost_end;
              $session['perpage'] = $perpage;

              $searchModel = new ProductSearch();
              $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
              
              $dataProvider->query->andFilterWhere(['or',['like','product_code',$session['name_search']],['like','name',$session['name_search']]]);
              if($cat_search > 0){
                $dataProvider->query->andFilterWhere(['=','category_id',$session['cat_search']]);
              }
              
              $dataProvider->query->andFilterWhere(['and',['>=','cost',$session['cost_start']],['<=','cost',$session['cost_end']]]);

          }else{
           // echo "Niran";
              $name_search = Yii::$app->request->post("name_search");
              $cat_search = Yii::$app->request->post("cat_id");
              $cost_start = Yii::$app->request->post("cost_start");
              $cost_end = Yii::$app->request->post("cost_end");
              $perpage = Yii::$app->request->post('perpage');
           


              if($name_search == '' && $cat_search =='' && $cost_start == '' && $cost_end == ''){
                $name_search = $session['name_search'];
                $cat_search=$session['cat_search'];
                $cost_start=$session['cost_start'];
                $cost_end=$session['cost_end'];
               // $perpage=$session['perpage'];

                $searchModel = new ProductSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    
                    $dataProvider->query->andFilterWhere(['or',['like','product_code',$session['name_search']],['like','name',$session['name_search']]]);
                    if($cat_search > 0){
                      $dataProvider->query->andFilterWhere(['=','category_id',$session['cat_search']]);
                    }
                    
                    $dataProvider->query->andFilterWhere(['and',['>=','cost',$session['cost_start']],['<=','cost',$session['cost_end']]]);

                $session->destroy();
              }else{
                  $session['name_search'] = $name_search;
                  $session['cat_search'] = $cat_search;
                  $session['cost_start'] = $cost_start;
                  $session['cost_end'] = $cost_end;
                  $session['perpage'] = $perpage;

                    $searchModel = new ProductSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    
                    $dataProvider->query->andFilterWhere(['or',['like','product_code',$session['name_search']],['like','name',$session['name_search']]]);
                    if($cat_search > 0){
                      $dataProvider->query->andFilterWhere(['=','category_id',$session['cat_search']]);
                    }
                    
                    $dataProvider->query->andFilterWhere(['and',['>=','cost',$session['cost_start']],['<=','cost',$session['cost_end']]]);
              }
              

             
          }
         

        }else{
         //echo "NO POST";
          $searchModel = new ProductSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          
          $dataProvider->query->andFilterWhere(['or',['like','product_code',$name_search],['like','name',$name_search]]);
          if($cat_search > 0){
            $dataProvider->query->andFilterWhere(['=','category_id',$cat_search]);
          }
          
          $dataProvider->query->andFilterWhere(['and',['>=','cost',$cost_start],['<=','cost',$cost_end]]);
        }
        
        

        
        // if(isset($session['perpage']) && $session['perpage'] !=''){
        //   $perpage = $session['perpage'];
        //   $dataProvider->pagination->pageSize = (int)$session['perpage']; 
        //   // echo $session['perpage'];
        // }else{
        //    $dataProvider->pagination->pageSize = (int)$perpage; 
        // }
         $dataProvider->pagination->pageSize = $perpage; 

        $modelfile = new Modelfile();

        if($modelfile->load(Yii::$app->request->post())){
           $uploaded = UploadedFile::getInstance($modelfile,"file");
           $warehouseid = 1;
           if($modelfile->warehouseid !=''){
              $warehouseid = $modelfile->warehouseid;
           }
          // echo $warehouseid;return;
           if(!empty($uploaded)){
              $data = [];
              $data_save = 0;
              $data_fail = [];
              $data_all = 0;
                if($uploaded->saveAs('../web/uploads/files/'.$uploaded)){

                $myfile = '../web/uploads/files/'.$uploaded;
                $inputFileType = \PHPExcel_IOFactory::identify($myfile);
                $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($myfile);

                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                for($row=1;$row <= $highestRow; $row++){
                  $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

                  if($row <=1){
                    continue;
                  }
                  if($rowData[0][0] == ''){
                    $data_all +=1;
                    continue;
                  }
                          $modelprod = \backend\models\Product::find()->where(['name'=>$rowData[0][1]])->one();
                          if(count($modelprod)>0){
                              $checkBalance = $this->checkBal($modelprod->id,$warehouseid);
                              if($checkBalance == 1){
                                  //$data_all +=1;
                                 // array_push($data_fail,['name'=>$rowData[0][1]]);
                                  continue;
                              }else{
                                 array_push($data,['product_id'=>$modelprod->id,'qty'=>$rowData[0][8],'warehouse'=>$warehouseid]);
                              }
                           
                          }else{
                            $modelx = new \backend\models\Product();
                            $modelx->product_code = $rowData[0][0];
                            $modelx->name = $rowData[0][1];
                            $modelx->description = $rowData[0][2] ;
                            $modelx->category_id = $this->checkCat($rowData[0][3]);
                            $modelx->weight = $rowData[0][4];
                            $modelx->unit_id = $this->checkUnit($rowData[0][5]);
                            $modelx->price = $rowData[0][6];
                            $modelx->cost = $rowData[0][7];
                            $modelx->qty = $rowData[0][8];
                            $modelx->min_qty = $rowData[0][9];
                            $modelx->max_qty = $rowData[0][10];
                            $modelx->status = 1;
                        
                           if($modelx->save(false)){
                              $data_save += 1;
                              $data_all +=1;
                              array_push($data,['product_id'=>$modelx->id,'qty'=>$modelx->qty,'warehouse'=>$warehouseid]);
                           }
                          }

                            
                         // }
                          
                  //echo $rowData[0][0]."/".$rowData[0][1]."/".$rowData[0][2]."/".$rowData[0][3]."/".$rowData[0][4].'<br />';
                }

                 
                 $x = \backend\models\Trans::createTrans($data,0,"import");
                 $session = Yii::$app->session;
                    if($x){
                      if($data_save >0){
                        $session->setFlash('success','บันทึกรายการสำเร็จ '.$data_save .' จาก '.$data_all);
                        $session->setFlash('error','บันทึกรายการไม่สำเร็จเนื่องจากมีรหัสซ้ำ'.count($data_fail) .' จาก '.$data_all);
                      }else{
                         $session->setFlash('error','บันทึกรายการไม่สำเร็จเนื่องจากมีรหัสซ้ำ'.count($data_fail) .' จาก '.$data_all);
                      }
                    
                      return $this->redirect(['index']);
                    }else{
                       $session->setFlash('error','บันทึกรายการไม่สำเร็จเนื่องจากมีรหัสซ้ำ'.count($data_fail) .' จาก '.$data_all);
                    }

                }
                
           }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelfile' => $modelfile,
            'perpage'=>$perpage,
            'name_search' => $name_search,
            'cat_search' => $cat_search,
            'cost_start' => $cost_start,
            'cost_end' => $cost_end,
        ]);
    }
    public function checkCat($name){
      $model = \backend\models\Category::find()->where(['name'=>$name])->one();
      if(count($model)>0){
        return $model->id;
      }else{
        $model_new = new \backend\models\Category();
        $model_new->name = $name;
        $model_new->status = 1;
        if($model_new->save(false)){
          return $model_new->id;
        }
      }
    }
  public function checkUnit($name){
      $model = \backend\models\Unit::find()->where(['name'=>$name])->one();
      if(count($model)>0){
        return $model->id;
      }else{
        $model_new = new \backend\models\Unit();
        $model_new->name = $name;
        $model_new->status = 1;
        if($model_new->save(false)){
          return $model_new->id;
        }
      }
    }
  public function checkBal($prodid,$whid){
    $model = \backend\models\Stockbalance::find()->where(['product_id'=>$prodid,'warehouse_id'=>$whid])->one();
    return count($model)>0?1:0;
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
        $dataProvider->query->where(['product_id'=>$id]);

        $searchModel2 = new ViewStockSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        $dataProvider2->query->where(['product_id'=>$id])->orderby(['created_at'=>SORT_DESC]);

        $model_trans = \common\models\ViewTrans::find()->where(['product_id'=>$id])->all();
        $minline = \backend\models\Productmin::find()->where(['product_id'=>$id])->all();

        $imagelist = Productimage::find()->where(['product_id'=>$id])->all();
         $modelfile = new Modelfile();
        if ($model->load(Yii::$app->request->post()) && $modelfile->load(Yii::$app->request->post())) {
           // $oldlogo = Yii::$app->request->post('old_photo');
            $warehouseid = Yii::$app->request->post('warehouse');
            $minqty = Yii::$app->request->post('min_qty');


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
                \backend\models\Productmin::deleteAll(['product_id'=>$id]);
                if(count($warehouseid)>0){
                  for($i=0;$i<=count($warehouseid)-1;$i++){
                    $min = new \backend\models\Productmin();
                    $min->product_id = $model->id;
                    $min->warehouse_id = $warehouseid[$i];
                    $min->minstock = $minqty[$i];
                    $min->status = 1;
                    $min->save(false);
                  }
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
                'minline' => $minline,
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
    public function actionBulkdelete()
    {
        if(Yii::$app->request->isAjax){
            $id = explode(",",Yii::$app->request->post('id'));
            if(count($id)>0){
                Product::deleteAll(['id'=>$id]);
            }
        }
    
        return $this->redirect(['index']);
    }
    public function actionBulkreset()
    {
        if(Yii::$app->request->isAjax){
                  $model= Product::find()->all();
                  if($model){
                    foreach ($model as $value) {
                      $modelx = Product::find()->where(['id'=>$value->id])->one();
                      if($modelx){
                         $modelx->qty = 0;
                         $modelx->save(false);

                         \backend\models\Journaltrans::deleteAll(['product_id'=>$value->id]);
                      }
                      
                    }
                    
                  //  \backend\models\Transactionline::deleteAll(['product_id'=>$id[$i]]);

                  }
           // $id = explode(",",Yii::$app->request->post('id'));
            // if(count($id)>0){
            //    for($i=0;$i<=count($id)-1;$i++){
            //      $model= Product::find()->where(['id'=>$id[$i]])->one();
            //       if($model){
            //         $model->qty = 0;
            //         $model->save(false);

            //         \backend\models\Journaltrans::deleteAll(['product_id'=>$id[$i]]);
            //       //  \backend\models\Transactionline::deleteAll(['product_id'=>$id[$i]]);

            //       }
            //    }
               
            // }
        }
    
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
    public function actionAddminline(){
      if(Yii::$app->request->isAjax){
        return $this->renderPartial('_addline');
      }
    }
    public function actionPrintbarcode(){
       $qty = 1;
       $pcode = '';
       $data = [];
       if(Yii::$app->request->isPost){
          $pcode = explode(',',Yii::$app->request->post('pcode'));
          $qty = Yii::$app->request->post('qty');
          
          if(count($pcode)>0){
            for($i=0;$i<=count($pcode)-1;$i++){
            $model = Product::find()->where(['id'=>$pcode[$i]])->one();
            if($model){
              array_push($data, ['code'=>$model->product_code,'name'=>$model->name,'qty'=>$qty]);
            }
          }
          }

       }
      $pdf = new Pdf([
                'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                'format' => Pdf::FORMAT_A4, 
                'orientation' => Pdf::ORIENT_LANDSCAPE,
                'destination' => Pdf::DEST_BROWSER, 
                'content' => $this->renderPartial('_print',[
                    'bcode'=>$data,  
                    // 'from_date'=> $from_date,
                    // 'to_date' => $to_date,
                    ]),
                //'content' => "nira",
                'cssFile' => '@backend/web/css/pdf.css',
                'options' => [
                    'title' => 'บาร์โค้ดรหัสินค้า',
                    'subject' => ''
                ],
                'methods' => [
                    'SetHeader' => ['บาร์โค้ดรหัสินค้า||Generated On: ' . date("r")],
                    'SetFooter' => ['|Page {PAGENO}|'],
                ]
            ]);
             return $pdf->render();
    }

}
