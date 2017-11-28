<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Journal;
use backend\models\Journaltrans;
use backend\models\Stockbalance;
class Trans extends Model
{
	public static function createTrans($data=[],$transtype=0,$transref=''){
		if($transtype != 10){
			if(count($data)>0){
				$model = new Journal();
				$model->journal_no = $model->getLastNo();
				$model->transdate = strtotime(date('d-m-Y'));
				$model->reference = $transref;
				$model->status = 1;
				$model->created_by = Yii::$app->user->identity->id;
				if($model->save(false)){
					return self::createTransline($model->id,$data,$transtype,$transref);
				}
			}
		}else{
				$model = new Journal();
				$model->journal_no = $model->getLastNo();
				$model->transdate = strtotime(date('d-m-Y'));
				$model->reference = $transref;
				$model->status = 1;
				$model->created_by = Yii::$app->user->identity->id;
				if($model->save(false)){
					//return self::createTransline($model->id,$data,$transtype,$transref);
				}
		}
	}
	public static function createTransline($journal_id,$data,$transtype,$transref){
			if(count($data)>0){
			$res = false;
			
			for($i=0;$i<=count($data)-1;$i++){
				$data2 = [];
				$model = new Journaltrans();
				$model->journal_id = $journal_id;
				$model->product_id = $data[$i]['product_id'];
				$model->qty = $data[$i]['qty'];
				$model->invent_type = $transtype;
				$model->status = 1;
			    $model->warehouse_id = $data[$i]['warehouse'];
				if($model->save(false)){
					array_push($data2,['product_id'=>$data[$i]['product_id'],'qty'=>$data[$i]['qty'],'warehouse'=>$data[$i]['warehouse']]);
					$res = self::stockbalance($data2,$transtype,$transref);
				}
			}
				return $res;
			}	
	}
	public static function stockbalance($data,$transtype,$transref){

		if(count($data)>0){

			if($transref == ''){
				$model = Stockbalance::find()->where(['product_id'=>$data[0]['product_id'],'warehouse_id'=>$data[0]['warehouse']])->one();
					if(count($model)>0){
						if($transtype == 0){ // in
							$model->qty = $model->qty + $data[0]['qty'];
						}else{               // out
							$model->qty = $model->qty - $data[0]['qty'];
						}
						
						$model->save(false);
					}else{
						$model = new Stockbalance();
						$model->product_id = $data[0]['product_id'];
						$model->warehouse_id = $data[0]['warehouse'];
						$model->qty = $data[0]['qty'];
						$model->status = 1;
						$model->save(false);
					}
			}elseif("TRANSFER"){
				$model = Stockbalance::find()->where(['product_id'=>$data[0]['product_id'],'warehouse_id'=>$data[0]['warehouse']])->one();
					if(count($model)>0){
						if($transtype == 0){ // in
							$model->qty = $model->qty + $data[0]['qty'];
						}else{               // out
							$model->qty = $model->qty - $data[0]['qty'];
						}
						
						$model->save(false);
					}else{
						$model = new Stockbalance();
						$model->product_id = $data[0]['product_id'];
						$model->warehouse_id = $data[0]['warehouse'];
						$model->qty = $data[0]['qty'];
						$model->status = 1;
						$model->save(false);
					}
			}
			




			$model_sum = Stockbalance::find()->where(['product_id'=>$data[0]['product_id']])->sum('qty');
			$model_prod = \backend\models\Product::find()->where(['id'=>$data[0]['product_id']])->one();
			if($model_prod){
				$model_prod->qty = $model_sum;
				if($model_prod->save(false)){
					self::checkLowstock($data[0]['product_id'],$data[0]['warehouse']);
					return true;
				}else{
					return false;
				}
			}
		}
	}
	public static function checkLowstock($product_id,$warehouse_id){
              $model = \backend\models\Productmin::find()->where(['product_id'=>$product_id,'warehouse_id'=>$warehouse_id])->one();
              $modelstock = \backend\models\Stockbalance::find()->where(['product_id'=>$product_id,'warehouse_id'=>$warehouse_id])->one();
              if($model){
              	   if((int)$model->minstock < (int)$modelstock->qty){
              	   		$modelnoti = new \common\models\Notification();
						$modelnoti->title = "สินค้า ".$model->product_id." ต่ำกว่ากำหนด";
						$modelnoti->description = "สินค้า ".$model->product_id." คลังสินค้า ".$model->warehouse_id. " ขั้นตำ่ =".$model->minstock. " จำนวนปัจจุบัน= ".$modelstock->qty;
						$modelnoti->status = 1;
						$modelnoti->save(false);
              	   }
              }
		
	}
}