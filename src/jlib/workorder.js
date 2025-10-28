
                                           $(document).ready(function(e){
                                               
                                               //Input
                                               
                                                $(".addForminput").click(function(){   
                                                   //alert('welcome append')
                                                    $("#createinput").append("<div id='createformappendinput'><form name='myFormInput' id='myForm'><table id='red'><thead style='text-align:center'><th>Sequence</th><th>Description</th><th>SKU</th><th> Quantity </th><th> UOM </th></thead><tbody><tr><td><input type='text' id='sequence' class='form-control form-control-sm size_40_input' /></td><td><select class='form-control form-control-sm size_40_input' id=‘description’ name='description'><option value='description'> Description </option></select></td><td><select class='form-control form-control-sm size_40_input' id=’sku’ name='sku'><option value=’sku’>SKU</option></select></td><td><input type='text' id=‘quality’ name=‘quality’ class='form-control form-control-sm size_30_input' /></td><td><input type='text' id=‘uom’ name=‘uom’ class='form-control form-control-sm size_40_input' /></td></tr></tbody></table><div class='row justify-content-center'><table class='mt-3'><thead><tr><th>Estimated Cost</th><th>Estimated Amount</th><th>Additional Info</th><th></th></tr></thead><tbody><tr><td><input type='text' id=‘estimated_cost' name=‘estimated_cost’ class='form-control form-control-sm size_40_input' /></td><td><input type='text' id=‘estimated_amount' name=‘estimated_amount’ class='form-control form-control-sm size_40_input' /></td><td><input type='text' id=‘additional_info’ name=‘additional_info’ class='form-control form-control-sm size_60_input' /></td><td><button type='button' id='save_work_operation' name='save_work_operation' class='py-1 px-2 border mx-0 farm-button-blend'>Save</button></td></tr></tbody></table></div></form></div>");  
                                                    $('#closeInput').show();
                                                }); 
                                          
                                                $('#createinput').css('display', 'none');
                                                
                                                $('.addForminput').click('on', function(){
                                                    //alert('welcome');
                                                    
                                                    $('#createinput').show();
                                                    $('#createforminput').hide();
                                                    
                                                });
                                                
                                                $('#closeInput').click('on', function(){
                                                    $('#closeInput').hide();
                                                    $('#createformappendinput').remove();
                                                    $('#createforminput').show();
                                                    
                                                });
                                                
                                                //Work Operation
                                                
                                                $(".addFormclick").click(function(){   
                                                   //alert('welcome append')
                                                    $("#createform").append("<div id='createformappend'><form name='myForm' id='myForm'><div class='row'><div class='col-sm-12 text-right text-sm mr-5 pr-5 bg-light'>Planned</div></div><table id='red'><thead style='text-align:center'><th>Sequence</th><th>Description</th><th>Key</th><th>Cost per hour</th><th>Days</th><th>Hours</th><th>Minutes</th><th>Estimated Cost</th></thead><tbody><tr><td><input type='text' id='sequence' class='form-control form-control-sm size_70_input' /></td><td><input type='text' id='description' class='form-control form-control-sm' /></td><td><select class='form-control form-control-sm size_100_input' id='key' name='key'><option value='Normal'>Assemble</option><option value='Medium'>Disassemble</option><option value='High'>Planning</option></select></td><td><input type='text' id='cost_per_hour' class='form-control form-control-sm size_90_input' /></td><td><input type='text' id='days' class='form-control form-control-sm size_30_input' /></td><td><input type='text' id='hours' class='form-control form-control-sm size_30_input' /></td><td><input type='text' id='minutes' class='form-control form-control-sm size_40_input' /></td><td><input type='text' id='estimated_cost' class='form-control form-control-sm size_100_input' /></td></tr></tbody></table><div class='row'><div class='col-sm-12 text-right text-sm mr-5 pr-5 bg-light'>Realized</div></div><table><thead style='text-align:center'><th>Days</th><th>Hours</th><th>Minutes</th><th>Actual Cost</th><th>Assign to</th><th>Additional info.</th><th>&nbsp;</th></thead><tbody><tr><td><input type='text' id='actual_day' name='actual_day' class='form-control form-control-sm size_70_input' /></td><td><input type='text' id='actual_hours' name='actual_hours' class='form-control form-control-sm' /></td><td><input type='text' id='actual_minutes' name='actual_minutes' class='form-control form-control-sm size_90_input' /></td><td><input type='text' id='actual_cost' name='actual_cost' class='form-control form-control-sm size_90_input' /></td><td><select class='form-control form-control-sm size_100_input' id='assign_to' name='assign_to'><option value='Normal'>Assemble</option><option value='Medium'>Disassemble</option><option value='High'>Planning</option></select></td><td><input type='text' id='additional_info' name='additional_info' class='form-control form-control-sm size_100_input' /></td><td><button type='button' id='save_work_operation' name='save_work_operation' class='py-1 px-2 border mx-0 farm-button-blend'>Save</button></td></tr></tbody></table></form></div>");  
                                                    $('#closeWO').show();
                                                }); 
                                          
                                                $('#createform').css('display', 'none');
                                                
                                                $('.addFormclick').click('on', function(){
                                                    //alert('welcome');
                                                    
                                                    $('#createform').show();
                                                    $('#createformclick').hide();
                                                    
                                                });
                                                
                                                $('#closeWO').click('on', function(){
                                                    $('#closeWO').hide();
                                                    $('#createformappend').remove();
                                                    $('#createformclick').show();
                                                    
                                                });
                                                
                                                
                                                //Output
                                                
                                                $(".addFormOutput").click(function(){   
                                                   //alert('welcome append')
                                                    $("#createOutput").append("<div id='createformappendOutput'><form name='myFormInput' id='myForm'><table id='red'><thead style='text-align:center'><th>Sequence</th><th>Description</th><th>SKU</th><th> Quantity </th><th> UOM </th></thead><tbody><tr><td><input type='text' id='sequence' class='form-control form-control-sm size_40_input' /></td><td><select class='form-control form-control-sm size_40_input' id=‘description’ name='description'><option value='description'> Description </option></select></td><td><select class='form-control form-control-sm size_40_input' id=’sku’ name='sku'><option value=’sku’>SKU</option></select></td><td><input type='text' id=‘quality’ name=‘quality’ class='form-control form-control-sm size_30_input' /></td><td><input type='text' id=‘uom’ name=‘uom’ class='form-control form-control-sm size_40_input' /></td></tr></tbody></table><div class='row justify-content-center'><table class='mt-3'><thead><tr><th>Stock Price</th><th>Stock Amount</th><th>Additional Info</th><th></th></tr></thead><tbody><tr><td><input type='text' id=‘stock_price' name=‘stock_price’ class='form-control form-control-sm size_40_input' /></td><td><input type='text' id=‘stock_amount' name=‘stock_amount’ class='form-control form-control-sm size_40_input' /></td><td><input type='text' id=‘additional_info’ name=‘additional_info’ class='form-control form-control-sm size_60_input' /></td><td><button type='button' id='save_work_operation' name='save_work_operation' class='py-1 px-2 border mx-0 farm-button-blend'>Save</button></td></tr></tbody></table></div></form></div>");  
                                                    $('#closeOutput').show();
                                                }); 
                                          
                                                $('#createOutput').css('display', 'none');
                                                
                                                $('.addFormOutput').click('on', function(){
                                                    //alert('welcome');
                                                    
                                                    $('#createOutput').show();
                                                    $('#createformOutput').hide();
                                                    
                                                });
                                                
                                                $('#closeOutput').click('on', function(){
                                                    $('#closeOutput').hide();
                                                    $('#createformappendOutput').remove();
                                                    $('#createformOutput').show();
                                                    
                                                });
                                                
                                                e.preventDefault();
                                           });
                                      