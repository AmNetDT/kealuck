<?php

require_once '../../core/init.php';

//$name = $_POST['title'];

$record = Db::getInstance();


    $journal_id = $_POST['journal_id'];
    $account_type = $_POST['account_type'];
    $subsidiary_ledger_id = $_POST['subsidiary_ledger_id'];

        if(isset($journal_id) && !empty($subsidiary_ledger_id)){
                
               $findtax = $record->query("SELECT * FROM journal_entry WHERE journal_id = $journal_id AND subsidiary_ledger_id = $subsidiary_ledger_id AND account_type = $account_type");
          
    
               try{
               
                  
    
                    
                            $record->insert('journal_entry', array(
                                'journal_id'            => Input::get('journal_id'),
                                'account_type'          => Input::get('account_type'),
                                'subsidiary_ledger_id'  => Input::get('subsidiary_ledger_id'),
                                'debit'                 => Input::get('debit'),
                                'credit'                => Input::get('credit'),
                                'reference_no'          => Input::get('reference_no'),
                                'due_date'              => Input::get('due_date'),
                                'added_by'              => Input::get('added_by')
                            ));

            
                
                 echo  '<div class="alert alert-dismissible alert-success">Journal Entry Added
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                         </div>';
                         
                        
            } catch (Exception $e) {
                
                die($e->getMessage());
                
            }
        }