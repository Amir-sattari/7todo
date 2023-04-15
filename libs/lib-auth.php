<?php

# *** AUTH FUNCTION***

function getCurrentUserId()
{
    return getLoggedInUser()->id ?? 0;
}


function isLoggedIn()
{
    return $_SESSION['login'] ? true : false;
}

function getLoggedInUser()
{
    return $_SESSION['login'] ?? null;
}

function register($userData)
{
    global $pdo;
    $passHash = password_hash($userData['password'], PASSWORD_BCRYPT);
    $sql = "INSERT INTO users (name,email,password) VALUES (:name,:email, :pass)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':name' => $userData['name'], ':pass' => $passHash, ':email' => $userData['email']]);
    return $stmt->rowCount() ? true : false;
}

function logout(){
    unset($_SESSION['login']);
}

function login($email, $pass)
{
    $user = getUserByEmail($email);
    if (is_null($user)) {
        return false;
    }
    # check the password
    if (password_verify($pass, $user->password)) {
        $user->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) );
        $_SESSION['login'] = $user;
        return true;
    }
    return false;
}

function getUserByEmail($email)
{
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $records[0] ?? NULL;
}

