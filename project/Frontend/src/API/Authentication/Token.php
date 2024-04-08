<?php

// Database connection parameters
$host = 'localhost';
$dbname = 'vdetorre_project';
$username = 'your_username';
$password = 'your_password';

// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to generate a random session token
function generateToken() {
    return bin2hex(random_bytes(32));
}

// Function to create a session token for a user
function createSessionToken($userId) {
    global $pdo;
    $token = generateToken();
    $expiration = date('Y-m-d H:i:s', strtotime('+1 day'));
    try {
        $stmt = $pdo->prepare("INSERT INTO de_torres_vincent_session_tokens (user_id, session_token, expiration) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $token, $expiration]);
        return $token;
    } catch (PDOException $e) {
        return false;
    }
}

// Function to validate a session token
function validateSessionToken($token) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT * FROM de_torres_vincent_session_tokens WHERE session_token = ? AND status = 'active' AND expiration > NOW()");
        $stmt->execute([$token]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return $result['user_id'];
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
}

// Function to protect endpoints requiring authentication
function protectEndpoint($request, $response, $next) {
    $token = $request->getHeaderLine('Authorization');
    if (!$token || !validateSessionToken($token)) {
        return $response->withStatus(401)->withJson(['error' => 'Unauthorized']);
    }
    $response = $next($request, $response);
    return $response;
}

// Usage example:
// Create session token for user with ID 1
$token = createSessionToken(1);
if ($token) {
    echo "Session token created: $token\n";
} else {
    echo "Failed to create session token\n";
}

// Validate session token
$userId = validateSessionToken($token);
if ($userId) {
    echo "Session token is valid for user ID $userId\n";
} else {
    echo "Session token is invalid or expired\n";
}

// Example of protecting an endpoint using middleware
$app->get('/protected-endpoint', function($request, $response) {
    // This endpoint is protected and can only be accessed with a valid session token
    return $response->withJson(['message' => 'You have access to this protected endpoint']);
})->add('protectEndpoint');


