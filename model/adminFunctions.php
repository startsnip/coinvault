<?php

function getCategoryDetails($catID) {
  $conn = getConnection();
  
  try {
    $sql = "SELECT * FROM categories WHERE catID = :catID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
    $stmt->execute();
    $categoryDetails = $stmt->fetch();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
  if (is_array($categoryDetails)) {
    return $categoryDetails;
  } else {
    $errorMessage = "There are no categories to display.";
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}
function getCoinDetails($coinID) {
  $conn = getConnection();
  
  try {
    $sql = "SELECT * FROM coins WHERE coinID = :coinID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':coinID', $coinID, PDO::PARAM_INT);
    $stmt->execute();
    $coinDetails = $stmt->fetch();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
  if (is_array($coinDetails)) {
    return $coinDetails;
  } else {
    $errorMessage = "There are no categories to display.";
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function commitCategoryModifications($catName, $catDescrption, $imageFront, $catID) {
  $conn = getConnection();
  
  try {
    $sql = "UPDATE categories SET catName=:catName, catDescrption=:catDescrption, imageFront=:imageFront WHERE catID=:catID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catName', $catName, PDO::PARAM_STR);
    $stmt->bindParam(':catDescrption', $catDescrption, PDO::PARAM_STR);
    $stmt->bindParam(':imageFront', $imageFront, PDO::PARAM_STR);
    $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function commitCoinModifications($coinName, $coinDescription, $coinImage, $year, $coinID) {
  $conn = getConnection();
  
  try {
    $sql = "UPDATE coins SET coinName=:coinName, coinDescription=:coinDescription, coinImage=:coinImage, year=:year WHERE coinID=:coinID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':coinName', $coinName, PDO::PARAM_STR);
    $stmt->bindParam(':coinDescription', $coinDescription, PDO::PARAM_STR);
    $stmt->bindParam(':coinImage', $coinImage, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_STR);
    $stmt->bindParam(':coinID', $coinID, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function deleteCategory($catID) {
  $conn = getConnection();

  try {
    $sql = "DELETE FROM categories WHERE catID=:catID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function deleteCoin($coinID) {
  $conn = getConnection();

  try {
    $sql = "DELETE FROM coins WHERE coinID=:coinID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':coinID', $coinID, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/errors/index.php';
  }
}

function addCategory($catName, $catDescription, $catImage) {
  $conn = getConnection();

  try {
    $sql = "INSERT INTO categories (catName, catDescrption, imageFront)
           VALUES (:catName, :catDescription, :catImage)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catName', $catName, PDO::PARAM_STR);
    $stmt->bindParam(':catDescription', $catDescription, PDO::PARAM_STR);
    $stmt->bindParam(':catImage', $catImage, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    header('location: /errors/index.php');
    exit;
  }
}

function addCoin($catID, $coinName, $coinDescription, $imageLink, $year) {
  $conn = getConnection();

  try {
    $sql = "INSERT INTO coins (catID, coinName, coinDescription, coinImage, year)
           VALUES (:catID, :coinName, :coinDescription, :imageLink, :year)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':catID', $catID, PDO::PARAM_INT);
    $stmt->bindParam(':coinName', $coinName, PDO::PARAM_STR);
    $stmt->bindParam(':coinDescription', $coinDescription, PDO::PARAM_STR);
    $stmt->bindParam(':imageLink', $imageLink, PDO::PARAM_STR);
    $stmt->bindParam(':year', $year, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
  } catch (PDOException $ex) {
    $errorMessage = $ex->getMessage();
    header('location: /errors/index.php');
    exit;
  }
}

?>