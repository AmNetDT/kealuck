<?php

require_once '../../core/init.php';



$record = Db::getInstance();

$ids = $_POST['id'];



                            try {
                                
                            $record->update('chart_of_accounts_types', $ids, array(
                                    'title' => Input::get('title')
                                ));
                    
                                     echo  '<div class="alert alert-dismissible alert-success">Account type updated 
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                        </div>';
                                   
                                    
                                } catch (Exception $e) {
                                    
                                    die($e->getMessage());
                                    
                                }
                       