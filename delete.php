
<?php
include('api_testing/db.php');

// Handle Delete
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect to list page after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<?php
$conn->close();
?>
