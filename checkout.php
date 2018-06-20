<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boulangerie de Raphaël</title>

  <!-- <link rel="stylesheet" href="formulaire.css" /> -->
  <link rel="stylesheet" href="css/boutiquestyle.css" />
  <link rel="stylesheet" href="css/checkout.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="script/checkout.js"></script>

</head>
<body>

<div id="bloc_page">

  <header>
    <div id="titre_principal">
      <div id="logo">
        <a href = "images/boutique_logo.jpg">
        <img src="images/boutique_logo.png" alt="Logo de la boutique" title ="cliquer pour agrandir" /> </a>
        <h1> Raphael Boulangerie </h1><br/>
      </div>
      <h2> Cacher Lemehadrin </h2>  
    </div>
   </header>

  <section>
    <article>
      <div id="contact" hidden>
        <h2> Identifiez-vous </h2>
        <form id="contact_ident" action="" method="POST" enctype="multipart/form-data">

         <div class="row">
            <label class="required" for="email">Votre mail </label><br />
            <input id="emailid" class="inputid" name="email" type="text" value="" size="30" /><br />
            <span id="emailid_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="mdp"> Mot de Passe </label><br />
            <input id="mdpid" class="inputid" name="mdp" type="password" value="" size="10" /><br />
            <span id="mdp_validation" class="error_message"></span>
          </div>
          <button id="oublie" hidden>Mot de passe oublié ?</button>
          <div  id="loadingoub" hidden ></div>

        </form>
        <div id="bt">
          <button id="modif" hidden >Modification de vos données</button>
        </div>

        <button id="envoi" class="bouton">Login</button>
        <button id="newuser" class="bouton">Nouveau client</button>
        <button id="retouruser" class="bouton">Retour à la boutique</button>
     
      </div>

      <div id="contact_creation" hidden>
        <h2> Identifiez-vous </h2>
        <form id="contact_cret" action="#" method="POST" enctype="multipart/form-data">
          <div class="row">
            <label class="required" for="prenamec">Votre prenom :</label><br />
            <input id="prenamec" class="inputnw" name="prenamec" type="text" value="" size="30"  /><br />
            <span id="prename_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="name">Votre nom :</label><br />
            <input id="namec" class="inputnw" name="namec" type="text" value="" size="30" /><br />
            <span id="name_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="email">Votre mail</label><br />
            <input id="emailc" class="inputnw" name="emailc" type="text" value="" size="30" /><br />
            <span id="email_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="tel">Votre téléphone</label><br />
            <input id="telc" class="inputnw" name="telc" type="text" value="" size="10" /><br />
            <span id="tel_validation" class="error_message"></span>
          </div>

           <div class="row">
            <label class="required" for="mdp">mot de passe</label><br />
            <input id="mdpc" class="inputnw" name="mdpc" type="password" value="" size="10" /><br />
            <span id="mdp_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="mdp">Repeter mot de passe</label><br />
            <input id="mdprc" class="inputnw" name="mdprc" type="password" value="" size="10" /><br />
            <span id="mdpr_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="adresse">Adresse</label><br />
            <textarea id="adrc" class="inputnw" name="adrc" rows="5" cols="30"></textarea>
            <br />
            <span id="adr_validation" class="error_message"></span>
          </div>      

          <div class="row">
            <label for="news">Newsletter</label>
            <input id="newsc" class="input" name="newsc" type="checkbox" /><br />
          </div>   

          <button id="creation" class="bouton">Valider</button>
          <button id="reset" type="reset"  class="bouton">Reset</button>
          <button id="resetc" type="reset"  class="bouton">Annuler</button>
        </form>
      </div>
 
     <div id="contact_modification" hidden>
        <h2> Modifier vos données </h2>
        <form id="contact_modif" action="#" method="POST" enctype="multipart/form-data">
          <div id="idm"></div>
          <div class="row">
            <label class="required" for="prenamem">Votre prenom :</label><br />
            <input id="prenamem" class="inputup" name="prenamem" type="text" value="" size="30"  /><br />
            <span id="prename_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="name">Votre nom :</label><br />
            <input id="namem" class="inputup" name="namem" type="text" value="" size="30" /><br />
            <span id="name_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="email">Votre mail</label><br />
            <input id="emailm" class="inputup" name="emailm" type="text" value="" size="30" /><br />
            <span id="email_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="tel">Votre téléphone</label><br />
            <input id="telm" class="inputup" name="telm" type="text" value="" size="10" /><br />
            <span id="tel_validation" class="error_message"></span>
          </div>

           <div class="row">
            <label class="required" for="mdp">mot de passe</label><br />
            <input id="mdpm" class="inputup" name="mdpm" type="password" value="" size="10" /><br />
            <span id="mdp_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="mdp">Repeter mot de passe</label><br />
            <input id="mdprm" class="inputup" name="mdprm" type="password" value="" size="10" /><br />
            <span id="mdpr_validation" class="error_message"></span>
          </div>

          <div class="row">
            <label class="required" for="adresse">Adresse</label><br />
            <textarea id="adrm" class="inputup" name="adrm" rows="5" cols="30"></textarea>
            <br />
            <span id="adr_validation" class="error_message"></span>
          </div>      

          <div class="row">
            <label for="news">Newsletter</label>
            <input id="newsm" class="input" name="newsm" type="checkbox" /><br />
          </div>   

          <button id="miseajour" class="bouton">Enregistrer</button>
          <button id="resetfm" type="reset"  class="bouton">Reset</button>
          <button id="resetm" type="reset"  class="bouton">Annuler</button>
        </form>
      </div>
 
      <div id="after_submit">
        <div id="btn-retour">
          <input id="retour" hidden type="submit" value="Retour à la boutique" />
        </div>
        <div id="after_submit_message">
        </div>
      </div>
   
      <div id="panier" hidden style ="padding-top: 35px;">
        <section class="container" >
          <article>
            <h1> Recapitulatif de la commande </h1>
            <div id = "infoclient">
              <div id="nameinfo"></div>
              <div id="adresseinfo"></div>
              <div id="emailinfo"></div>
              <div id="telinfo"></div>
            </div>
            <form id="contact_form" hidden action="process.php" method="POST" enctype="multipart/form-data">

              <div class="row">
                <input id="commande" class="input" name="commande" hidden/>
              </div>

              <div class="row">
                <input id="totalcommande" class="input" name="totalcommande" hidden />
              </div>

              <div class="row">
                <input id="name" class="input" name="name" hidden />
              </div>

              <div class="row">
                <input id="email" class="input" name="email" hidden  />
              </div>

              <div class="row">
                <input id="tel" class="input" name="tel" hidden  />
              </div>

              <div class="row">
                <input id="adresse" class="input" name="adresse" hidden  />
              </div>

              <div class="row">
                <label for="message">Message particulier </label><br />
                <textarea id="message" class="input" name="message" rows="7" cols="30"></textarea>
                <br />
                <span id="message_validation" class="error_message"></span>
              </div>
             
              <input id="submit_button" type="submit" value="Envoi de la commande" />
              <div  id="loading" hidden style="background:url('img/loading.gif') no-repeat center center;position:relative;top:0%;left:39%;width:8%;height:11%;"></div>
            </form>

            <div id="paniercommande">
              <table id="tableau" class="table">
                <thead>
                  <tr>
                    <th>Produit</th>
                    <th>Qte</th>
                    <th>Prix à l'unité </th>
                    <th>Total ligne</th>
                  </tr>
                </thead>
               </table>

              <div id="prixtot">
                <label><strong>Total de la commande : </strong></label> <label id = "prixTotal"></label>
                <label id = "nbreLignes" hidden></label>
              </div>
            </div>              


            <br/>
            <br/>
          </article>
        </section>
      </div>
      <br/>

      <div id="cache" style ="display: none;">
        <div id="erreur_ident" style ="display: none;">
          <div id="after_ident"></div>
          <button id="btn-ok" class="bouton">ok</button>
        </div>
      </div>
    </article>
  </section>

  <footer>
    <div id="coordo">
      <h1>Coordonnées de Raphaël</h1>
      <p>+972 53 2552 771</p>
      <p>+972 53 2552 773</p>
      <p>Adresse boutique : Rue Hertzl , Haïfa </p>
      <p> Vous souhaitez envoyer un mail <a href ="mailto:raphaelboulangerie@gmail.com" title="Mail à Raphaël" > à Rapahël</a> ?</p>
    </div>
  </footer>
