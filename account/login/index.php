<?php
$page_title = 'Login';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../../assets/imports/header.php"; ?>
    <?php include "../../assets/imports/dbConfig.php"; ?>
    <title>
        <?php echo $page_title; ?>
    </title>
</head>

<?php
if (isset($_COOKIE["loggedin"])) {
    $user_cookies = $_COOKIE["loggedin"];
    $user_query = mysqli_prepare($connection, "SELECT * FROM users WHERE UserPassword = ?");
    mysqli_stmt_bind_param($user_query, "s", $user_cookies);
    mysqli_stmt_execute($user_query);
    $user_results = mysqli_fetch_assoc(mysqli_stmt_get_result($user_query));
    if ($user_cookies == $user_results["UserPassword"]) {
        header('location: ./account.php');
        exit();
    }
}
?>

<body>
    <?php include "../../assets/imports/navigation.php"; ?>

    <?php
    $useremail = isset($_POST["useremail"]) ? trim($_POST["useremail"]) : "";
    $userpassword = isset($_POST["userpassword"]) ? trim($_POST["userpassword"]) : "";
    $errors = [];
    if (isset($_POST["submit"])) {
        if (empty($_POST['useremail'])) {
            $errors['useremail'] = "Email cannot be blank!";
        }

        if (empty($_POST['userpassword'])) {
            $errors['userpassword'] = "Password cannot be blank!";
        }

        //create query
        $user_query = mysqli_prepare($connection, "SELECT * FROM users WHERE UserEmail =? OR UserPassword=?");

        //Bind parameter and execute the query
        mysqli_stmt_bind_param($user_query, "ss", $useremail, $userpassword);
        mysqli_stmt_execute($user_query);

        //set the result set
        $user_results = mysqli_stmt_get_result($user_query);

        //Fetch the user data
        $user_data = mysqli_fetch_assoc($user_results);

        //cehck any row will return
        if ($user_data && $useremail == $user_data["USEREMAIL"]) {

            if ($userpassword == $user_data["USERPASSWORD"]) {
                setcookie("userloggedin", $user_data["USERID"], 0, "/", "localhost", true, false);
                echo "<script>
                alert('Welcome back !'); 
                window.location.href='../index.php';
                </script>";
                exit();
            } else {
                $errors['userpassword'] = "Password is invalid !";
            }
        } else {
            $errors['useremail'] = "Email is not register !";
        }
    }
    ?>


    <main id="main">
        <section class="section">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <form action="index.php" method="post" class="col-8 m-5 form">
                        <div class="row">
                            <div class="col-md-5 p-0">
                                <img src="../../images/loginpg_img.jpg" class="w-100 img-fluid"
                                    style="border-radius:20px 0px 0px 20px;" alt="error">
                            </div>
                            <div class="col-md-7 align-self-center">
                                <div class="m-5 w-md-100">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label><br>
                                    <input type="email"
                                        class="form-control <?php echo (isset($useremail) && !empty($useremail)) ? (($user_data && $useremail == $user_data["USEREMAIL"]) ? 'is-valid' : 'is-invalid') : ''; ?>" name="useremail" id="useremail" aria-describedby="emailHelp" value="<?php echo isset($useremail) && !empty($useremail) ? $useremail : ''; ?>" required>
                                    <span class="error">
                                        <?php echo isset($errors["useremail"]) ? $errors["useremail"] : ''; ?>
                                    </span>
                                </div>
                                <div class="m-5 w-md-100">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control <?php echo (isset($userpassword) && !empty($userpassword)) ? (($user_data && $userpassword == $user_data["USERPASSWORD"] && $useremail == $user_data["USERPASSWORD"]) ? 'is-valid' : 'is-invalid'):''; ?>" name="userpassword" id="userpassword" value="<?php echo isset($userpassword) && !empty($userpassword) ? $userpassword : ''; ?>" required>
                                    <span class="error">
                                        <?php echo isset($errors["userpassword"]) ? $errors["userpassword"] : ''; ?>
                                    </span>
                                </div>
                                <div class="m-5 w-md-100">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label><br><br><br>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    <input type="reset" value="Clear form">
                                    <div class="alternativeLink">
                                        <a href="../register">Don't have account? Register Now!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <?php include "../../assets/imports/footer.php"; ?>
</body>

</html>