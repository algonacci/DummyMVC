<?php
/*
 * App Core Class
 * Creates URL & loads more controller
 * URL FORMAT - /controller/method/params
 */

class Core
{
 protected $_currentController = "Pages";
 protected $_currentMethod     = "index";
 protected $_params            = [];

 public function __construct()
 {
  $url = $this->getUrl();

  if (isset($url[0]) && file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
   $this->currentController = ucwords($url[0]);
   unset($url[0]);
  }

  require_once "../app/controllers/" . $this->_currentController . ".php";

  $this->_currentController = new $this->_currentController;

  if (isset($url[1])) {
   if (method_exists($this->currentController, $url[1])) {
    $this->_currentMethod = $url[1];
    unset($url[1]);
   }
  }
  $this->_params = $url ? array_values($url) : [];
  call_user_func_array([$this->_currentController, $this->_currentMethod], $this->_params);
 }

 public function getUrl()
 {
  if (isset($_GET["url"])) {
   $url = rtrim($_GET["url"], "/");
   $url = filter_var($url, FILTER_SANITIZE_URL);
   $url = explode("/", $url);
   return $url;
  }
 }
}
