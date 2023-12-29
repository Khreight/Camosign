<?php
    require_once "Model/userModel.php"; 
    require_once "Model/conversationModel.php";
    include('smtp/PHPMailerAutoload.php');

    $uri = $_SERVER["REQUEST_URI"];
    if ($uri === "/index.php" ||$uri ===  "/index" || $uri ===  "/acceuil" || $uri === "/") {
        require_once "./Templates/users/acceuil.php";
    } elseif ($uri === "/compte") {
        if(isset($_SESSION["user"])){
            require_once "./Templates/users/profil.php";
        } else {
            require_once "./Templates/users/connexion.php";
        }
    } else if ($uri === "/inscription"){

        // Lors du clic du bouton d'inscription
        if(isset($_POST["btnInscription"])) {

            if(isset($_SESSION["user"])) {

                // Redirection vers l'acceuil
                header('location:/');

                // Affichage du message pop-up disant qu'on ne sait pas s'inscrire sans s'être déconnecté

            }

            var_dump($pdo);
            // Vérification des données rentrées

            $infosEtat = verifDataInscription();

            // Reprise de chaque variable pour remettre normalement
            $etatPseudo = $infosEtat["infoPseudo"];
            $etatDateNaissance = $infosEtat["infoDateNaissance"];
            $etatEmail = $infosEtat["infoEmail"];
            $etatMotDePasse1 = $infosEtat["infoMotDePasse1"];
            $etatMotDePasse2 = $infosEtat["infoMotDePasse2"];
            $etatMotDePasse = $infosEtat["infoMotDePasse"];


            if($etatPseudo == "ok" && $etatDateNaissance == "ok" && $etatEmail == "ok" && $etatMotDePasse == "ok" && $etatMotDePasse1 == "ok" && $etatMotDePasse2 == "ok") {
                do {
                    // Génération du token
                    $token = generateToken();

                    // Vérification dans la base de donnée pour voir si le token existe déja
                    $tooToken = verifTooToken($pdo, $token);

                    // Si le token existe déja, la boucle se fait, donc regénération
                } while ($tooToken == true);

                // Création de l'utilisateur
                createUser($pdo, $token);

                // Génération du lien avec le token intégré pour la vérification du compte
                $link = generateLink($token);

                // Envoi du mail de confirmation d'inscription
                mailInscription($link);

                // Destruction de session pour être sûr
                session_destroy();

                // Redirection vers la page de connexion
                header('location:/connexion');
            }
        }
        require_once "./Templates/users/inscription.php";

    } else if ($uri === "/connexion") {
        require_once "./Templates/users/connexion.php";
    } else if($uri === "/activation-compte") {
        // Prise du token dans le lien
        $tentativeToken = $_GET['token'];

        // Recherche l'id de l'utilisateur dont est relié le token
        $userTokenSearch = searchToken($pdo, $tentativeToken);

        // Condition après le résultat de l'existence du token
        if(isset($userTokenSearch)) {

            // Modification du bool de vérification dans la base de donnée avec l'Id
            activateVerif($pdo, $userTokenSearch);

            // Redirection vers la page qui indique que la vérification a été faite
            require_once "./Templates/users/activation-compte.php";
        } else {

            // Destruction de session pour être sûr
            session_destroy();

            // Redirection vers la page qui indique que la vérification a été foirée car la condition n'a pas trouvé de personne associé
            require_once "./Templates/users/erreur-activation-compte.php";
        }
    }
    
    else {
        require_once "./Templates/error-404.php";
    }






    function verifDataInscription(){

        var_dump($pdo);

        if(empty($_POST["pseudo"])) {
            $etatPseudo = "vide";
        } else {
            if(strpos($_POST["pseudo"], ' ') != false) {
                $etatPseudo = "espace";
            } else {
                if(strlen($_POST["pseudo"]) < 4 || strlen($_POST["pseudo"]) > 30) {
                    $etatPseudo = "nombreCaractère";
                } else {
                    if(verificationPseudo($pdo) == true) {
                        $etatPseudo = "déja";
                    } else {
                        $etatPseudo = "ok";
                    }
                }
                
            }
        }

        if(empty($_POST["birthday"])) {
            $etatDateNaissance = "vide";
        } else {
            if(verificationDateNaissance() == false) {
                $etatDateNaissance = "pasassezage";
            } else {
                $etatDateNaissance = "ok";
            }
        }

        if(empty($_POST["mail"])) {
            $etatEmail = "vide";
        } else {
            if(filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL) == false) {
                $etatEmail = "formatnon";
            } else {
                if(verificationEmail($pdo) == true) {
                    $etatEmail = "déja";
                } else {
                    $etatEmail = "ok";
                }
            }
        }

        if(empty($_POST["password"])) {
            $etatMotDePasse1 = "vide";
        }

        if(empty($_POST["password2"])) {
            $etatMotDePasse2 = "vide";
        }

        if(verificationMotDePasse() == false) {
            $etatMotDePasse = "noncompatible";
        } else {
            if(strlen($_POST["password"] < 6 || strlen($_POST["password"]) > 50)) {
                $etatMotDePasse = "formatnon";
            } else {
                $etatMotDePasse = "ok";
            }
        }

        return array(
            'infoPseudo' => $etatPseudo,
            'infoDateNaissance' => $etatDateNaissance,
            'infoEmail' => $etatEmail,
            'infoMotDePasse1' => $etatMotDePasse1,
            'infoMotDePasse2' => $etatMotDePasse2,
            'infoMotDePasse' => $etatMotDePasse
        );        

    }








    function generateToken() {
        $longueurToken = 60;
        return bin2hex(\random_bytes($longueurToken / 2));
    }

    function generateLink($token) {
        $link = 'http://localhost:3000/activation-compte?token=' . $token;
        return $link;
    }

    function mailInscription($link) {
        $msg = 'test';
        $to = $_POST["mail"];
        $subject = "Code de confirmation - CamoSign";
        smtp_mailer($to, $subject, $msg);
    }
    

    function smtp_mailer($to,$subject, $msg){
        $mail = new PHPMailer(); 
        $mail->IsSMTP(); 
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587; 
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        //$mail->SMTPDebug = 2; 
        $mail->Username = "louisthedeaf@gmail.com";
        $mail->Password = "lvwejmtikteubqky";
        $mail->SetFrom("email");
        $mail->Subject = $subject;
        $mail->Body = $msg;  
        $mail->AddAddress($to);
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        if(!$mail->Send()){
            echo $mail->ErrorInfo;
        }
    }


    function verificationDateNaissance() {
        // Récupérer la date de naissance depuis $_POST
        $birthday = $_POST["birthday"];

        // Vérifier si la date est au bon format (YYYY-MM-DD)
        if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $birthday)) {
            // Convertir la date de naissance en objet DateTime
            $dateNaissance = new DateTime($birthday);

            // Calculer la différence entre la date actuelle et la date de naissance
            $difference = $dateNaissance->diff(new DateTime());

            // Vérifier si la personne a au moins 15 ans
            if ($difference->y >= 15) {
                $etatBirthday = true;
            } else {
                $etatBirthday = false;
            }
        } else {
            $etatBirthday = false;
        }

        return $etatBirthday;
    }

    function verificationMotDePasse() {
        $password1 = $_POST["password"];
        $password2 = $_POST["password2"];

        if($password1 == $password2) {
            $etatPassword = true;
        } else {
            $etatPassword = false;
        }

        return $etatPassword;
    }

