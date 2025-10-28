<?php

require_once '../../core/init.php';

$bin_code =$_POST['bin_code'];

$record = Db::getInstance();

if(isset($bin_code) && $bin_code != ''){
                
               $find = $record->query("SELECT * FROM bin WHERE bin_code = 'bin_code'");
          
    
        try {
            
             if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Bin already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
            
        $record->insert('bin', array(
                'bin_code'              => Input::get('bin_code'),
                'description'           => Input::get('description'),
                'max_capacity'          => Input::get('max_capacity'),
			    'metric_type'           => Input::get('metric_type'),
			    'warehouse_id'          => Input::get('warehouse_id'),
				'added_by'              => Input::get('added_by')
            ));

            echo  '<div class="alert alert-dismissible alert-success">Bin added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
       
    }else{
                
                echo "<div class='alert alert-danger m-0'>Fill the boxes.</div>";
                
            }