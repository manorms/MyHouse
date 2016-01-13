<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
    function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->virtualFields['full_name'] = sprintf('CONCAT(%s.name, " ", %s.first_last_name, " ", %s.second_last_name)', $this->alias, $this->alias, $this->alias);
    }

	public $displayField = 'full_name';

    public $actsAs = array('Acl' => array('type' => 'requester'));

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['profile_id'])) {
            $groupId = $this->data['User']['profile_id'];
        } else {
            $groupId = $this->field('profile_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Profile' => array('id' => $groupId));
        }
    }

    public $belongsTo = array(
		'Profile' => array(
			'className' => 'Profile',
			'foreignKey' => 'profile_id',
			'conditions' => '',
			'fields' => array('id', 'name'),
			'order' => ''
		)
	);

    public function beforeSave($options = array())
	{
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        if (isset($this->data[$this->alias]['expiration'])) {
            $this->data[$this->alias]['expiration'] = $this->dateFormatBeforeSave($this->data[$this->alias]['expiration']);
        }
        return true;
    }
    //Add an email field to be saved along with creation.

    public $validate = array(
        'username'  => array(
            'notEmpty' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Longitud min. 5.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Este Username ya esta en uso, intente con otro.'
            )
        ),
		'name'  => array(
			'required'   => array(
                'rule'  => array( 'notEmpty' ),
                'message' => 'Este campo es obligatorio.',
            ),
		),
		'first_last_name'  => array(
			'required'   => array(
                'rule'  => array( 'notEmpty' ),
                'message' => 'Este campo es obligatorio.',
            ),
		),
		'password'  => array(
            'required' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Longitud Min. 5'
            ),
        ),
		'old_password'  => array(
            'required' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Longitud Min. 5'
            ),
        ),
		'confirm_password'  => array(
            'required' => array(
                'rule'    => 'notEmpty',
                'message' => 'Este campo es obligatorio.',
            ),
            'minLength' => array(
                'rule' => array('minLength', 5),
                'message' => 'Longitud Min. 5'
            ),
			'equalTo'   => array(
			'rule'  => array( 'equalTo', 'password' ),
			'message' => 'Los Passwords no coinciden.',
            )
        ),

    );
	/*'unique' => array(
				'rule' => 'isUnique',
				'message'  => 'The code is unique'
			),
		*/
}
