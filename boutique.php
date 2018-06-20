<?php
/**
 * @file shabbat.php - decide if it is Shabbat (Approximation only!)
 * @author Erel Segal
 * @date 2007-08-04
 */
/**
 * @return a negative value before sunset, a positive value after sunset (in Israel)
 */

function minutes_after_sunset_gmt() {
  $zero_based_day_of_year = gmdate("z");
  $gmt_minutes = gmdate("H")*60 + gmdate("i");
  $earliest_sunset_day_of_year = -11;  // 21.December
  $days_in_a_year = 365.25;
  $phase_relative_to_earliest_sunset = ($zero_based_day_of_year - $earliest_sunset_day_of_year) / $days_in_a_year*2*pi();
  $sunset_average_gmt_minute = 15*60+47;  // 15:47 GMT, 17:47 IST - average between 16:40 to 18:54
  $sunset_radius_minutes = 67;
  $sunset_gmt_minutes = $sunset_average_gmt_minute - $sunset_radius_minutes * cos($phase_relative_to_earliest_sunset);
  //print "Sunset: " . floor($sunset_gmt_minutes/60) . ":" .  ($sunset_gmt_minutes%60);
  //print "Current: " . floor($gmt_minutes/60) . ":" .  ($gmt_minutes%60);
  return $gmt_minutes - $sunset_gmt_minutes;
}
function shabbat() {
  $minutes_after_sunset = minutes_after_sunset_gmt();
  $zero_based_day_of_week = gmdate("w");
    // $zero_based_day_of_week = 6;
  $shabbat_addition_minutes = 35; // approximation
  if ($zero_based_day_of_week==5 && $minutes_after_sunset > -$shabbat_addition_minutes) {
    //print "Friday, after Shabbat entrance";
    return TRUE;
  } elseif ($zero_based_day_of_week==6 && $minutes_after_sunset < $shabbat_addition_minutes) {
    //print "Saturday, before Shabbat exit";
    return TRUE;
  }   else  {
    return FALSE;
    // return TRUE;
  }
}
?>

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boulangerie de Raphaël</title>

  <link rel="stylesheet" href="css/boutiquestyle.css" />
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <script src="script/boutique.js"></script>
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->
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

    <?php 
      if (!shabbat())
      { 
      ?>
      <nav>
        <ul>
          <li><a href="#" id ="accueil">Accueil</a></li>
          <li><a href="#" id="livre">Livre d'Or</a></li>
          <li><a href="#coordo" id="contact">Contact</a></li>
        </ul>
      </nav>
      <?php 
      }  
      ?>
  </header>
 

<?php 
if (shabbat())
  { echo "<script>alert(\"Chabbat . La boutique est fermée\")</script>";
  // { echo "<script>alert(\"La boutique est en travaux\")</script>";
?>
  <div id="shabbat">
     <h1> Pas de ventes pendant Shabbat </h1>
    <!-- <h1> La boutique est en travaux </h1> -->
  </div>
<?php 
}
else
{  
?>
  <div id="banniere_image">
    <div id="banniere_description">
      Bienvenue sur la boutique en ligne de Raphaël
      <button id="slide" class="bouton">Panorama Photos</button>
    </div>
  </div>

  <section>
    <article>
  
      <div id="listeproduits">

        <h1> Détails des produits</h1>

        <table id="tableauproduits">
          <div id="lignevide">
            <p> Liste vide </p>
          </div>
        </table>
      </div>
      <br/>
      <br/>
      <label id = "nbreLignes" hidden>0</label>
      <div id="accespanier"> 
     
        <button style="background-image:shopping-cart-728410_1280.png" id="boutonpanier" class="bouton"> Panier </button>
        <label id = "Nbarticle">0</label>
      </div>
    </article>
  </section>

  <footer>
    <div id="coordo">
      <h1>Coordonnées de Raphaël</h1>
      <p>+972 53 2552 771</p>
      <p>+972 53 2552 773</p>
      <p>Adresse boutique : Rue Hertzl , Haïfa </p>
      <p> Vous souhaitez envoyer un mail <a href ="mailto:raphaelboulangerie@gmail.com" title="Mail à Raphaël" > à Raphaël</a> ?</p>
    </div>

    <div id="mes_photos">
      <h1>Photos</h1>
      <p><img src="images/photo1.jpg" alt="Photographie" /><img src="images/photo2.jpg" alt="Photographie" /><img src="images/photo4.jpg" alt="Photographie" /></p> 
    </div>

    <div id="mes_amis">
      <h1>Lieux de vente</h1>
      <div id="listes_amis">
        <ul>
          <li>A la boutique</li>
          <li>Intel</li>
          <li>Technion</li>
          <li>Hopital RAMBAM</li>
        </ul>
        <ul>
          <li>Neve Chaanan</li>
          <li>Créche.....</li>
          <li>Autres</li>
          <li>A domicile</li>
        </ul>
      </div>
    </div>
  </footer>
</div>

<!-- The Modal -->
<div id="myModalpanier" class="modal-panier">
  <!-- Modal content -->
  <div class="modal-content-panier">
    <span style="margin-top: -9px;" class="close-panier">&times;</span>
   <!-- Partie panier -->
      <section id="container_panier" class="container" >
        <article>
          <h1>Contenu du panier</h1>
          <table id="tableau" class="table">
            <thead>
              <tr>
                <th id='codeth'>Code</th>
                <th>Produit    </th>
                <th>Prix unitaire</th>
                <th>   </th>
                <th>Qte</th>
                <th>  </th>
                <th>Total de la ligne</th>
                <th>    </th>
              </tr>
            </thead>
          </table>

          <br><label>Prix total du panier</label> : <label id = "prixTotal"></label>
          <br/>
          <br/>

            <nav>
                <ul>
                  <li><button id="checkout" class="bouton">Checkout</button>
                  <li></li>
                  <li><button id="viderlepanier" class="bouton"> Vider le panier </button></li>
                  <li><button id="savelepanier" class="bouton"> Sauvegarder le panier </button></li>
                  <li><button id="restorelepanier" class="bouton"> Restorer le panier </button></li>

                </ul>
            </nav>
        </article>
      </section>
  </div>
</div>
<?php 
}
?>
<script>

