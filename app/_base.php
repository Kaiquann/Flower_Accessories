<?php
define('USER_SESSION', 'user_session'); // User session key

try {
    $_db = new PDO('mysql:dbname=flower;host=localhost;port=3306', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

function db_select($table, $field, $value)
{
    global $_db;
    $stm = $_db->prepare("SELECT * FROM $table WHERE $field = ?");
    $stm->execute([$value]);
    return $stm->fetchAll();
}

function db_select_all($table)
{
    global $_db;
    $stm = $_db->prepare("SELECT * FROM $table");
    return $stm->fetchAll();
}

function uri()
{
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $uri = parse_url($uri, PHP_URL_PATH);
    $uri = trim($uri, '/');
    return $uri;
}

function redirect($url)
{
    require $url;
    return;
}

function chkCookies($connection)
{
    if (isset($_COOKIE['userloggedin'])) {
        $session_id = $_COOKIE['userloggedin'];

        $user_query = mysqli_prepare($connection, "SELECT * FROM users WHERE USERID = ?");
        mysqli_stmt_bind_param($user_query, "s", $session_id);
        mysqli_stmt_execute($user_query);
        return mysqli_fetch_assoc(mysqli_stmt_get_result($user_query));
    } else {
        return false;
    }
}

function userLogout()
{
    setcookie("userloggedin", "", 0, "/", "localhost", true, false);
    echo "<script>
    alert('logout successfull !'); 
    window.location.href='login';
    </script>";
    exit();
}


function temp($key, $value = null)
{
    if ($value !== null) {
        $_SESSION["temp_$key"] = $value;
    } else {
        $value = $_SESSION["temp_$key"] ?? null;
        unset($_SESSION["temp_$key"]);
        return $value;
    }
    return '';
}


function session($key, $value = null)
{
    if ($value !== null) {
        $_SESSION["session_$key"] = $value;
        return true;
    } else {
        return $_SESSION["session_$key"] ?? null;
    }
}

function unsetSession($key)
{
    unset($_SESSION["session_$key"]);
}

function unsetCookies($key)
{
    setcookie($key, '', time() - 3600, '/');
}

function getUserData()
{
    $user_session_data = session(USER_SESSION);
    if (!$user_session_data) return null;
    global $_db;
    $stmt = $_db->prepare('
        SELECT * FROM users
        WHERE id = ?
    ');
    $stmt->execute([$user_session_data->id]);
    $user_data = $stmt->fetch();
    if (!$user_data) {
        unsetSession(USER_SESSION);
        unsetCookies('session_token');
        return null;
    }
    return $user_data;
}

function isLoggedIn()
{
    global $_USER_DATA;
    return $_USER_DATA;
}

//global variable
$_USER_DATA = getUserData();
