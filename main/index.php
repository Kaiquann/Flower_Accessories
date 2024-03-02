<?php
$page_title = "Main";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include "../assets/imports/header.php"; ?>
</head>

<body>
  <?php include "../assets/imports/navigation.php"; ?>
  <title>
    <?php echo $page_title; ?>
  </title>
  <main id="main">
    <section class="section">
      <div class="container-fluid">
        <div class="row vh-100 align-items-center">
          <div class="d-block col-8 col-lg-5 col-xl-6 col-xxl-5 all_content">
            <h1 class="my-xxl-4 tittle">Flower shop</h1>
            <p class="my-xxl-4 content">Flowers provide an incredibly nuanced form of communication. Some
              plants, including roses, poppies, and lilies, could express a wide range of emotions based on their
              color alone.</p>
            <p class="my-xxl-4 content" style="font-size: 15px; color: rgb(133, 123, 120);"><strong>"Flowers are like friends,
                they bring color to your world"<br>Our shop now have envent and promotion now!</strong></p>
            <a href="../Menu/"><button class="m-3 px-4 py-2 button" style="animation:pulse 1s infinite;"><strong>Shop now</strong></button></a>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include "../assets/imports/footer.php"; ?>

</body>

</html>