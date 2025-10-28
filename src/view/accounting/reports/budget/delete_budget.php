<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$ids = (int) $_POST['budget_id'];

            try {
                $budget_month = $record->query("DELETE FROM budget_month WHERE `budget_entry_id` IN (SELECT id FROM budget_entry WHERE `budget_id` = ?)", [$ids]);
                $budget_entry = $record->query("DELETE FROM budget_entry WHERE `budget_id` = ?", [$ids]);
                $budget = Db::getInstance()->query("DELETE FROM `budget` WHERE id = ?", [$ids]);
            
                echo '
                    <div class="alert alert-dismissible alert-warning">
                        Item removed successfully
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ';
            } catch (Exception $e) {
                // Log the error
                error_log($e->getMessage());
                echo '
                    <div class="alert alert-dismissible alert-danger">
                        Error removing item. Please try again.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ';
            }