<?php
/**
 * [FireBaseAPI This is to enable you load this library in codeigniter.
 * use $this->library->load('FireBaseAPI'); you must have already copied this
 * file into 'application/libraries' folder.]
 */
class FireBaseAPI {
  static function getName() {
    return "FireBaseAPI";
  }
}
class FireBasePayLoad {

  private $url = "https://fcm.googleapis.com/fcm/send";
  private $fields = array();
  private $key;
  private $notification;
  private $restrictedPackageName;
  private $ch;

  /**
   * [setDeviceId sets the id of the device to send pyload to.]
   * @param [string] $to [unique device id.]
   */
  function setDeviceId($deviceId) {
    $this->fields['to'] = $deviceId;
  }

  /**
   * [setTopic sets the topic of payload]
   * @param [string] $topic [the topic od the payload without the
   *                        /topics/.. prefix.]
   */
  function setTopic($topic) {
    $this->fields['to'] = "/topics/$topic";
  }

  /**
   * [setKey Your Google API Authorization Key.]
   * @param [string] $key [unique keey for accessing the Firebase Cloud Messaging
   *                      service.]
   */
  function setKey($key) {
    $this->key = $key;
  }
  function setNotification($notification) {
    $this->fields['notification'] = $notification;
  }
  function setRestrictedPackageName($pkgName) {
    $this->fields['restricted_package_name'] = $pkgName;
  }
  function setData($data) {
    $this->fields['data'] = $data;
  }
  function send() {
    $headers = array('Content-Type:application/json', 'Authorization:key=' . $this->key);
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_URL, $this->url);
    curl_setopt($this->ch, CURLOPT_POST, true);
    curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($this->ch, CURLOPT_POSTFIELDS, json_encode($this->fields));
    return curl_exec($this->ch);
  }
  function getCH() {
    return $this->ch;
  }
  function closeCH() {
    curl_close($this->ch);
  }
}
class FireBaseNotification {
  private $obj = array();
  function setTitle($title) {
    $this->obj['title'] = $title;
  }
  function setBody($body) {
    $this->obj['body'] = $body;
  }
  function setIcon($icon) {
    $this->obj['icon'] = $icon;
  }
  function setClickAction($action) {
    $this->obj['click_action'] = $action;
  }
  function getPayload() {
    return $this->obj;
  }
}
?>
