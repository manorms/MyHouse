<?php
App::uses('AppModel', 'Model');

class Saving extends AppModel {	

	public $useTable = 'savings';
	public $displayField = 'comments';

	public $validate = array(
        'comments' => array(
			'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
				'rule' => array('minLength', 1),
				'required' => true,
				'allowEmpty' => false,
				'message'  => 'Este campo es obligatorio.'
			),
        ),
		'user_id' => array(
			'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
				'rule' => array('minLength', 1),
				'required' => true,
				'allowEmpty' => false,
				'message'  => 'Este campo es obligatorio.'
			),
        ),
		'date' => array(
			'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
				'rule' => array('minLength', 1),
				'required' => true,
				'allowEmpty' => false,
				'message'  => 'Este campo es obligatorio.'
			),
        ),
    );
	 
	 public $hasMany = array(
        'Deposit' => array(
            'className' => 'Deposit',
            'foreignKey' => 'saving_id'
        )
	);
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
	);
	

}
?>