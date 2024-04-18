<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebooks";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
        $id = $_POST['ebook_id'];
        $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

        $stmt = $conn->prepare("UPDATE ebooks SET image_data = :image_data WHERE id = :id");
        $stmt->bindParam(':id', $id); // Assuming $id is the ID of the row you want to update
        $stmt->bindParam(':image_data', $image_data, PDO::PARAM_LOB);
        $stmt->execute();

        echo "Image uploaded successfully.";
    } else {
        echo "Error: Please select an image to upload.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
