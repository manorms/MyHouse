<?php
App::uses('AppModel', 'Model');

class Expense extends AppModel {
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
        'House' => array(
            'className' => 'House',
            'foreignKey' => 'house_id'
        ),
		'Buyer' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
	);

	public $hasAndBelongsToMany = array(
		'Perro' => array(
            'className' => 'User',
			'joinTable' => 'expenses_users',
			'foreignKey' => 'expense_id',
			'associationForeignKey' => 'user_id',
			'fields' => ['name', 'first_last_name']
        )
    );
}
?>
