<?php
$page_title = 'Account';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../assets/imports/header.php";
    include "../assets/imports/dbConfig.php";
    include '../assets/imports/FileUtilities.php';
    ?>
</head>

<?php
if (isset($_POST['logout'])) {
    userLogout();
    exit();
}

if (!isset($_COOKIE["userloggedin"])) {
    header('location:register');
    exit();
} else {
    $user_results = chkCookies($connection);
}
?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .profile-container {
        margin-top: 50px;
    }

    .profile-card {
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    .profile-header {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .profile-info {
        font-size: 1.1rem;
    }

    .profile-info p {
        margin-bottom: 15px;
    }

    .profile-info strong {
        width: 150px;
        display: inline-block;
    }

    .btn-custom {
        margin-top: 20px;
    }
</style>

<body>

    <?php include "../assets/imports/navigation.php"; ?>
    <title>
        <?php echo $page_title ?>
    </title>
    <div class="container profile-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card profile-card">
                    <div class="profile-header">
                        User Profile
                    </div>
                    <div class="profile-info">
                        <p><strong>Username:</strong> <?php echo $user_results["USERNAME"] ?></p>
                        <p><strong>Email:</strong> <?php echo $user_results["USEREMAIL"] ?></p>
                        <p><strong>Phone Number:</strong><?php echo $user_results["USERPHONE"] ?></p>
                        <p><strong>User Level:</strong> <?php echo $user_results["USERACCESS"] ?></p>
                    </div>
                    <div class="text-center btn-custom">
                        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                        <form action="index.php" method="POST">
                            <button type="submit" class="btn btn-danger" name="logout" id="logout">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include "../assets/imports/footer.php"; ?>
</body>

</html>