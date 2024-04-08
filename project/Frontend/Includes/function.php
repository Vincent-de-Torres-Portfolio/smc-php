<?php

function sanitizeString($input) {

    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);

    if (empty($input)) {
        return '';
    } else {
        return $input;
    }
}

function validatePassword($password) {
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password);
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generateSessionToken() {
    // Set the expiration time to 24 hours from now
    $expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

    // Generate a unique session token (you can modify this part based on your needs)
    $sessionToken = md5(uniqid(rand(), true));

    return array('token' => $sessionToken, 'expiration' => $expiration);
}

function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function validateSessionToken($db, $sessionToken, $userId) {
    // Check if the session token is valid for the specified user
    $sql = "SELECT * FROM de_torres_vincent_session_tokens WHERE session_token = ? AND user_id = ? AND expiration > NOW() AND status = 'active'";
    $stmt = $db->prepare($sql);
    $stmt->execute([$sessionToken, $userId]);
    return $stmt->fetch() !== false;
}


function addSessionToken($db, $userId, $sessionToken, $expiration) {
    $sql = "INSERT INTO de_torres_vincent_session_tokens (user_id, session_token, expiration) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$userId, $sessionToken, $expiration]);
}

function expireSessionToken($db, $sessionToken) {
    $sql = "UPDATE de_torres_vincent_session_tokens SET status = 'expired' WHERE session_token = ?";
    $stmt = $db->prepare($sql);
    return $stmt->execute([$sessionToken]);
}



function insertUserDirectory($db, $userId, $directoryName, $username) {
    // Generate a unique directory_id using MD5 hash
    $directoryId = md5($userId . $directoryName . microtime());
    $paddedUserId = str_pad($userId, 6, '0', STR_PAD_LEFT);
    $directoryPath = "DATA/" . $paddedUserId . "_" . $username;    $stmt = $db->prepare("INSERT INTO de_torres_vincent_user_directories (user_id, directory_id, directory_name, directory_path) VALUES (?, ?, ?, ?)");
    $stmt->execute([$userId, $directoryId, $directoryName, $directoryPath]);
}

function logMessage($message) {
    $logFilePath = 'log.txt';
    $logMessage = date('Y-m-d H:i:s') . " - IP: {$_SERVER['REMOTE_ADDR']} - $message\n";
    file_put_contents($logFilePath, $logMessage, FILE_APPEND);
}

function renderDirectoryContents($directoryManager, $user_id, $parentDirectoryId, $libraries) {
    if ($parentDirectoryId !== null) {
        $directoryContents = $directoryManager->getDirectoryContents($user_id, $parentDirectoryId);

        if (empty($directoryContents)) {
            echo "No directories found.";
        } else {
            $renderer = new Directory($directoryContents);
            echo $renderer->render();
        }
    } else {
        $renderer = new Directory($libraries);
        echo $renderer->render();
    }
}