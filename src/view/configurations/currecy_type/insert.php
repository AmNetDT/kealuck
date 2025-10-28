<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$name   = $_POST['name'];

    
    
    if($name === ''){
        
        echo  '<div class="alert alert-dismissible alert-danger">Enter a value currency name
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                                
    }else{
        try {
            
        $record->insert('currency', array(
                'name'          => Input::get('name'),
                'sign'          => Input::get('sign'),
                'color'         => Input::get('color'),
                'country'       => Input::get('country')
            ));

                echo  '<div class="alert alert-dismissible alert-success">Currency initiated
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
    }