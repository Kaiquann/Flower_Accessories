<?php
echo ' <nav class="navbar navbar-expand-lg h-100" style="box-shadow: 2px 2px 5px;">
    <div class="container-fluid">';
if ($page_title == 'Login' || $page_title == 'Register') {
  echo ' <a href="../index.php" class="navbar-brand"><img class="d-inline-block" src="../../images/Logo.jpg" width="125"
height="75"></a>';
} else {
  echo ' <a href="../index.php" class="navbar-brand"><img class="d-inline-block" src="../images/Logo.jpg" width="125"
height="75"></a>';
}


echo ' <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="collapse navbar-collapse" id="navbarNav">
   <ul class="navbar-nav text-center">
     <li class="nav-item mx-5 p-2">';
if ($page_title == 'Login' || $page_title == 'Register') {
  echo '<a class="nav-link" href="../../main">HOME</a>';
} else {
  echo '<a class="nav-link" href="../main">HOME</a>';
}
echo ' </li>
    <li class="nav-item mx-5 p-2">';
if ($page_title == 'Login' || $page_title == 'Register') {
  echo '<a class="nav-link" href="../../menu">MENU</a>';
} else {
  echo '<a class="nav-link" href="../menu">MENU</a>';
}
echo ' </li>
    <li class="nav-item mx-5 p-2">';
if ($page_title == 'Login' || $page_title == 'Register') {
  echo '<a class="nav-link" href="../../aboutus">ABOUT US</a>';
} else {
  echo '<a class="nav-link" href="../aboutus">ABOUT US</a>';
}
echo ' </li>
    <li class="nav-item mx-5 p-2">';
if ($page_title == 'Login' || $page_title == 'Register') {
  echo '<a class="nav-link" href="../../account/login">LOGIN</a>';
} else if (isset($_COOKIE["userloggedin"])) {
  echo '<a class="nav-link" href="../account">ACCOUNT</a>';
} else {
  echo '<a class="nav-link" href="../account/login">LOGIN</a>';
}
echo ' </li>
  </ul>
</div> 
</div>
  </nav>'; ?>