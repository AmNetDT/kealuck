<?php

require_once '../../core/init.php';




		$user = Db::getInstance();
        
		try {
			$user->insert('departments', array(
				'name'      => Input::get('name'),
				'address'   => Input::get('location'),
				'phone'     => Input::get('phone'),
				'email'     => Input::get('email'),
				'added_by'  => Input::get('added_by')
			));

			
			echo  '<div class="alert alert-dismissible alert-success">Department Added
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>';
			
			
		} catch (Exception $e) {
			die($e->getMessage());
		}
		

