Certainly! Below is the detailed wiki in Markdown format:

---

# Database Management Functions in PHP

## Introduction
This document outlines a PHP script that facilitates database management operations such as adding, updating, deleting, and retrieving users from a MySQL database. The script is designed to handle these operations securely using PDO (PHP Data Objects) to interact with the database.

## Script Overview

1. **Database Configuration:**
    - It includes a configuration file (`config.php`) to establish a database connection using constants for database host, username, password, and database name.

2. **Database Connection:**
    - The script establishes a connection to the MySQL database using PDO (PHP Data Objects). It sets attributes for error reporting and exception handling.

3. **User Management Functions:**
    - `addUser($firstname, $lastname, $username, $email, $password)`: Adds a new user to the database.
    - `updateUser($id, $firstname, $lastname, $username, $email, $password)`: Updates an existing user's information.
    - `deleteUser($id)`: Deletes a user from the database.
    - `getUsers()`: Retrieves all users from the database.

4. **Error Handling:**
    - Exception handling is implemented using try-catch blocks to gracefully handle any database-related errors that may occur during execution.

## Detailed Functionality

1. **Adding a New User:**
    - The `addUser` function inserts a new user into the database table `de_torres_vincent_users`. It accepts parameters for the user's first name, last name, username, email, and password. These parameters are inserted into the database using a prepared statement to prevent SQL injection attacks.

2. **Updating an Existing User:**
    - The `updateUser` function updates an existing user's information in the database. It accepts parameters for the user's ID, first name, last name, username, email, and password. The function uses a prepared statement to update the corresponding user record in the database.

3. **Deleting a User:**
    - The `deleteUser` function deletes a user from the database based on their ID. It uses a prepared statement to safely delete the user record from the `de_torres_vincent_users` table.

4. **Retrieving Users:**
    - The `getUsers` function retrieves all users from the database and returns them as an associative array. It executes a SELECT query on the `de_torres_vincent_users` table and fetches the results using `fetchAll`.

## Usage Examples
Examples are provided to demonstrate the usage of each function:

- Adding a new user.
- Updating an existing user.
- Deleting a user.
- Retrieving all users and printing them using `print_r`.



