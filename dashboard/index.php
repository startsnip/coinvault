<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/dashboardFunctions.php';

if (!is_array($_SESSION)) {
  session_set_cookie_params(60 * 24, '/');
  session_start();
}

if ($_POST['action'] == 'logout') {
  $_SESSION = array();
  session_destroy();
  
  setcookie(session_name(), '', strtotime('-1 year'), $params['path'], $params['domain'], $params['secure'], $params['httponly']);
  
  header('Location: /index.php');
  break;
    
}

if(!$_SESSION['isLoggedIn']) {
  header('Location: /index.php');
}

if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

switch ($action) { 
  case 'displayItems':
  $catID = $_GET['catID'];

  $categories = getCategories();
  $items = getItems($catID);
  $title = $categories[0][1];

  include $_SERVER['DOCUMENT_ROOT'] . "/dashboard/view/items.php";
  break;

  case 'displayItem':
  $coinID = $_GET['coinID'];

  $categories = getCategories();
  $item = getItem($coinID);
  $title = $item[2];

  include $_SERVER['DOCUMENT_ROOT'] . "/dashboard/view/item.php";
  break;
  
  default: //display all categories
  $categories = getCategories();
  $title = "Coins by type";

  include $_SERVER['DOCUMENT_ROOT'] . '/dashboard/view/categories.php';
  break;
}

?>