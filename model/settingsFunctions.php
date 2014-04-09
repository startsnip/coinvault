<?php

function getConnection() {
  $dsn = 'mysql:host=localhost;dbname=inaudib1_coinvault';
  $username = 'inaudib1_iclient';
  $password = 'rsWgbE4ufpyFGkeMntss4Zbjny';

  try {
    $db = new PDO($dsn, $username, $password);
  } catch (PDOException $e) {
    $errorMessage = $e->getMessage();
    include("/errors/index.php");
    exit();
  }
  return $db;
}

function changeDisplayName($newName, $email) {
  $conn = getConnection();
  
  try {
    $sql = "UPDATE users SET displayName=:newName WHERE email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':newName', $newName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function changePassword($email, $hash) {
  $conn = getConnection();
  
  try {
    $sql = "UPDATE users SET hash=:hash WHERE email=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function getUser($email) {
  $conn = getConnection();
  
  try {
    $sql = "SELECT displayName, isAdmin FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $displayName = $stmt->fetch();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include '/errors/index.php';
  }
  return $displayName;
}

function hashPassword($password) {
  if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
    return crypt($password, $salt);
  }
}

function getHash($email) {
  $conn = getConnection();

  $sql = "SELECT hash FROM users WHERE email = :email";

  try {
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $hash = $stmt->fetch();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include '/view/signup.php';
  }
  return $hash['hash'];
}

function userVerify($password, $hashedPassword) {
  return crypt($password, $hashedPassword) == $hashedPassword;
}
?>