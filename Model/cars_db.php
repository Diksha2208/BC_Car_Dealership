<?php
// Database configuration
require_once "../Model/dbconfig.php";

// Function to fetch all cars
function fetchAllCars() {
    $query = 'SELECT * FROM car_model_list';
    
    
   
}

function getCategories($conn) {
    $sql = "SELECT DISTINCT Category FROM Car_Model_List";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getModelsByCategory($conn, $category) {
    $sql = "SELECT * FROM Car_Model_List WHERE Category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getModelById($conn, $id) {
    $sql = "SELECT * FROM Car_Model_List WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function fetchPartsByType($conn, $type) {
    $sql = "SELECT * FROM parts WHERE  partType = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $type);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

function fetchpartsdetails($conn, $id) {
    $sql = "SELECT * FROM parts WHERE partID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
?>