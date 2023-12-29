<form method="post">
    <!-- Pseudo -->
    <div>
        <label for="pseudo">Pseudo:</label>
        <input type="text" placeholder="Ton pseudo" name="pseudo" id="pseudo">
        <?php if(isset($etatPseudo)) :?>
            <?php if($etatPseudo != 'ok') :?><p class="error-inscription"><?php if($etatPseudo == "vide") :?>Votre pseudo ne peut pas être vide<?php elseif($etatPseudo == "espace") :?>Votre pseudo ne peut pas contenir d'espace<?php elseif($etatPseudo == "nombreCaractère") :?>Votre pseudo doit contenir entre 4 et 30 caractères<?php elseif($etatPseudo == "déja") :?>Votre pseudo est déja pris<?php else :?>Un soucis est arrivé, merci de recommencer ou de nous <a href="/contact">signaler</a><?php endif ?></p><?php endif ?>
        <?php endif ?> 
        </div>

    <!-- Date de naissance -->
    <div>
        <label for="birthday">Date de naissance:</label>
        <input type="date" name="birthday" id="birthday">
        <?php if(isset($etatDateNaissance)) :?>   
            <?php if($etatDateNaissance != 'ok') :?><p class="error-inscription"><?php if($etatDateNaissance == "vide") :?>Votre date de naissance ne peut pas être vide<?php elseif($etatDateNaissance == "pasassezage") :?>Vous ne possédez pas l'âge requis de 15 ans<?php else :?>Un soucis est arrivé, merci de recommencer où de nous le <a href="/contact">signaler</a><?php endif ?></p><?php endif ?>
        <?php endif ?>
    </div>
    
    <!-- Mail -->
    <div>
        <label for="mail">Adresse mail:</label>
        <input type="email" name="mail" id="mail">
        <?php if(isset($etatEmail)) :?>  
            <?php if($etatEmail != 'ok') :?><p class="error-inscription"><?php if($etatEmail == "vide") :?>Votre email ne peut pas être vide<?php elseif($etatEmail == "formatnon") :?>Votre email ne respecte pas le format "exemple@domaine.com/be/fr/..."<?php elseif($etatEmail == "déja") :?>Un compte est déja ouvert avec cet email<?php else :?>Un soucis est arrivé, merci de recommencer où de nous le <a href="/contact">signaler</a><?php endif ?></p><?php endif ?>   
        <?php endif ?>
    </div>

    <!-- Mot de passe -->
    <div>
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" id="password">
        <?php if(isset($etatMotDePasse1)) :?>  
            <?php if($etatMotDePasse1 == "vide") :?><p class="error-inscription">Votre mot de passe ne peut pas être vide</p><?php endif ?>
        <?php endif ?>
    </div>

    <!-- Vérification mot de passe -->
    <div>
        <label for="password2">Confirmation du mot de passe:</label>
        <input type="password" name="password2" name="password2" id="password2">
        <?php if(isset($etatMotDePasse2) && isset($etatMotDePasse)) :?>
            <?php if($etatMotDePasse2 == "vide" || $etatMotDePasse != "ok") :?><p class="error-inscription"><?php if($etatMotDePasse2 == "vide") :?>Votre confirmation de mot de passe ne peut pas être vide<?php elseif($etatMotDePasse == "noncompatible") :?>Vos deux mots de passe ne sont pas compatibles<?php elseif($etatMotDePasse == "formatnon") :?>Votre mot de passe doit contenir entre 6 et 30 caractères<?php endif ?></p><?php endif ?>
        <?php endif ?>
    </div>
    <div>
        <button name="btnInscription" value="envoyer">S'inscrire</button>
    </div>
</form>

<!-- <div class="line-with-or">
    <hr>
    <span>OU AVEC</span>
    <hr>
</div>

<div class="register-with-google">

</div> -->