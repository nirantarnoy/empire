<?php
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
?>
<tr id="line_trans">
	<td>
		<?php
                    echo Typeahead::widget([
                          'name' => 'country',
                          'options' => ['placeholder' => 'ค้นหารหัสสินค้า...'],
                          'pluginOptions' => ['highlight'=>true],
                          'dataset' => [
                              [
                                  'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                  'display' => 'value',
                                  'limit' => '100',
                                  'templates'=>[
                                    'notFound' => '<div class="text-danger" style="padding:0 8px">ไม่พบสินค้า</div>',
                                    'suggestion' => new \yii\web\JsExpression("Handlebars.compile('<div><span class=\'fa fa-picture-o\' style=\'font-size:1.5em;\'></span> {{product_code}} {{name}}</div>')"),
                                  ],
                                  //'prefetch' => '/samples/countries.json',
                                  'remote' => [
                                      'url' => 'index.php?r=sale%2Fproductlist'.'&q=%QUERY',
                                      'wildcard' => '%QUERY'
                                  ]
                              ]
                              ],
                              'pluginEvents'=>[
                                "typeahead:select" => "
                                  function(e,s){
                                    if($(document).find('.saleline-id-'+s.id).length >=1){

                                    }else{
                                      $.ajax({
                                        type: 'POST',
                                        url: '".Url::to(['/sale/addline'])."',
                                        data: {data:s},
                                        success: function(data){
                                          $('.add-saleline').parent().append(data);
                                          var cnt =0;
                                          $('#lineitem >tbody >tr').each(function(){
                                            cnt+=1;
                                            $(this).find('td:first-child').text(cnt);
                                          });
                                            sumall();
                                        }
                                      });
                                    }
                                  }
                                "
                              ]
                          
                      ]);
                  ?>
	</td>		
	<td><input type="text" class="form-control"></td>		
	<td><input type="text" class="form-control"></td>		
	<td><input type="text" class="form-control"></td>		
</tr>