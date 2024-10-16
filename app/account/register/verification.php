<?php
session_start();
require_once '../../assets/imports/FileUtilities.php';
require "../../assets/imports/dbConfig.php";

$page_title = 'vericication';




if (isset($_SESSION['user_data'])) {
    $user_data = $_SESSION['user_data'];
    $username = $user_data['username'];
    $userpassword = $user_data['password'];
    $useremail = $user_data['email'];
    $userphone = $user_data['phone'];
    $useraccess = $user_data['userAccess'];
    $otp = $user_data['otp'];
}




if (isset($_POST["submit"])) {

    if ($_POST["otp"] == $otp) {
        $_SESSION['otp'] = $otp;
        $insert_query = mysqli_prepare($connection, "INSERT INTO users (USERNAME, USERPASSWORD, USEREMAIL, USERPHONE, USERACCESS) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($insert_query, "sssss", $username, $userpassword, $useremail, $userphone, $useraccess);
        mysqli_stmt_execute($insert_query);
        echo "<script>
                alert('Account register successfully!'); 
                window.location.href='../login';
                </script>";
        exit();
    } else {
        echo "invalid otp";
    }

    // Store user data and OTP in session (or use a more persistent storage like a database)

}

if (isset($_COOKIE["loggedin"])) {
    $user_cookies = $_COOKIE["loggedin"];
    $user_query = mysqli_prepare($connection, "SELECT * FROM users WHERE UserPassword = ?");
    mysqli_stmt_bind_param($user_query, "s", $user_cookies);
    mysqli_stmt_execute($user_query);
    $user_results = mysqli_fetch_assoc(mysqli_stmt_get_result($user_query));
    if ($user_cookies == $user_results["UserPassword"]) {
        header('location: ../account');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "../../assets/imports/header.php"; ?>

    <title>
        <?php echo $page_title ?>
    </title>
</head>


<body>
    <main class="">
        <section class="section">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <div class="w-50 text-center" style="border: solid black 2px;">
                        <h1 class="m-5">Enter Your OTP</h1>
                    </div>
                    <form action="verification.php" method="post" class="col-8 m-5 form">
                        <div class="m-5 w-md-100">
                            <label for="username" class="form-label">Enter your otp :</label><br>
                            <input type="text" class="form-control" name="otp" id="otp" pattern="[0-9]{6}" maxlength="6"
                                placeholder="xxxxxx" required>
                        </div>
                        <input type="submit" class="submitBtn w-25" name="submit" id="submit" value="Verify" />
                    </form>
                </div>
            </div>
        </section>
    </main>




    <?php include "../../assets/imports/footer.php"; ?>
</body>

</html>