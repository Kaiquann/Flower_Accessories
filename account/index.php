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
    <title>
        <?php echo $page_title ?>
    </title>
    <main class="main">
        <section class="">
            <div class="container-fluid">
                <div class="panner mx-5 my-3">
                    <div class="row justify-content-center">
                        <h5 class="p-2 col-12 UserName"><strong>Username :</strong>
                            <?php echo $user_results['UserName']; ?>
                        </h5>
                        <h5 class="p-2 col-12 UserEmail"><strong>Email :</strong>
                            <?php echo $user_results['UserEmail']; ?>
                        </h5>
                        <h5 class="p-2 col-12 UserPhone"><strong>Phone Number :</strong>
                            <?php echo $user_results['UserPhone']; ?>
                        </h5>
                        <h5 class="p-2 col-12 UserPhone"><strong>Level :</strong>
                            <?php echo $user_results['UserAccess']; ?>
                        </h5>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <form action="index.php" method="post" class="col-12">
                        <input type="submit" class="mx-5 my-2 logout" name="logout" value="Logout">
                        <input type="button" class="EditInfo" name="logout" value="Edit Info">
                    </form>
                </div>
                <div class="logOut">

                </div>
            </div>
        </section>
    </main>




    <?php include "../assets/imports/footer.php"; ?>
</body>

</html>