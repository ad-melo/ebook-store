<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebooks";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT image_data FROM ebooks WHERE id = :id");
    $stmt->bindParam(':id', $image_id);
    $image_id = $ebook_id;
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $image_data = $row['image_data'];

    echo '<img src="data:image/jpeg;base64,' . base64_encode($image_data) . '" alt="Uploaded Image">';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
