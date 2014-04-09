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

function getCategories() {
  $conn = getConnection();
  
  try {
    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
  if (is_array($categories)) {
    return $categories;
  } else {
    $errorMessage = "There are no categories to display.";
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function getItems($catID) {
  $conn = getConnection();

  try {
    $sql = "SELECT * FROM coins WHERE catID = :catID ORDER BY year DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetchAll();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
  if (is_array($items)) {
    return $items;
  } else {
    $errorMessage = "There are no categories to display.";
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function getItem($coinID) {
  $conn = getConnection();

  try {
    $sql = "SELECT * FROM coins WHERE coinID = :coinID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':coinID', $coinID, PDO::PARAM_INT);
    $stmt->execute();
    $items = $stmt->fetch();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
  if (is_array($items)) {
    return $items;
  } else {
    $errorMessage = "There are no categories to display.";
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

?>