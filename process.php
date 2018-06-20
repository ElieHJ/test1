<?php
  header('Content-Type: text/html; charset=utf-8');

  // CONDITIONS NOM
  if ( (isset($_POST["name"])) && (strlen(trim($_POST["name"])) > 0) ) {
    $nom = stripslashes(strip_tags($_POST["name"]));
  } else {
    echo "Merci d'écrire un nom <br />";
    $nom = "";
  }

  // CONDITIONS TELEPHONE
  if ( (isset($_POST["tel"])) && (strlen(trim($_POST["tel"])) > 0) ) {
    $tel = stripslashes(strip_tags($_POST["tel"]));
  } else {
    echo "Merci d'écrire un telephone <br />";
    $tel = "";
  }

  $sujet = " Commande de : " . $nom . " Telephone : " . $tel ;

  // CONDITIONS EMAIL
  if ( (isset($_POST["email"])) && (strlen(trim($_POST["email"])) > 0) && (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) ) {
    $email = stripslashes(strip_tags($_POST["email"]));
  } elseif (empty($_POST["email"])) {
    echo "Merci d'écrire une adresse email <br />";
    $email = "";
  } else {
    echo "Email invalide :(<br />";
    $email = "";
  }

  $contenucomm ='';
  // CONDITIONS COMMANDE
  if ( (isset($_POST["commande"])) && (strlen(trim($_POST["commande"])) > 0) ) {
    // $commande = stripslashes(strip_tags($_POST["commande"]));
    $json = $_POST["commande"];
  } else {
    // echo "Merci d'écrire un message<br />";
    $commande = "pbl sur la commande";
  }
  $commande = json_decode($json);

  // echo "commade envoyéee par mail ";
  // echo print_r( $commande);

  foreach ($commande as $comm)
  {
    foreach ($comm as $commtmp)
    { 
      foreach ($commtmp as $key => $value)
      {
        // echo "<br /> cle :" . $key . " valeur " .  $value . "<br />";
        if ($key == 'qteArticle')
        {
          $qte = $value ;
        }
        if ($key == 'nomArticle')          
        {
          $prod = $value;
        }
        if ($key == 'prixArticle')
        {
          $prix = $value;
        }
      }
      $contenucomm .= strtoupper($prod). " -  Qte : " . $qte  . "\r\n   Prix U : " . $prix . " Sqhl \r\n\n";
    }
  }

 // CONDITIONS PRIX COMMANDE
  if ( (isset($_POST["totalcommande"])) && (strlen(trim($_POST["totalcommande"])) > 0) ) {
    $totalcommande = $_POST["totalcommande"];
  } else {
    $totalcommande = "pbl sur la donnée total de la commande ";
  }

  // CONDITIONS MESSAGE
  if ( (isset($_POST["message"])) && (strlen(trim($_POST["message"])) > 0) ) {
    $message = stripslashes(strip_tags($_POST["message"]));
  } else {
    // echo "Merci d'écrire un message<br />";
    $message = " Pas de demande specifique du client ";
  }

  // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé

  // PREPARATION DES DONNEES
  $separation = '-----=' . md5(uniqid(mt_rand()));

  $ip           = $_SERVER["REMOTE_ADDR"];
  $hostname     = gethostbyaddr($_SERVER["REMOTE_ADDR"]);

  // $destinataire = "monadresse@example.com";
  $destinataire = "severinebitoun@gmail.com,raphaelboulangerie@gmail.com,laurenthassan@hotmail.com";

  $objet        = "[Raphael Boulangerie] - " . $sujet;

  $contenu      = "Nom de du client : " . $nom . "\n";
  $contenu     .= "Mail du client : " . $email . "\n";
  $contenu     .= "Telephone du client : " . $tel . "\n\n";
  $contenu     .= "Commande du client : " . "\n\n" ;
  $contenu     .=  $contenucomm . "\n";
  $contenu     .=  "PRIX TOTAL COMMANDE : " . $totalcommande . " Shql  \n\n" ;
  $contenu     .= "Demande specifique : " . $message . "\n\n";

  // $contenu     .= "Adresse IP de l'expéditeur : " . $ip . "\r\n";
  // $contenu     .= "DLSAM : " . $hostname;

  // $headers  = "From: " . $email . " \n"; // ici l'expediteur du mail
  $headers  = "From: raphaelboulangerie@gmail.com \n"; // ici l'expediteur du mail
  $headers .= "CC: " . $email . " \n"; // ici l'expediteur du mail
  $headers .= "Reply-To: " . $email . " \n"; // ici l'expediteur du mail
  $headers .= "Bcc: laurenthassan@hotmail.com \n";
  $headers .= "Content-Type: text/plain; charset=\"uft-8\" ; DelSp=\"Yes\"; format=flowed" ." \n";
  $headers .= "Content-Disposition: inline" ."\n";
  $headers .= "Content-Transfer-Encoding: 8bit". " \n";     
  $headers .= "MIME-Version: 1.0"."\n";
  $headers .=' boundary="'.$separation.'"';
 
  // SI LES CHAMPS SONT MAL REMPLIS
  if ( (empty($nom)) && (empty($sujet)) && (empty($email)) && (!filter_var($email, FILTER_VALIDATE_EMAIL)) && (empty($message)) ) {
      echo "<script>$('#submit_button').show();</script> echec sur le mail :( <br /><a href='boutique.php'>Retour à la boutique</a>)";
  } else {
      // ENCAPSULATION DES DONNEES 
     // if (mail($destinataire, $objet, utf8_decode($contenu), $headers))
     if (mail($destinataire, $objet, $contenu, $headers))

      {  
        // stockage du mail et des caracteristique de la commande
        include "sql/processInsertCommandeSQL.php";
        
        //Traitement du stockage du detail de la commande
        $commande = json_decode($json);
        foreach ($commande as $comm)
        {
          foreach ($comm as $commtmp)
          { 
            foreach ($commtmp as $key => $value)
            {
              if ($key == 'codeArticle')
              {
                // echo '<br /> traitement insert commande detail';
                // echo "cle :" . $key . " valeur " .  $value . "<br />";

                $req = $bdd->prepare("INSERT INTO commande_detail (id_numero_facCD, id_produitCD) VALUES (:id_numero_facCD,:id_produitCD)");
                $req->execute(array('id_numero_facCD' => $id_facture, 'id_produitCD' => $value));
                if (!$req)
                {
                  echo "\nInsert detail commande ";
                  echo "\nPDO::errorCode(): ", $req->errorCode();
                  echo "\nPDO::errorInfo():\n";
                  print_r($req->errorInfo());
                }
              }
            }
          }
        }
        echo '<br /> La commande a été envoyée. <br />';
      }
      else
      { echo 'Erreur envoi mail'; }
  }

  // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>