</div>

<script type="text/javascript">

function init()
{
  var prixPanier = localStorage.getItem( "prixpanier" );
  var nbligne = localStorage.getItem( "nbligne" );
  var commande = '';
  
  if (nbligne > 0 )
  {
    $('#contact').show();
    var cartValue = localStorage.getItem( "cart" );
    var jsonPan = JSON.parse(cartValue);
    $('#commande').val(cartValue);
    $('#totalcommande').val(prixPanier);

    $.each( jsonPan, function() 
    {
      $.each(this,function( ident, val )
      { 
        var prixligne = val.prixArticle*val.qteArticle;
        var texte ="<tr>";
        texte += "<td style ='text-align : center;'> "+ val.nomArticle +" </td>";
        texte += "<td style ='text-align : center;'>" + val.qteArticle + "</td>";
        texte += "<td style ='text-align : center;'>" + val.prixArticle + "</td>";
        texte += "<td style ='text-align : center;'>" + prixligne + "</td>";
        texte +="</tr>";

        $('#tableau').append(texte);  
      });
    });
  } 
  else
  {
    $('#retour').show();
    var message = "<br /> Le panier est vide !!";             
    $('#after_submit_message').html(message);
    $('#after_submit').css('display', 'block');
  }
  $("#prixTotal").html(prixPanier);
  $("nbreLignes").html(nbligne);
}

$("#paiement").click(function()
{
  alert ('  FONCTION EN COURS DE MISE EN OEUVRE  ');
});

$("#retour").click(function()
{
  window.open('boutique.php', '_self');
});


$("#retouruser").click(function()
{
  window.open('boutique.php', '_self');
});



window.onload = init;

</script>
</body>
</html>