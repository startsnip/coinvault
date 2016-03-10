<?php

// import dashboard functions
require $_SERVER['DOCUMENT_ROOT'] . '/model/dashboardFunctions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/model/adminFunctions.php';

// create session if not already created
if (!is_array($_SESSION)) {
  session_set_cookie_params(60 * 24, '/');
  session_start();
}

// parse the action variables
if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

switch ($action) {
  case 'displayCoins':
    $catID = $_GET['catID'];
    $categories = getCategories();
    $categoryDetails = getCategoryDetails($catID);
    $catName = $categoryDetails['catName'];
    $catDescription = $categoryDetails['catDescrption'];
    $catImage = $categoryDetails['imageFront'];
    
    $activeTab = $_GET['activeTab'];

    $items = getItems($catID);
    $title = $categories[0][1];
  
    include $_SERVER['DOCUMENT_ROOT'] . "/dashboard/view/coins.php";
    break;
    
  case 'presentation':
    $categories = getCategories();
    $title = "Class Presentation";
    $activeTab = 0;
    
    include $_SERVER['DOCUMENT_ROOT'] . '/dashboard/view/presentation.php';
    break;
  
  default: //display all categories
    $categories = getCategories();
    $title = "Welcome!";
    $activeTab = 0;
  
    include $_SERVER['DOCUMENT_ROOT'] . '/dashboard/view/categories.php';
    break;
}

?>