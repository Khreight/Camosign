<?php
  session_start();
  require_once "Config/databaseConnexion.php";
  
  ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Css/error404.css">
    <link rel="stylesheet" href="./Css/nav.css">
    <link rel="stylesheet" href="./Css/inscription.css">
    <title>CamoSign</title>
    <script src="./Javascript/tabnav.js"></script>
    <script src="./Javascript/profil.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  </head>
  <body>
    <body>
      <div class="sidebar">
        <div class="logo_details">
          <img  class="navimg"src="./Img/CamoSign_Logo.png" alt="Logo officiel de CamoSign">
          <div class="logo_name">CamoSign</div>
          <i class="bx bx-menu" id="btn"></i>
        </div>
        <ul class="nav-list">
          <li>
            <a href="/">
              <i class='bx bx-home-alt'></i>
              <span class="link_name">Acceuil</span>
            </a>
            <span class="tooltip">Acceuil</span>
          </li>
          <li>
          <li>
            <a href="join">
              <i class='bx bx-group'></i>
              <span class="link_name">Rejoindre</span>
            </a>
            <span class="tooltip">Rejoindre</span>
          </li>
          <li>
            <a href="news">
              <i class='bx bx-news' ></i>
              <span class="link_name">Actualité</span>
        </a>
        <span class="tooltip">Actualité</span>
      </li>

      <li>
        <a href="contact">
          <i class='bx bx-info-circle' ></i>
          <span class="link_name">Contact</span>
        </a>
        <span class="tooltip">Contact</span>
      </li>

      <li>
        <a href="credit">
          <i class='bx bx-info-circle' ></i>
          <span class="link_name">Crédits</span>
        </a>
        <span class="tooltip">Crédits</span>
      </li>

      <?php if(isset($_SESSION["user"])) :?>
        <?php if ($_SESSION["user"]->utilisateurRole == "administrator") :?>
          <li>
            <a href="dashboard">
              <i class="bx bx-grid-alt"></i>
              <span class="link_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
          </li>
          <?php endif ?>
          <?php endif ?>
          
          
          <?php if(isset($_SESSION["user"])) :?>
            
            <li class="navProfondeur">
              <div class="navProfondeur2">
                <a href="compte">
                  <i class='bx bx-user-plus' id="account"></i>
                  <div class="profile_content">
                    <div class="name"><?php $_SESSION["user"]->utilisateurPrenom ?> <?php $_SESSION["user"]->utilisateurNom ?></div>
                    <div class="designation"><?php if($_SESSION["user"]->utilisateurRole === "administrator") :?>Admin<?php else :?>Utilisateur<?php endif ?></div>
              </div>
            </a>
          </div>
        </li>
        
        <?php else :?>
          <li class="navProfondeur">
            <div class="navProfondeur2">
              <a href="inscription">
                <i class='bx bx-user-plus' id="account"></i>
                <div class="profile_content">
                  <div class="name">Votre compte</div>
                  <div class="designation">n'est pas connecté</div>
                </div>
              </a>
            </div>
        </li>
        
        <?php endif ?>
      </ul>
    </div>
    <?php
      require_once "Controllers/userController.php";
    ?>
  </body>
  </html>
  