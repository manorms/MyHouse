<?php
App::uses('AppModel', 'Model');

class Deposit extends AppModel {	
	public $displayField = 'comments';

	public $validate = array(
		'amount' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message'  => 'Este campo debe de ser un numero.'
			),
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
		'saving_id' => array(
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
	 
	public $belongsTo = array(
        'Saving' => array(
            'className' => 'Saving',
            'foreignKey' => 'saving_id'
        )
	);
	

}
?>