<?php
require_once '../../core/init.php';
$record = Db::getInstance();
date_default_timezone_set('Africa/Lagos');
$month_amount = $_POST['month_amount'];
$budget_id = $_POST['budget_id'];

try {
    if (empty($month_amount)) {
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
            

            $months = [
                'jan' => ['amount' => 'jan_amount', 'note' => 'jan_note'],
                'feb' => ['amount' => 'feb_amount', 'note' => 'feb_note'],
                'mar' => ['amount' => 'mar_amount', 'note' => 'mar_note'],
                'apr' => ['amount' => 'apr_amount', 'note' => 'apr_note'],
                'may' => ['amount' => 'may_amount', 'note' => 'may_note'],
                'jun' => ['amount' => 'jun_amount', 'note' => 'jun_note'],
                'jul' => ['amount' => 'jul_amount', 'note' => 'jul_note'],
                'aug' => ['amount' => 'aug_amount', 'note' => 'aug_note'],
                'sep' => ['amount' => 'sep_amount', 'note' => 'sep_note'],
                'oct' => ['amount' => 'oct_amount', 'note' => 'oct_note'],
                'nov' => ['amount' => 'nov_amount', 'note' => 'nov_note'],
                'dec' => ['amount' => 'dec_amount', 'note' => 'dec_note']
            ];
            
             $latestBudgetEntry = $record->query("SELECT * FROM budget_entry ORDER BY id DESC LIMIT 1")->first();
             
            foreach ($months as $month => $values) {
                $record->insert("budget_month", [
                    'month' => Input::get($month),
                    'budget_id' => Input::get('budget_id'),
                    'budget_entry_id' => $latestBudgetEntry->id,
                    'amount' => Input::get($values['amount']),
                    'note' => Input::get($values['note'])
                ]);
            }

             echo '<div class="alert alert-dismissible alert-success">Budget Created
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></div>';
                                
                    } else {
                        
                        echo '<div class="alert alert-dismissible alert-warning">Budget already exists!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></div>';
                                
                    }
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
            
            
            

                