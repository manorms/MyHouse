<?php
App::uses('AppModel', 'Model');

class Loan extends AppModel {	
	public $displayField = 'description';

	public $validate = array(
        'description' => array(
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
		'borrower_id' => array(
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
        'Payment' => array(
            'className' => 'Payment',
            'foreignKey' => 'loan_id',
            'conditions' => array('Payment.active' => '1'),
        )
	);
	public $belongsTo = array(
        'Lender' => array(
            'className' => 'User',
            'foreignKey' => 'lender_id'
        ),
		'Borrower' => array(
            'className' => 'User',
            'foreignKey' => 'borrower_id'
        )
	);
	

}
?>