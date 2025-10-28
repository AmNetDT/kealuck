<?php

require_once '../../core/init.php';

//$name = $_POST['title'];

$record = Db::getInstance();


    
        try {
            
        $record->insert('equipmenttype', array(
                'title'             => Input::get('title'),
                'added_by'          => Input::get('added_by')
            ));

              
                	echo  '<div class="alert alert-dismissible alert-success">New equipment type added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
      