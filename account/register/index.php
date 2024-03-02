<?php
$page_title = 'Register';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "../../assets/imports/header.php"; ?>
    <?php include "../../assets/imports/dbConfig.php"; ?>
    <title>
        <?php echo $page_title ?>
    </title>
</head>


<body>
    <?php include "../../assets/imports/navigation.php"; ?>


    <?php

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





    if (isset($_POST["submit"])) {

        $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
        $userpassword = isset($_POST["userpassword"]) ? trim($_POST["userpassword"]) : "";
        $confirmpassword = isset($_POST["confirmpassword"]) ? trim($_POST["confirmpassword"]) : "";
        $useremail = isset($_POST["useremail"]) ? trim($_POST["useremail"]) : "";
        $userphone = isset($_POST["userphone"]) ? trim($_POST["userphone"]) : "";
        $errors = [];

        //create query
        $user_query = mysqli_prepare($connection, "SELECT * FROM users WHERE UserEmail = ? OR UserName = ? OR UserPhone = ? OR UserPassword = ?");
        mysqli_stmt_bind_param($user_query, "ssss", $useremail, $username, $userphone, $userpassword);
        mysqli_stmt_execute($user_query);

        //set the result set
        $user_results = mysqli_stmt_get_result($user_query);

        //Fetch the user data
        $user_data = mysqli_fetch_assoc($user_results);

        if (empty($username)) {
            $errors["username"] = "Username cannot be empty";
        } else if (strlen($username) > 10) {
            $errors["username"] = "Username cannot be more than 10 characters";
        } else if (!preg_match("/^[A-Za-z\s]+/", $username)) {
            $errors["username"] = "At least one big lestter";
        } else if ($user_data &&$username == $user_data["UserName"]) {
            $errors["username"] = "This username has been use, Try others";
        }

        if (empty($userpassword)) {
            $errors["password"] = "Password cannot be blank!";
        } else if (strlen($userpassword) < 8) {
            $errors["password"] = "Password must at least 8 letters!";
        } else if (!preg_match("/^[A-Z]/", $userpassword)) {
            $errors["password"] = "At least one big letter";
        } else if ($userpassword != $confirmpassword) {
            $errors["password"] = "Confirm password not same !";
        } else if ($user_data && $userpassword == $user_data["UserPassword"]) {
            $errors["password"] = "This password has been use, Try others";
        }


        if (empty($confirmpassword)) {
            $errors["confirmpassword"] = "Confirm password cannot be blank!";
        } else if (strlen($confirmpassword) < 8) {
            $errors["confirmpassword"] = "Confirm password must at least 8 letters!";
        }else if ($userpassword != $confirmpassword) {
            $errors["confirmpassword"] = "Confirm password not same !";
        } else if ($user_data &&$confirmpassword == $user_data["UserPassword"]) {
            $errors["confirmpassword"] = "This password has been use, Try others";
        }

        if (empty($useremail)) {
            $errors["email"] = "Email cannot be blank!";
        } else if ($user_data &&$useremail == $user_data["UserEmail"]) {
            $errors["email"] = "This Email has been use, Try others";
        }

        if (empty($userphone)) {
            $errors["phone"] = "Mobile phone cannot be empty";
        } else if (!preg_match("/^01[0-9]{1}-[0-9]{7}$/", $userphone)) {
            $errors["phone"] = "Mobile phone must follow format: [01x-xxxxxxx]";
        } else if ($user_data &&$userphone == $user_data["UserPhone"]) {
            $errors["phone"] = "This Phone number has been use, Try others";
        }



        $useraccess = "Member";
        // $pass_hash = password_hash($userpassword, PASSWORD_DEFAULT);
    
        // $duplicate_query = mysqli_prepare($connection, "SELECT * FROM users WHERE UserName = ? OR UserEmail = ?");
        // mysqli_stmt_bind_param($duplicate_query, "ss", $username, $useremail);
        // mysqli_stmt_execute($duplicate_query);
        // $duplicate_result = mysqli_stmt_get_result($duplicate_query);
    
        // if (mysqli_num_rows($duplicate_result) > 0) {
        //     echo "<div class='message'>Username or Email has been used!</div>";
        // } else if ($userpassword == $confirmpassword) {
        if (empty($errors)) {
            $insert_query = mysqli_prepare($connection, "INSERT INTO users (UserName, UserPassword, UserEmail, UserPhone, UserAccess) VALUES (?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insert_query, "sssss", $username, $userpassword, $useremail, $userphone, $useraccess);
            mysqli_stmt_execute($insert_query);
            echo "<script>
            alert('Account register successfully!'); 
            window.location.href='../login';
            </script>";
            exit();

        }
        // } else {
        //     echo "<div class='message'>Password not same!</div>";
        // }
    }

    ?>




    <main class="">
        <section class="section">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-center">
                    <form action="index.php" method="post" class="col-8 m-5 form">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-5 col-lg-0 p-0">
                                <img src="../../images/loginpg_img.jpg" class="w-100 img-fluid regform_pic"
                                    style="border-radius:20px 0px 0px 20px; height:750px;" alt="error">
                            </div>
                            <div class="col-md-7 align-self-center">
                                <div class="m-5 w-md-100">
                                    <label for="username" class="form-label">Username :</label><br>
                                    <input type="text"
                                        class="form-control <?php echo (isset($username) && !empty($username)) ? (preg_match("/^[A-Za-z]/", $username) ? ((strlen($username) < 10) ? (($username == $user_data["UserName"]) ? 'is-invalid' : 'is-valid') : 'is-invalid') : 'is-invalid') : ''; ?>"
                                        name="username" id="username"
                                        value="<?php echo isset($username) && !empty($username) ? $username : ''; ?>"
                                        required>
                                    <span class="error">
                                        <?php echo isset($errors["username"]) ? $errors["username"] : ''; ?>
                                    </span>
                                </div>
                                <div class="m-5 w-md-100">
                                    <label for="password" class="form-label">Password :</label>
                                    <input type="password"
                                        class="form-control <?php echo (isset($userpassword) && !empty($userpassword)) ? (preg_match("/^[A-Z]/", $userpassword) ? ((strlen($userpassword) > 8) ? (($userpassword == $confirmpassword) ? (($userpassword == $user_data["UserPassword"]) ? 'is-invalid' : 'is-valid') : 'is-invalid') : 'is-invalid') : 'is-invalid') : ''; ?>"
                                        name="userpassword" id="userpassword"
                                        value="<?php echo isset($userpassword) && !empty($userpassword) ? $userpassword : ''; ?>"
                                        required>
                                    <span class="error">
                                        <?php echo isset($errors["password"]) ? $errors["password"] : ''; ?>
                                    </span>
                                </div>
                                <div class="m-5 w-md-100">
                                    <label for="confirmpasword" class="form-label">Confirm password :</label>
                                    <input type="password"
                                        class="form-control <?php echo (isset($confirmpassword) && !empty($confirmpassword)) ? (preg_match("/^[A-Z]/", $confirmpassword) ? ((strlen($confirmpassword) > 8) ? (($userpassword == $confirmpassword) ? (($confirmpassword == $user_data["UserPassword"]) ? 'is-invalid' : 'is-valid') : 'is-invalid') : 'is-invalid') : 'is-invalid') : ''; ?>"
                                        name="confirmpassword" id="confirmpassword"
                                        value="<?php echo isset($confirmpassword) && !empty($confirmpassword) ? $confirmpassword : ''; ?>"
                                        required>
                                    <span class="error">
                                        <?php echo isset($errors["confirmpassword"]) ? $errors["confirmpassword"] : ''; ?>
                                    </span>
                                </div>
                                <div class="m-5 w-md-100">
                                    <label for="Email" class="form-label">Email :</label>
                                    <input type="email"
                                        class="form-control <?php echo (isset($useremail) && !empty($useremail)) ? (($useremail == $user_data["UserEmail"]) ? 'is-invalid' : 'is-valid') : ''; ?>"
                                        name="useremail" id="useremail"
                                        value="<?php echo isset($useremail) && !empty($useremail) ? $useremail : ''; ?>"
                                        required>
                                    <span class="error">
                                        <?php echo isset($errors["email"]) ? $errors["email"] : ''; ?>
                                    </span>
                                </div>
                                <div class="m-5 w-md-100">
                                    <label for="Phonenumber" class="form-label">Phone number :</label>
                                    <input type="tel"
                                        class="form-control <?php echo (isset($userphone) && !empty($userphone)) ? (($userphone == $user_data["UserPhone"]) ? 'is-invalid' : 'is-valid') : ''; ?>"
                                        name="userphone" id="userphone"
                                        value="<?php echo isset($userphone) && !empty($userphone) ? $userphone : ''; ?>"
                                        pattern="01[0-9]{1}-[0-9]{7}" required>
                                    <span class="error">
                                        <?php echo isset($errors["phone"]) ? $errors["phone"] : ''; ?>
                                    </span>
                                </div>

                                <div class="m-5 w-md-100">
                                    <input type="submit" name="submit" id="submit"
                                        class="btn btn-primary submit"></input>
                                    <input type="reset" value="Clear form">
                                    <div class="alternativeLink">
                                        <a href="../login">Already have account? Login Now!</a>
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