<?php
header("Content-Type: application/json");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        $users = [];

        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        echo json_encode($users);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email','$phone')";
        if ($conn->query($sql)) {
            echo json_encode(["status" => "User created"]);
        } else {
            echo json_encode(["status" => "Error"]);
        }
        break;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $sql = "UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["status" => "User updated"]);
        } else {
            echo json_encode(["status" => "Error"]);
        }
        break;

    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];

        $sql = "DELETE FROM users WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["status" => "User deleted"]);
        } else {
            echo json_encode(["status" => "Error"]);
        }
        break;

    default:
        echo json_encode(["status" => "Unsupported method"]);
        break;
}
