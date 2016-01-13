<?php
App::uses('AppModel', 'Model');

class Service extends AppModel {	
	public $displayField = 'name';

	public $validate = array(
        'name' => array(
            'minLength' => array(
				'rule' => array('minLength', 1),
				'required' => true,
				'allowEmpty' => false,
				'message'  => 'The name is required'
			),
        ),
    );
}
?>