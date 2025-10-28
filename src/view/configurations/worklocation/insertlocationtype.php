<?php

require_once '../../core/init.php';


$record = Db::getInstance();

$description = $_POST['description'];


    if(isset($description) && $description !== ''){
                
               $find = $record->query("SELECT * FROM worklocation_type WHERE description = '$description'");
          
    
        try {
            
             if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Location type already added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
        $record->insert('worklocation_type', array(
                'description'     => Input::get('description')
            ));

                echo  '<div class="alert alert-dismissible alert-success">Location type added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                    	
                     }
                     
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
       
       
    }else{
                
                echo "<div class='alert alert-danger m-0'>Fill in a location type</div>";
                
            }
        
  