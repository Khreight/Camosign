<?php

    function createUser($pdo, $token) {

        $passwordCrypted = password_hash($_POST["password"], PASSWORD_BCRYPT);

        try{
            $query = "insert into utilisateur (utilisateurInscriptionDate, utilisateurPseudo, utilisateurMail, utilisateurNaissance, utilisateurRole, utilisateurPassword, utilisateurToken, utilisateurVerifie, UtilisateurBanned) values (NOW(), :utilisateurPseudo, :utilisateurMail, :utilisateurNaissance, :utilisateurRole, :utilisateurPassword, :utilisateurToken, :utilisateurVerifie, :utilisateurBanned)";
            $newUser = $pdo->prepare($query);
            $newUser->execute([
                'utilisateurPseudo' => $_POST["pseudo"],
                'utilisateurMail' => $_POST["mail"],
                'utilisateurNaissance' => $_POST["birthday"],
                'utilisateurRole' => 'user',
                'utilisateurPassword' => $passwordCrypted,
                'utilisateurCodeVerification' => $token,
                'utilisateurVerifie' => 0,
                'utilisateurBanned' => 0
            ]);
        }
        catch(PDOException $e){
            $message = $e->getMessage();
            die($message);
        }
    }

    function searchToken($pdo, $tentativeToken) {
        try{
            $query = "SELECT utilisateurId FROM utilisateur WHERE utilisateurToken = :utilisateurToken";
            $tentativeTokenBDD = $pdo->prepare($query);
            $tentativeTokenBDD->execute([
                'utilisateurToken' => $tentativeToken
            ]);
        }
        catch(PDOException $e){
            $message = $e->getMessage();
            die($message);
        } 

        return $tentativeTokenBDD;
    }

    function activateVerif($pdo, $userTokenSearch) {
        try{
            $query = "UPDATE utilisateur SET utilisateurVerifie = 1 WHERE utilisateurId = :utilisateurId";
            $newUser = $pdo->prepare($query);
            $newUser->execute([
                'utilisateurId' => $userTokenSearch
            ]);
        }
        catch(PDOException $e){
            $message = $e->getMessage();
            die($message);
        } 
    }

    function verifTooToken($pdo, $token) {
        try{
            $query = "SELECT utilisateurToken FROM utilisateur WHERE utilisateurToken = :utilisateurToken ";
            $verifTokenBDD = $pdo->prepare($query);
            $verifTokenBDD->execute([
                'utilisateurToken' => $token
            ]);
        }
        catch(PDOException $e){
            $message = $e->getMessage();
            die($message);
        } 

        return $verifTokenBDD;
        
    }

    function verificationPseudo ($pdo) {
        try {
            $query = "SELECT utilisateurPseudo FROM utilisateur WHERE utilisateurPseudo = :utilisateurPseudo AND utilisateurBanned = 1";
            $verifPseudoBDD = $pdo->prepare($query);
            $verifPseudoBDD->execute([
                'utilisateurPseudo' => $_POST["pseudo"]
            ]);
        }catch(PDOException $e){
            $message = $e->getMessage();
            die($message);
        } 

        return $verifPseudoBDD;
        
    }
    
    

    function verificationEmail ($pdo) {
        try {
            $query = "SELECT utilisateurMail FROM utilisateur WHERE utilisateurMail = :utilisateurMail  AND utilisateurBanned = 0 AND utilisateurSuppression = 0";
            $verifEmailBDD = $pdo->prepare($query);
            $verifEmailBDD->execute([
                'utilisateurMail' => $_POST["mail"]
            ]);
        }catch(PDOException $e){
            $message = $e->getMessage();
            die($message);
        } 

        return $verifEmailBDD;
        
    }
    