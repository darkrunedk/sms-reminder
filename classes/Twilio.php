<?php

class Twilio {
  private $_sid = "SID",
          $_authToken = "AUTH_TOKEN",
          $_from = "FROM_NUMBER",
          $_to,
          $_body;

  public function __construct($to, $body, $date = null) {
    $this->_to = $to;

    if (!empty($date)) {
      $date = date("j/m-Y H:i:s", strtotime($date));
      $this->_body = "Reminder: {$body}. For: {$date}.";
    } else {
      $this->_body = "Reminder: {$body}.";
    }
  }

  public function sendSMS() {
    $url = "https://api.twilio.com/2010-04-01/Accounts/" . $this->_sid . "/Messages.json";
    $data = array(
      'From' => $this->_from,
      'To' => $this->_to,
      'Body' => $this->_body
    );
    $post = http_build_query($data);
    $curl = curl_init($url);
    curl_setopt_array($curl, array(
      CURLOPT_POST => true,
      CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
      CURLOPT_USERPWD => "{$this->_sid}:{$this->_authToken}",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_POSTFIELDS => $post
    ));
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
  }
}

?>
