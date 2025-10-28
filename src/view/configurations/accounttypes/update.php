<?php

require_once '../../core/init.php';

$id = $_POST['id'];

$record = Db::getInstance();

    
        try {
            
        $record->update('chart_of_accounts', $id, array(
                'gl_code'           => Input::get('gl_code'),
                'description'       => Input::get('description'),
                'category_id'       => Input::get('category_id'),
                'group_id'          => Input::get('group_id'),
                'added_by'          => Input::get('added_by')
            ));

             
                 echo  '<div class="alert alert-dismissible alert-success">  Subsidiary Account Updated
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
     