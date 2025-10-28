<?php

require_once '../../core/init.php';

    // Check if 'id' is set in the POST request
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        
        $id = $_POST['id'];
        $name = $_POST['name'];
    
        try {
            
            // Perform the delete operation
            $user = Db::getInstance()->query("DELETE FROM `bin` WHERE id = ?", [$id]);
    
            if ($user->count()) {
                
                echo '<b>Bin</b> with '.  $name  .' deleted successfully.';
                
            } else {
                
                echo '<b>Bin</b> with ID '.  $name  .'  does not exist.';
                
            }
            
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
        
    } else {
        // Handle missing or empty 'id'
        die('Error: No valid ID provided.');
    }
