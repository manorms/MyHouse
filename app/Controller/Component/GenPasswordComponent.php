  <?php
App::uses('Set', 'Utility');
class GenPasswordComponent extends Component 
{
	public $components = array('GenPassword','Email');
	//public $controller ;
	//function startup($controller) { $this->controller = $controller; }
	public function genRandomPassword($length,$security_level) {   //FUNCION PARA CREAR UNA CLAVE ALEATORIA 
		$characters = array( 
		'0' => '12064218090752146890865493241608764869874987234986502758434198476556437281678902321309183279476597864598716473601236491876504165041873650187405945675648659841765019873098712873978464850389743431256576570987193265239387435473929298984654672998129196349816531098564976504750746095879874213059',
		'1' => 'mnblkjhpoiuuvcxzgytfdsaqwerelkytdmjqpiyedcmkvczzqwreagjgdvkmbfsascoplmqazxsedvfgjyrenmiyjlopqwertyuisdjlkasjdmmnbmnbnzvxckoleiwuryiuwemkjsdhfmxkjdsfyetwruqwererpoiutilkajsdhfgjhmnbzxbnvcnxzvcaiuefhyiuadhfjlkjhjgasddqitroeqwrewptusasffdasdfsdafmnzalopkmjsadytwerywetrdkjsafdsazxcvnmkljytuyal',
		'2' => 'AQOIEKLMZLPOKNJIVBHUXCSFDAWQETRYUITHFBSMNCNMNBBNZXCLKJHFGASFDPOIUWQEIYTRQWERTYUIOPLKJHGFDSAZXCVBNMSDAFDSKFJLPOQWAZMZXLCKNMBFDASAGUYRWEQQWEPLIKISAMZASQWMCNZXOIEREEWMXOIEUYRMURXIERYTOILPOIQAZXWDECRVRTBFDNTGM5UYHYYMKLYLKOIUYTQWREWUSDFIUHGJLHGJIGHJUYTWUEIOASNMNFJHIDASUEFTRYUOPKJLCXCESRTFDSFDSF',
		'3' => '08wer76421zasde223098708rewr764fdgytu52761au2356812983678902134iukjnsmdsad9087654672384jkndsfdsfmnbcvzxadqewsfgrh546546tyjukilopplkahjgsdyutqwqe98127437834mndsfjkhlsdf87q4rjklasdb213576987987sffdgq34dfsrewtredsfwthtyi870132xvbasdf094698ertfg5498792574328543erdfdg29435jkhkjmpoiupadioqwelpoa',
		'4' =>'12m3456789PIoUaYp456TRnqEW36556ledDGHjK67fzLMNB36VC56665365X3651234g5b67y89PLMK1Insa9823c23JhNBiHUr3567YGVCw123456789xFTRDXZS345E65W546fgfsdg532152564376QW546sERvF546TGasfYsdfH7897978UJdfgy123t569876543EuRDFsadasfdfREDfdgEsdfgSWQA4576465df8s76f8d578gSWQAsdfgS2562546DGHGweyta45374dfsfdsdafY',
		'5' =>'12m3456789PI=?owUa.-_YpTRnqEWl*+eQ_-_.:ASdDkFGHJj}}0=)BVCXZ12(3%4&g!5!b67y89PLsMK1IcJhNBdiHU2rYxG{}V*C?bwb1#$%&/()=?ok{}+-234_-5__6789xFT!R3D4X#ZS%E()%=WA+*}{QW-_S_D.sE,Rv;F;T.G:Y;;,HUxx?J1}{2#%&/(3)t=5?f6v9-_8:;7:;6-.}{5_4+53+E{}5?2u#%&R(D)F=)R&%E#D/S9WQ=%A#S!W!Q!!!cAsS-_D:;GH:-_r}{%G%T%Y',
		);  
		$key='';
		for($i=0;$i<$length;$i++) { 			
		  $key .= $characters[$security_level][rand(0,289)];  
		}  
		return $key;  
	} 

	public function sendPassword($template,$subject,$to,$viewVars){
		$msg='';
		$title='';
		try{
			if (is_array($to) || preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',trim($to))){			
				$this->Email->template = '/Emails/html/'. $template; 
				// You can use customised thmls or the default ones you setup at the start 
				$this->Email->data = $viewVars; 
				//$this->controller->set('data', $viewVars); 
				$this->Email->to = $to; 
				$this->Email->subject = $subject; 
				
				$result = $this->Email->send();
				
				if($result){
					$msg = $template == 'reset_password' ? 'Se le ha enviado un nuevo password al E-mail:<br/>'. $to : 'E-mail has been send';
					$title= "success";
				}
				else{
					$title = 'danger';	
					$msg= 'E-mail has not been send, please try again. Error: '. $result;
				}
			}else{
				$title = 'danger';	
				$msg= 'E-mail has not been send invalid email:<br />'. $to ;						
			}		
		}
		catch(Exception $e){
			$title = 'danger';			
			$msg=  'E-mail can\'t  send - '.$e->getMessage();	
		}
		return array($title,$msg);
	}

}
?>