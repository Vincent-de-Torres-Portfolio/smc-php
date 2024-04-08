<?php

include_once "../Configure/config.php";

// Establish database connection
try {
    $host=DB_HOST;
    $username=DB_USERNAME;
    $dbname=DB_NAME;
    $password=DB_PASSWORD;

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to add a new user
function addUser($firstname, $lastname, $username, $email, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("INSERT INTO de_torres_vincent_users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $username, $email, $password]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Function to update an existing user
function updateUser($id, $firstname, $lastname, $username, $email, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("UPDATE de_torres_vincent_users SET firstname = ?, lastname = ?, username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$firstname, $lastname, $username, $email, $password, $id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Function to delete a user
function deleteUser($id) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("DELETE FROM de_torres_vincent_users WHERE id = ?");
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// Function to retrieve all users
function getUsers() {
    global $pdo;
    try {
        $stmt = $pdo->query("SELECT * FROM de_torres_vincent_users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

// Usage examples:
// Add a new user
addUser('John', 'Doe', 'johndoe', 'johndoe@example.com', 'password123');

// Update an existing user
updateUser(1, 'Jane', 'Doe', 'janedoe', 'janedoe@example.com', 'newpassword');

// Delete a user
deleteUser(2);

// Retrieve all users
$users = getUsers();
print_r($users);

