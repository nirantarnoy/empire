$(function(){
	var orderList = [];
	    $(".btn-trasfer").attr("disabled","disabled");
        $("input").iCheck({
              checkboxClass: "icheckbox_square-green",
              radioClass: "iradio_square-green",
              increaseArea: "20%" // optional
         });
        $(".iCheck-helper").click(function(){

                  $(this).parent().each(function(i1, e1){
                      if($(e1).children().attr("name") == "selection[]"){
                          if($(e1).children().prop("checked")){
                              // console.log($(e1).children().val());
                              $(e1).children().prop("checked", true);

                              // $(".all-print").show();
                          }else{

                              // console.log("un check"+$(e1).children().val());
                              $(e1).children().prop("checked", false);
                              $(document).find("input[name='selection_all']").prop("checked", false);
                              $(document).find("input[name='selection_all']").parent().removeClass("checked");
                          }
                          orderList = [];
                          $(".icheckbox_square-green input[name='selection[]']:checked").each(function(i,e){
                              orderList.push(e.value);
                          });
                           console.log(orderList);

                          orderStatusList = [];
                          $(".icheckbox_square-green input[name='selection[]']:checked").each(function(i,e){
                              orderStatusList.push($(e).parents("tr").attr("data-status"));
                          });
                          // console.log(orderStatusList);
                      }else{
                          orderList = [];
                          if($(e1).children().prop("checked")){
                               console.log("check all");
                              $(".icheckbox_square-green input[name='selection[]']").each(function(i,e){
                                   console.log(e.value);
                                  $(e).prop("checked", true);
                                  $(e).parent().addClass("checked");
                                  orderList.push(e.value);
                              });
                          }else{
                              // console.log("un check all");
                              $(".icheckbox_square-green input[name='selection[]']").each(function(i,e){
                                  // console.log(e.value);
                                  $(e).prop("checked", false);
                                  $(e).parent().removeClass("checked");
                                  orderList = [];
                              });
                          }

                          // console.log(orderList);
                      }
                      // console.log(orderList);
                    //  alert(orderList[0]);
                      if(orderList.length > 0){
                        $(".btn-trasfer").attr("disabled",false);
                        $(".btn-trasfer").removeClass("btn-default");
                        $(".btn-trasfer").addClass("btn-primary");
                      }else{
                        $(".btn-trasfer").attr("disabled",true);
                        $(".btn-trasfer").removeClass("btn-primary");
                        $(".btn-trasfer").addClass("btn-default");
                      }
                  });
              });
    });