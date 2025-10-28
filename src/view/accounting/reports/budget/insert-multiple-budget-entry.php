<?php
require_once '../../core/init.php';
$record = Db::getInstance();
date_default_timezone_set('Africa/Lagos');
$month_amount = $_POST['month_amount'];
$budget_id = $_POST['budget_id'];

try {
   
        $budgetEntryData = [
            'budget_id'                         => Input::get('budget_id'),
            'chart_of_accounts_group_id'        => Input::get('chart_of_accounts_group_id'),
            'modifieddate'                      => date('Y-m-d H:i:s'),
            'createddate'                       => date('Y-m-d H:i:s'),
            'added_by'                          => Input::get('added_by')
        ];

        // Check if budget entry already exists
        $existingBudgetEntry = $record->query("SELECT * FROM budget_entry WHERE budget_id = $budget_id AND chart_of_accounts_group_id = '" . Input::get('chart_of_accounts_group_id') . "'")->first();
        if (!$existingBudgetEntry) {
            $record->insert("budget_entry", $budgetEntryData);
            $latestBudgetEntry = $record->query("SELECT * FROM budget_entry ORDER BY id DESC LIMIT 1")->first();
           
          
            $monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                foreach ($monthNames as $monthName) {
                    $record->insert("budget_month", [
                        'budget_entry_id'   => $latestBudgetEntry->id,
                        'budget_id'         => Input::get('budget_id'),
                        'month'             => $monthName,
                        'amount'            =>  Input::get('month_amount'),
                        'note'              =>  Input::get('note_month_amount')
                    ]);
                } 




             echo '<div class="alert alert-dismissible alert-success">Budget Created
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></div>';
                    } else {
                        echo '<div class="alert alert-dismissible alert-warning">Budget already exists!</div>';
                    }
                
            } catch (Exception $e) {
                die($e->getMessage());
            }
            
            
            

                