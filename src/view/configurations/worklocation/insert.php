<?php

require_once '../../core/init.php';

$location_code =$_POST['location_code'];
$location =$_POST['location'];

$record = Db::getInstance();

if(isset($location_code) && $location !== ''){
                
               $find = $record->query("SELECT * FROM worklocation WHERE location_code = '$location_code'");
          
    
        try {
            
             if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Work location already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
            
        $record->insert('worklocation', array(
                'location_code'     => Input::get('location_code'),
                'location'          => Input::get('location'),
                'worklocation_type_id' => Input::get('worklocation_type_id'),
                'address'           => Input::get('address'),
				'longitude'         => Input::get('longitude'),
                'latitude'          => Input::get('latitude'),
				'added_by'          => Input::get('added_by')
            ));

            echo  '<div class="alert alert-dismissible alert-success">Work location added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
       
    }else{
                
                echo "<div class='alert alert-danger m-0'>Fill in a Work location</div>";
                
            }