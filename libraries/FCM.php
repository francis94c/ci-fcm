<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FCM
{
  /**
   * [private description]
   * @var [type]
   */
  private $ci;

  /**
   * [__construct description]
   * @date 2020-02-17
   */
  function __construct()
  {
    $this->ci =& get_instance();
  }
  
  /**
   * [push description]
   * @param  [type] $payload [description]
   * @return [type]          [description]
   */
  function push($payload) {

  }
}
class FireBasePayLoad {
    private $url = "https://fcm.googleapis.com/fcm/send";
    private $fields = array();
    private $key;
    private $notification;
    private $restrictedPackageName;
    private $ch;
    function setTo($to) {
        $this->fields['to'] = $to;
    }
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
    function push() {
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
