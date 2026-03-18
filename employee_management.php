<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "employee_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add employee
function addEmployee($name, $position, $salary) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO employees (name, position, salary) VALUES (?, ?, ?);");
    $stmt->bind_param("ssi", $name, $position, $salary);
    return $stmt->execute();
}

// Function to read employees
function getEmployees() {
    global $conn;
    $result = $conn->query("SELECT * FROM employees");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Function to update employee
function updateEmployee($id, $name, $position, $salary) {
    global $conn;
    $stmt = $conn->prepare("UPDATE employees SET name = ?, position = ?, salary = ? WHERE id = ?;");
    $stmt->bind_param("ssii", $name, $position, $salary, $id);
    return $stmt->execute();
}

// Function to delete employee
function deleteEmployee($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?;");
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

// Usage examples (remove in production)
// addEmployee("John Doe", "Developer", 60000);
// print_r(getEmployees());
// updateEmployee(1, "Jane Doe", "Manager", 80000);
// deleteEmployee(1);

$conn->close();
?>
