<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin: 0 10px;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f1f1f1;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            margin-right: 5px;
            color: #007bff;
            font-size: 14px;
        }
        .actions a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user']; ?></h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="create.php">Add Student</a>
        <a href="logout.php">Logout</a>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td class="actions">
                <a href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
