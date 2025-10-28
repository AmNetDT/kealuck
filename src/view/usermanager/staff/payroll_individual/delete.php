<?php

require_once '../../core/init.php';


	$request_code   = $_POST['title'];
	$id             = $_POST['del'];
	
	
	
	  try {
                if($request_code != '' && $id != ''){
        
		$users = Db::getInstance()->query("DELETE FROM approval WHERE `request_code` = '$request_code'");            
		$use   = Db::getInstance()->query("DELETE FROM maintenance WHERE `id` = $id");
		
		 
		  echo  '<div class="alert alert-dismissible alert-warning">Deleted
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                       
                }
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
            
            
 	


		