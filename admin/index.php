<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/adminFunctions.php';

if (!is_array($_SESSION)) {
  session_set_cookie_params(60 * 60 * 24, '/');
  session_start();
}

if(!$_SESSION['isLoggedIn'] || !$_SESSION['isAdmin']) {
  header('Location: /index.php');
}

if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

switch ($action) {
  case 'userAdmin':
    $users = getUsers();
    $title = "User Administration";
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/userAdmin.php';
    break;

  case 'promoteUser':
    promoteUser($_POST['email']);
    header("Location: /admin/index.php?action=userAdmin");
    break;

  case 'demoteUser':
    demoteUser($_POST['email']);
    header("Location: /admin/index.php?action=userAdmin");
    break;

  case 'deleteUser':
    deleteUser($_POST['email']);
    header("Location: /admin/index.php?action=userAdmin");
    break;

  case 'contentAdmin':
    $categories = getCategories();
    $title = "Content Administration";
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/contentAdmin.php';
    break;

  case 'modifyCategory':
    $categoryDetails = getCategoryDetails($_POST['catID']);
    $catID = $categoryDetails['catID'];
    $catName = $categoryDetails['catName'];
    $catDescription = $categoryDetails['catDescrption'];
    $catImage = $categoryDetails['imageFront'];

    $title = "Edit: " . $categoryDetails['catName'];
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/modifyCategory.php';
    break;

  case 'modifyCoin':
    $coinDetails = getCoinDetails($_POST['coinID']);
    $coinID = $coinDetails['coinID'];
    $catID = $coinDetails['catID'];
    $coinName = $coinDetails['coinName'];
    $coinDescription = $coinDetails['coinDescription'];
    $coinImage = $coinDetails['coinImage'];
    $year = $coinDetails['year'];

    $title = "Edit: " . $coinDetails['coinName'];
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/modifyCoin.php'; // create page!
    break;

  case 'deleteCategory':
    deleteCategory($_POST['catID']);
    header('Location: /admin/index.php?action=contentAdmin');
    break;

  case 'deleteCoin':
    $catID = $_POST['catID'];
    deleteCoin($_POST['coinID']);
    header("Location: /admin/index.php?action=showCoinList&catID=$catID");
    break;

  case 'commitCategoryModifications':
    $catID = $_POST['catID'];
    $catName = htmlspecialchars($_POST['catName']);
    $catDescription = htmlspecialchars($_POST['catDescription']);
    $catImage = filter_var($_POST['imageLink'], FILTER_SANITIZE_URL);

    if (!filter_var($catImage, FILTER_VALIDATE_URL)) {
      $errorMessage = "Invalid image link URL";
      $title = "Edit: " . $catName;
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/modifyCategory.php';
    } else {
      commitCategoryModifications($catName, $catDescription, $catImage, $catID);
      header('Location: /admin/index.php?action=contentAdmin');
    }
    break;

  case 'commitCoinModifications':
    $catID = $_POST['catID'];
    $coinID = $_POST['coinID'];
    $coinName = htmlspecialchars($_POST['coinName']);
    $coinDescription = htmlspecialchars($_POST['coinDescription']);
    $coinImage = filter_var($_POST['imageLink'], FILTER_SANITIZE_URL);
    $year = $_POST['year'];

    if (!filter_var($coinImage, FILTER_VALIDATE_URL)) {
      $errorMessage = "Invalid image link URL";
      $title = "Edit: " . $coinName;
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/modifyCoin.php';
    } else {
      commitCoinModifications($coinName, $coinDescription, $coinImage, $year, $coinID);
      header("Location: /admin/index.php?action=showCoinList&catID=$catID");
    }
    break;

  case 'showAddCategory':
    $title = "Add a Category";
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/addCategory.php';
    break;

  case 'showAddCoin':
    $title = "Add a Coin";
    $catID = $_POST['catID'];
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/addCoin.php';
    break;

  case "addCategory": 
    $catName = htmlspecialchars($_POST['catName']);
    $catDescription = htmlspecialchars($_POST['catDescription']);
    $catImage = filter_var($_POST['imageLink'], FILTER_SANITIZE_URL);

    if (!filter_var($catImage, FILTER_VALIDATE_URL)) {
      $errorMessage = "Invalid image link URL";
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/addCategory.php';
    } else {
      addCategory($catName, $catDescription, $catImage);
      header('Location: /admin/index.php?action=contentAdmin');
    }
    break;

  case "addCoin": 
    $catID = $_POST['catID'];
    $coinName = htmlspecialchars($_POST['coinName']);
    $coinDescription = htmlspecialchars($_POST['coinDescription']);
    $year = $_POST['year'];
    $coinImage = filter_var($_POST['imageLink'], FILTER_SANITIZE_URL);

    if (!filter_var($coinImage, FILTER_VALIDATE_URL)) {
      $errorMessage = "Invalid image link URL";
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/addCoin.php';
    } else {
      addCoin($catID, $coinName, $coinDescription, $coinImage, $year);
      header("Location: /admin/index.php?action=showCoinList&catID=$catID");
    }
    break;

  case 'showCoinList':
    $catID = $_GET['catID'];
    $coins = getCoins($_GET['catID']);
    $title= "Category Listing - " . $catID;
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/categoryAdmin.php';
    break;

  default:
    $title = "Administration Panel";
    include $_SERVER['DOCUMENT_ROOT'] . "/admin/view/admin.php";
    break;
}

?>