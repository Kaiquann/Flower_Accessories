<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">

<head>
  <div id="info"><?= temp('info') ?></div>
  <div id="success"><?= temp('success') ?></div>
  <div id="warning"><?= temp('warning') ?></div>
  <div id="danger"><?= temp('danger') ?></div>
</head>
<nav class="navbar navbar-expand-lg" style="box-shadow: 2px 2px 5px;">
  <div class="container-fluid">
    <a href="/index.php" class="navbar-brand">
      <img class="d-inline-block" src="/images/Logo.jpg" width="125" height="75" alt="Logo">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav text-center">
        <li class="nav-item mx-5 p-2">
          <a class="nav-link" href="/main">HOME</a>
        </li>
        <li class="nav-item mx-5 p-2">
          <a class="nav-link" href="/menu">MENU</a>
        </li>
        <li class="nav-item mx-5 p-2">
          <a class="nav-link" href="/aboutus">ABOUT US</a>
        </li>
        <li class="nav-item mx-5 p-2">
          <a class="nav-link" href="/account/login">LOGIN</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
  .nav-item {
    padding: px;
    border-radius: 8px;

  }

  .nav-item.active,
  .nav-item:hover {
    background-color: rgb(141, 135, 135);
    transition: all 1s;
  }

  .nav-item:hover a.nav-link {
    color: white;
    text-shadow: white 1px 1px;
    transition: all 0.5s;
  }
</style>