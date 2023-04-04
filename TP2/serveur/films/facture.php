<!DOCTYPE html>
<html lang="fr">

  <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="../../publique/css/facture.css">

      <title>IFT 1147 - TP1</title>

  </head>

  <body>


  <?php

      require_once ("../BD/connexion.inc.php");

      $utilisateur = $_SESSION['utilisateur'];
      $prenom = $_SESSION['prenom'];
      $nom = $_SESSION['nom'];

      $total = $_POST['factureTotal'];

      if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur'] == NULL){
          echo "<p>Vous devez vous connecter pour accéder
          à cette page</p>";
          echo "<a href=\"../../publique/connexion.html\">Retour au formulaire</a>";
          exit();
        
          } 


      $filtre = "WHERE `courriel` = '$utilisateur' ";

      $requetteLoc = "SELECT * FROM `location_payment`" . $filtre;
      $compteur = 0;


      $listerLoc = mysqli_query ($connexion, $requetteLoc);
      while ($ligne = mysqli_fetch_object($listerLoc)){

              $date = date_create($ligne->date_location);
              date_add($date, date_interval_create_from_date_string('7 days'));
              $dataPlus = date_format($date, 'Y-m-d');
      
              if(date("Y-m-d") <= $dataPlus){
      
              $compteur++;	
              
              }
      }
      
  ?>


  <header class="clearfix">
        <div id="logo">
          <img src="../../publique/img/logo.png" alt="Logo">
        </div>
        <div id="company">
          <h2 class="name"><strong>Service de diffusion des films</strong></h2>
          <div>En ligne</div>
          <div>(000) 000-0450</div>
          <div><a href="mailto:company@example.com">facture@domain.com</a></div>
        </div>
      
      </header>
      <main>
        <div id="details" class="clearfix">
          <div id="client">
            <div class="to">Facturé à:</div>
            <h2 class="name"> <?php echo $prenom ." ". $nom  ?></h2>
            <!-- <div class="address">796 Silver Harbour, TX 79273, US</div> -->
            <div class="email"><a href="mailto:john@example.com"><?php echo $utilisateur  ?></a></div>
          </div>
          <div id="invoice">
            <h1>FACTURE</h1>
            <div class="date">Date : <?php  echo date("Y-m-d")  ?></div>
            <!-- <div class="date">Due Date: 30/06/2014</div> -->
          </div>
        </div>
        <table>
          <thead>
            <tr>
              <th class="no"></th>
              <th class="desc">DESCRIPTION</th>
              <th class="unit">  </th> 
              <th class="qty">QUANTITÉ</th>
              <th class="total">TOTAL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="no"></td>
              <td class="desc"><h3>Location</h3>Films divers</td>
              <td class="unit">  </td>
              <td class="qty"><?php echo $compteur  ?></td>
              <td class="total"> $ <?php echo $total  ?></td>
            </tr>
      
          </tbody>
          <tfoot>
          <!--  <tr>
              <td colspan="2"></td>
              <td colspan="2">SUBTOTAL</td>
              <td>$5,200.00</td>
            </tr> -->
            <tr>
              <td colspan="2"></td>
              <td colspan="2">TAX 25%</td>
              <td><?php $tax = $total * 0.25; echo number_format($tax, 2, '.', ' ')  ?></td>
            </tr>
            <tr>
              <td colspan="2"></td>
              <td colspan="2">GRAND TOTAL</td>
              <td><?php echo "$ " . number_format($total + $tax, 2, '.', ' ');  ?></td>
            </tr>
          </tfoot>
        </table>
        <div id="thanks"></div>
        <div id="notices">
          <div>
              <?php

              $payer = number_format($total + $tax, 2, '.', ' ');


              echo "                <form id='paymentFacture' action='payment.php' method='POST'> \n";
              echo "                <input type='hidden' id='facturePayment' name='facturePayment' value='$payer'>\n";
              echo "                <button type='submit'>Faire un payment</button></form>";

              echo "<a href=\"../../publique/membres.php\">Retour à la page des membres</a>"

              ?>

          </div>
          <div class="notice"></div>
        </div>
      </main>

      <footer>
      
      </footer>

  </body>
</html>