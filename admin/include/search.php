<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "lhm_system2";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

if(isset($_GET["query"])){


$username = $_GET["query"];

if($username=="init" ){
    $sql ="SELECT  id, index_number, username, email, password, expertise, address, mobile_no, role, image_path FROM lecturers; ";
$stmt=$conn->prepare($sql);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
}else{
    $sql ="SELECT id, index_number, username, email, password, expertise, address, mobile_no, role, image_path FROM lecturers WHERE email LIKE '%" .$username . "%' ";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}


}