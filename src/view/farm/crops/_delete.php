<?php

require_once '../../core/init.php';

$record = Db::getInstance();
$ids = (int) $_POST['id'];
$table_name = $_POST['table_name'];

            try {
              
            
                $crop_type = Db::getInstance()->query("DELETE FROM `{$table_name}` WHERE id = ?", [$ids]);
            
                echo '
                    <div class="alert alert-dismissible alert-success">
                        Season Removed Successfully
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