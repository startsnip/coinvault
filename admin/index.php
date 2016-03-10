<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/dashboardFunctions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/model/adminFunctions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/model/loginFunctions.php';

$categories = getCategories();

if (!is_array($_SESSION)) {
  session_set_cookie_params(60 * 60 * 24, '/');
  session_start();
}

if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

switch ($action) {
  case 'login':

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $storeUser = isset($_POST['storeUser']);
    $hash = getHash($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = "Please enter a valid email address";
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/landing.php';
      break;
    }
    
    if (userVerify($password, $hash)) {
      if ($storeUser) {
        setcookie('email', $email, time() + (60*60*24*7*2));
      }
      
      $_SESSION['email'] = $email;
      $_SESSION['isLoggedIn'] = true;
      
      $user = getUser($email);
  
      $_SESSION['displayName'] = $user['displayName'];
      $_SESSION['isAdmin'] = $user['isAdmin'];

      header('Location: /index.php');
      break;

    } else {
      $errorMessage = "Invalid login credentials, please try again.";
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/landing.php';
      break;
    }
    break;

  case 'logout':

    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), '', strtotime('-1 year'), $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    header('Location: /index.php');
    break;

  case 'userSettings':
    $title = "User Settings Panel";
    include $_SERVER['DOCUMENT_ROOT'] . "/admin/view/settings.php";
    break;

  case 'changeDisplayName':
    changeDisplayName($_POST['newDisplayName'], $_SESSION['email']);
    
    $user = getUser($_SESSION['email']);
    $_SESSION['displayName'] = $user['displayName'];
    $_SESSION['isAdmin'] = $user['isAdmin'];


    $errorMessage = "Name updated successfully!";
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/settings.php';
    // header('Location: /admin/index.php?action=userSettings');
    break;

  case 'changePassword':

    $currentPassword = $_POST['currentPassword'];
    $currentHash = getHash($_SESSION['email']);
    $password = $_POST['newPassword'];
    $passwordVerify = $_POST['newPasswordVerify'];

    if (empty($currentPassword) || empty($password) || empty($passwordVerify)) {
        $errorMessage = "All fields are required.";
        include $_SERVER[ 'DOCUMENT_ROOT'] . '/admin/view/settings.php';
        break;
      }

    if (userVerify($currentPassword, $currentHash)) {
      //validate password
      if (strcmp($password, $passwordVerify)) {
        $errorMessage = "The passwords did not match, please try again.";
        include $_SERVER[ 'DOCUMENT_ROOT'] . '/admin/view/settings.php';
        break;
      }

      if (!preg_match('`[A-z]`', $password)) {
        $errorMessage = "Password must contain at least one alphabetic character.";
        include $_SERVER[ 'DOCUMENT_ROOT'] . '/admin/view/settings.php';
        break;
      }

      if (strlen($password) < 8) {
        $errorMessage = "The password must be at least 8 characters long, please try again.";
        include $_SERVER[ 'DOCUMENT_ROOT'] . '/admin/view/settings.php';
        break;
      }

      changePassword($_SESSION['email'], hashPassword($password));
      $errorMessage = "Password updated successfully!";
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/settings.php';
    }
    break;

  case 'modifyCategory':
    $categoryDetails = getCategoryDetails($_POST['catID']);
    $catID = $categoryDetails['catID'];
    $catName = $categoryDetails['catName'];
    $catDescription = $categoryDetails['catDescrption'];
    $catImage = $categoryDetails['imageFront'];
    $activeTab = $_POST['activeTab'];

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
    $activeTab = $_POST['activeTab'];

    $title = "Edit: " . $coinDetails['coinName'];
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/modifyCoin.php'; // create page!
    break;

  case 'deleteCategory':
    deleteCategory($_POST['catID']);
    header('Location: /index.php');
    break;

  case 'deleteCoin':
    $catID = $_POST['catID'];
    deleteCoin($_POST['coinID']);
    $activeTab = $_POST['activeTab'];
    header("Location: /dashboard/index.php?action=displayCoins&catID=$catID&activeTab=$activeTab");
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
      header("Location: /index.php");
    }
    break;

  case 'commitCoinModifications':
    $catID = $_POST['catID'];
    $coinID = $_POST['coinID'];
    $coinName = htmlspecialchars($_POST['coinName']);
    $coinDescription = htmlspecialchars($_POST['coinDescription']);
    $coinImage = filter_var($_POST['imageLink'], FILTER_SANITIZE_URL);
    $year = $_POST['year'];
    $activeTab = $_POST['activeTab'];

    if (!filter_var($coinImage, FILTER_VALIDATE_URL)) {
      $errorMessage = "Invalid image link URL";
      $title = "Edit: " . $coinName;
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/modifyCoin.php';
    } else {
      commitCoinModifications($coinName, $coinDescription, $coinImage, $year, $coinID);
      header("Location: /dashboard/index.php?action=displayCoins&catID=$catID&activeTab=$activeTab");
    }
    break;

  case 'showAddCategory':
    $title = "Add a Category";
    include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/addCategory.php';
    break;

  case 'showAddCoin':
    $title = "Add a Coin";
    if (isset($_GET['catID'])) {
      $catID = $_GET['catID'];
    } else if (isset($_POST['catID'])) {
      $catID = $_POST['catID'];
    }

    $categoryDetails = getCategoryDetails($catID);
    $catName = $categoryDetails['catName'];
    $activeTab = $_POST['activeTab'];
    
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

      $categories = getCategories();
      $numCategories = count($categories, 0);
      $catID = $categories[$numCategories-1][0];

      if ($_POST['submitMore'] == 'true') {
        header("Location: /admin/index.php?action=showAddCategory");
      } else {
        header("Location: /dashboard/index.php?action=displayCoins&catID=$catID&activeTab=$numCategories");
      }
    }
    break;

  case "addCoin":
    $catID = $_POST['catID'];
    $coinName = htmlspecialchars($_POST['coinName']);
    $coinDescription = htmlspecialchars($_POST['coinDescription']);
    $year = $_POST['year'];
    $coinImage = filter_var($_POST['imageLink'], FILTER_SANITIZE_URL);
    $activeTab = $_POST['activeTab'];

    if (!filter_var($coinImage, FILTER_VALIDATE_URL)) {
      $errorMessage = "Invalid image link URL";
      include $_SERVER['DOCUMENT_ROOT'] . '/admin/view/addCoin.php';
    } else {
      addCoin($catID, $coinName, $coinDescription, $coinImage, $year);

      if ($_POST['submitMore'] == 'true') {
        header("Location: /admin/index.php?action=showAddCoin&catID=$catID&activeTab=$activeTab");
      } else {
        header("Location: /dashboard/index.php?action=displayCoins&catID=$catID&activeTab=$activeTab");
      }
    }
    break;

  default:
    $activeTab = 0;

    if($_SESSION['isAdmin']) {
      include $_SERVER['DOCUMENT_ROOT'] . "/index.php";
      break;
    } else {
      $title = "Administration Login";
      include $_SERVER['DOCUMENT_ROOT'] . "/admin/view/landing.php";
      break;
    }
}
?>