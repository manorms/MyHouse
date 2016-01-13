<?php
App::uses('AppModel', 'Model');

class Profile extends AppModel {	
	public $displayField = 'name';
    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        return null;
    }
 
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