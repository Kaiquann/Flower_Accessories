<?php

function redirect($url)
{
    header('Location: ' . $url);
    die();
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
    // header('location: login');
    exit();
}
?>