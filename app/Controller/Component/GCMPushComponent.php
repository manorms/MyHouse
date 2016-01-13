<?php
App::uses('Set', 'Utility');
class GCMPushComponent extends Component
{


public function send($data){
  $apiKey = "AIzaSyCsA4KTzdw9A8MTHAEsWJe-fFQiDQtGQVQ"; //api key
  $gcpm = new GCMPushMessage($apiKey);
  $devices = $this->getDevices([$data['loan']['lender_id'],$data['loan']['borrower_id']]);
  $gcpm->setDevices($devices);
  $to_send= [
    'title' => 'MyHouse',
    'icon' => 'http://myhouse.alpha-soluciones.com/app/webroot/img/drawable-hdpi/ic_stat_default.png',
    'message' => $data['type'] .' - ' . $data['loan']['description'],
    'style' => "inbox",
    'ledColor' => [0,200,40,50],
    'summaryText' => "Tienes %n% notificaciones",
    // 'actions'=> [
    // 	[ 'icon'=> "emailGuests", 'title'=> "EMAIL GUESTS", 'callback'=> "app.emailGuests"],
    // 	[ 'icon'=> "snooze", 'title'=> "SNOOZE", 'callback'=> "app.snooze"],
    // ]
  ];
  $response = $gcpm->send($to_send); //title of the message
  return $response;
}
private function getDevices($users_id){
  $model = ClassRegistry::init('User');
  $devices = $model->query("SELECT device_id from `devices_users` INNER JOIN users  ON (user_id= users.id) WHERE user_id IN (" . implode(',',$users_id) .') AND notifications_app=1;');

  $devices = Set::classicExtract($devices,'{n}.devices_users.device_id');
  return $devices;
}
}


class GCMPushMessage {
  var $url = 'https://android.googleapis.com/gcm/send';
  var $serverApiKey = "";
  var $devices = array();

  function __construct ($apiKeyIn){
      $this->serverApiKey = $apiKeyIn;
  }
  function setDevices($deviceIds){

      if(is_array($deviceIds)){
          $this->devices = $deviceIds;
      } else {
          $this->devices = array($deviceIds);
      }

  }
  function send( $data = false){

      if(!is_array($this->devices) || count($this->devices) == 0){
          $this->error("No devices set");
      }

      if(strlen($this->serverApiKey) < 8){
          $this->error("Server API Key not set");
      }

      $fields = array(
          'registration_ids'  => $this->devices,
          'data'              => array( "message" => $data['message'] ),
      );

      if(is_array($data)){
          foreach ($data as $key => $value) {
              $fields['data'][$key] = $value;
          }
      }
      $headers = array(
          'Authorization: key=' . $this->serverApiKey,
          'Content-Type: application/json'
      );
      $ch = curl_init();

      curl_setopt( $ch, CURLOPT_URL, $this->url );

      curl_setopt( $ch, CURLOPT_POST, true );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

      curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);

      $result = curl_exec($ch);

      curl_close($ch);

      return $result;
  }

  function error($msg){
      echo "Android send notification failed with error:";
      echo "\t" . $msg;
      exit(1);
  }
}
