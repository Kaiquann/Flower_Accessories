<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="index.css">
<?php
if ($page_title == 'Login' || $page_title == 'Register') {
  echo '<link rel="stylesheet" href="../../assets/imports/navigation.css">';
  echo '<link rel="stylesheet" href="../../assets/css/global.css">';
  echo '<link rel="stylesheet" href="../../assets/imports/dbConfig.php">';

} else {
  echo '<link rel="stylesheet" href="../assets/imports/navigation.css">';
  echo '<link rel="stylesheet" href="../assets/css/global.css">';
  echo '<link rel="stylesheet" href="../assets/imports/dbConfig.php">';
} ?>