var listeproduit = [];
var listeproduitpanier = [];

// Gestion de l'objet ligne panier 
function LignePanier (code, prix, qte, nom)
{
  this.codeArticle = code;
  this.prixArticle = prix;
  this.qteArticle = qte;
  this.nomArticle = nom;

  this.ajouterQte = function()
  {
    this.qteArticle += 1;
  }
  this.retirerQte = function()
  {
    if (this.qteArticle > 0)
    {
      this.qteArticle -= 1;
    }
  }
  this.getPrixLigne = function()
  {
    var resultat = this.prixArticle * this.qteArticle;
    return resultat;
  }
  this.getCode = function() 
  {
    return this.codeArticle;
  }
  this.getNom = function() 
  {
    return this.nomArticle;
  }
  this.getQte = function() 
  {
    return this.qteArticle;
  }
}

// Gestion de l'objet Panier
function Panier()
{
  this.liste = [];
  
  this.ajouterArticle = function(code, prix , qte, nom)
  { 
    var index = this.getArticle(code);
    if (index == -1) this.liste.push(new LignePanier(code, prix, qte, nom));
  }
  this.getPrixPanier = function()
  {
    var total = 0;
    for(var i = 0 ; i < this.liste.length ; i++)
        total += this.liste[i].getPrixLigne();
    return total;
  }

 this.getNbArticlePanier = function()
  {
    var total = 0;
    for(var i = 0 ; i < this.liste.length ; i++)
        total += this.liste[i].getQte();
    return total;
  }


  this.prixLigneProduit = function(code)
  { 
    var index = this.getArticle(code);
    if (index == -1) return 0 ;
    else return this.liste[index].getPrixLigne();
  }
  this.qteLigneProduit = function(code)
  { 
    var index = this.getArticle(code);
    if (index == -1) return 0 ;
    else return this.liste[index].getQte();
  }
  this.modifierQte = function(code,qte)
  { 
    var index = this.getArticle(code);
    if (qte == 1) this.liste[index].ajouterQte();
    else this.liste[index].retirerQte();
  }
  this.getArticle = function(code)
  {
    for(var i = 0 ; i <this.liste.length ; i++)
      if (code == this.liste[i].getCode()) return i;
    return -1;
  }
  this.supprimerArticle = function(code)
  {
    var index = this.getArticle(code);
    if (index > -1) this.liste.splice(index, 1);
  }
}

var monPanier = new Panier();


//modal panier 

var modalpanier = document.getElementById('myModalpanier');
var btnpanier = document.getElementById("boutonpanier");
var spanpanier = document.getElementsByClassName("close-panier")[0];
btnpanier.onclick = function() {
    modalpanier.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
spanpanier.onclick = function() {
    modalpanier.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modalpanier) {
        modalpanier.style.display = "none";
    }
}
</script>
</body>
</html>