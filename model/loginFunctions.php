<?php

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

function userExists($email) {
  $conn = getConnection();

  $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->execute();

  if ($stmt->fetchColumn()) {
    return TRUE;
  } else {
    return FALSE;
  }
}

function hashPassword($password) {
  if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
    return crypt($password, $salt);
  }
}

function createUser($email, $hash, $name) {
  $conn = getConnection();

  try {
    $sql = "INSERT INTO users (email, hash, displayName)
           VALUES (:email, :hash, :displayName)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
    $stmt->bindParam(':displayName', $name, PDO::PARAM_STR);
    $stmt->execute();
    $count = (int)$stmt->rowCount();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    header('location: /errors/index..php');
    exit;
  }
  
  if ($count > 0) {
    return true;
  } else {
    return false;
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

?>