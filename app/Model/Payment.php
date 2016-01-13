<?php
App::uses('AppModel', 'Model');

class Payment extends AppModel {	
	public $displayField = 'description';

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
		'loan_id' => array(
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
        'Loan' => array(
            'className' => 'Loan',
            'foreignKey' => 'loan_id'
        )
	);
	

}
?>