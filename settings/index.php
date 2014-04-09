<?php

require $_SERVER['DOCUMENT_ROOT'] . '/model/settingsFunctions.php';

if (!is_array($_SESSION)) {
	session_set_cookie_params(60 * 24, '/');
	session_start();
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
	case 'changeDisplayName':
	changeDisplayName($_POST['newDisplayName'], $_SESSION['email']);
	
	$user = getUser($_SESSION['email']);
	$_SESSION['displayName'] = $user['displayName'];
	$_SESSION['isAdmin'] = $user['isAdmin'];

	header('Location: /settings/index.php');
	break;

	case 'changePassword':

	$currentPassword = $_POST['currentPassword'];
	$currentHash = getHash($_SESSION['email']);
	$password = $_POST['newPassword'];
	$passwordVerify = $_POST['newPasswordVerify'];

	if (empty($currentPassword) || empty($password) || empty($passwordVerify)) {
      $errorMessage = "All fields are required.";
      include $_SERVER[ 'DOCUMENT_ROOT'] . '/settings/view/settings.php';
      break;
    }

	if (userVerify($currentPassword, $currentHash)) {
		//validate password
		if (strcmp($password, $passwordVerify)) {
			$errorMessage = "The passwords did not match, please try again.";
			include $_SERVER[ 'DOCUMENT_ROOT'] . '/settings/view/settings.php';
			break;
		}

		if (!preg_match('`[A-z]`', $password)) {
			$errorMessage = "Password must contain at least one alphabetic character.";
			include $_SERVER[ 'DOCUMENT_ROOT'] . '/settings/view/settings.php';
			break;
		}

		if (strlen($password) < 8) {
			$errorMessage = "The password must be at least 8 characters long, please try again.";
			include $_SERVER[ 'DOCUMENT_ROOT'] . '/settings/view/settings.php';
			break;
		}

		changePassword($_SESSION['email'], hashPassword($password));
		$errorMessage = "Success!";
		include $_SERVER['DOCUMENT_ROOT'] . '/settings/view/settings.php';
	}

	break;
	
	default:
	$title = "User Settings Panel";
	include $_SERVER['DOCUMENT_ROOT'] . "/settings/view/settings.php";
	break;
}

?>