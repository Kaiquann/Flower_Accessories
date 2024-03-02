<?php
$page_title = 'Account';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../assets/imports/header.php"; ?>
    <?php include "../assets/imports/dbConfig.php"; ?>
</head>

<?php
if (isset($_POST['logout'])) {
    userLogout();
    return;
}

if (!isset($_COOKIE["loggedin"])) {
    header('location:register.php');
    exit();
}

$user_cookies = $_COOKIE["loggedin"];
$user_query = mysqli_prepare($connection, "SELECT * FROM users WHERE UserPassword = ?");
mysqli_stmt_bind_param($user_query, "s", $user_cookies);
mysqli_stmt_execute($user_query);
$user_results = mysqli_fetch_assoc(mysqli_stmt_get_result($user_query));

if ($user_cookies != $user_results["UserPassword"]) {
    userLogout();
    return;
}

function userLogout()
{
    setcookie("loggedin", "", 0, "/", "localhost", true, false);
    header('location: ../account/login');
    exit();
}
?>



<body>
    <?php include "../assets/imports/navigation.php"; ?>
    <div class="pagebody">
        <title>
            <?php echo $page_title ?>
        </title>
        <div class="content" id="user_details">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">
                            Account Page
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Username:</td>
                        <td>
                            <?php echo $user_results['UserName']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>
                            <?php echo $user_results['UserEmail']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <?php echo $user_results['UserPhone']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <form action="index.php" method="post">
                                <input type="submit" name="logout" value="Logout">
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php include "../assets/imports/footer.php"; ?>
</body>

</html>