<?php

require $_SERVER[ 'DOCUMENT_ROOT'] . '/model/loginFunctions.php';

if (!is_array($_SESSION)) {
  session_set_cookie_params(60*60, '/');
  session_start();
}

if($_SESSION['isLoggedIn']) {
  $user = getUser($_SESSION['email']);
  
  $_SESSION['displayName'] = $user['displayName'];
  $_SESSION['isAdmin'] = $user['isAdmin'];
  
  header('location: /dashboard/');
  exit();
}

if (isset($_GET['action'])) {
  $action = $_GET['action'];
} else if (isset($_POST['action'])) {
  $action = $_POST['action'];
}

switch ($action) {
  case 'showSignup':
    $title = "Sign up";
    include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
    break;

  case 'showLogin':
    $title = "Login";
    header('Location: /index.php');
    
    break;

  case 'createAccount':
    //gather login parameters
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $passwordVerify = $_POST['passwordVerify'];
    $displayName = $_POST['displayName'];

    //validate inputs are complete
    if (empty($email) || empty($password) || empty($passwordVerify) || empty($displayName)) {
      $errorMessage = "All fields are required.";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
      break;
    }

    //validate email against database, must be unique
    if (userExists($email)) {
      $errorMessage = "A user with that email address has already registered.";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
      break;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = "Please enter a valid email address";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
      break;
    }

    //validate password
    if (strcmp($password, $passwordVerify)) {
      $errorMessage = "The passwords did not match, please try again.";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
      break;
    }

    if (!preg_match('`[A-z]`', $password)) {
      $errorMessage = "Password must contain at least one alphabetic character.";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
      break;
    }

    if (strlen($password) < 8) {
      $errorMessage = "The password must be at least 8 characters long, please try again.";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/signup.php';
      break;
    }

    // create user and forward to dashboard, display welcome page.
    try {
      createUser($email, hashPassword($password), $displayName);
    
      $_SESSION['email'] = $email;
      $_SESSION['isLoggedIn'] = true;
      
      $user = getUser($email);
  
      $_SESSION['displayName'] = $user['displayName'];
      $_SESSION['isAdmin'] = $user['isAdmin'];

      header('Location: /dashboard/index.php');
    } catch (Exception $ex) {
      $errorMessage = $ex->getMessage();
      include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
    }
    break;

  case 'login':
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $storeUser = isset($_POST['storeUser']);
    
    $hash = getHash($email);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = "Please enter a valid email address";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/landing.php';
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
      
      header('Location: /dashboard/index.php');
      
      break;
    } else {
      $errorMessage = "Invalid login credentials, please try again.";
      include $_SERVER['DOCUMENT_ROOT'] . '/view/landing.php';
      break;
    }
    break;
    
  case 'logout':
    $_SESSION = array();
    session_destroy();
    
    setcookie(session_name(), '', strtotime('-1 year'), $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    
    header('Location: /index.php');
    break;
    
  default:
    $title = "Welcome";
    include $_SERVER['DOCUMENT_ROOT'] . '/view/landing.php';
    
    break;
}
?>