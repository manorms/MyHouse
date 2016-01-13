<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	public function dateFormatAfterFind($dateTimeString)
    {
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateTimeString)){
            list($y, $m, $d) = explode('-', $dateTimeString);
            $dateTimeString = "{$d}/{$m}/{$y}";
        }elseif (preg_match('/^\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2}$/', preg_replace('/\s+/', ' ', $dateTimeString)) ){
            list($dateString, $timeString) = explode(' ', $dateTimeString);
            list($y, $m, $d) = explode('-', $dateString);
            $dateTimeString = "{$d}/{$m}/{$y} {$timeString}";
        }
        return $dateTimeString;
    }

    public function dateFormatBeforeSave($dateTimeString)
    {
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dateTimeString)){
            list($d, $m, $y) = explode('/', $dateTimeString);
            $dateTimeString = "{$y}-{$m}-{$d}";
        }elseif (preg_match('/^\d{2}\/\d{2}\/\d{4}\s+\d{2}:\d{2}:\d{2}$/', $dateTimeString)){
            list($dateString, $timeString) = explode(' ', preg_replace('/\s+/', ' ', $dateTimeString));
            list($d, $m, $y) = explode('/', $dateString);
            $dateTimeString = "{$y}-{$m}-{$d} {$timeString}";
        }
        return $dateTimeString;
    }

	function equalTo( $field=array(), $compare_field=null )
	{
		foreach( $field as $key => $value ){
			$v1 = $value;
			$v2 = $this->data[$this->name][ $compare_field ];
			if($v1 !== $v2) {
				return FALSE;
			} else {
				continue;
			}
		}
		return TRUE;
	}
	function beforeFacebookLogin($user){
		//Logic to happen before a facebook login
		pr($user);
		pr('usjhbndnvfsdjnkfckjsdnfklsdjnfksdlj');
	}
	function afterFacebookLogin(){
		//Logic to happen after successful facebook login.
		$this->redirect($this->Auth->redirect());
	}

}
