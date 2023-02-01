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

  if (file_exists("../app/controllers/" . ucwords($url[0]) . ".php")) {
   $this->currentController = ucwords($url[0]);
   unset($url[0]);
  }

  require_once "../app/controllers/" . $this->_currentController . ".php";

  $this->currentController = new $this->_currentController;

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
