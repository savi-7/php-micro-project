<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the current student details
    $sql = "SELECT * FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Update student details
        $name = $_POST['name'];
        $age = $_POST['age'];
        $class = $_POST['class'];

        $sql = "UPDATE students SET name = ?, age = ?, class = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisi', $name, $age, $class, $id);
        $stmt->execute();

        header('Location: dashboard.php');
        exit();
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Update Student</title>
</head>
<body>
    <form method="POST">
        <h2>Update Student</h2>
        <input type="text" name="name" value="<?php echo $student['name']; ?>" required>
        <input type="number" name="age" value="<?php echo $student['age']; ?>" required>
        <input type="text" name="class" value="<?php echo $student['class']; ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>
