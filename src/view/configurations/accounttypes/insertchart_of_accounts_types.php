<?php

require_once '../../core/init.php';



$record = Db::getInstance();

$title = $_POST['title'];



        if(isset($title) && $title != ''){
                
               $find = $record->query("SELECT * FROM chart_of_accounts_types WHERE title = '$title'");
          
                    if($find->count()){
                          
                            echo  '<div class="alert alert-dismissible alert-danger">Account type already exist
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                           
                        }else{
                            
                            try {
                                
                            $record->insert('chart_of_accounts_types', array(
                                    'title'           => Input::get('title')
                                ));
                    
                                    echo  '<div class="alert alert-success"> Account type created</div>';
                                    
                                } catch (Exception $e) {
                                    
                                    die($e->getMessage());
                                    
                                }
                        }
                        
        }else{
                                    
                                   
                        echo  '<div class="alert alert-dismissible alert-danger">Check the input something is wrong
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
                
                             }
        