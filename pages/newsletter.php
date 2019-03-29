<?php 
    include_once('./includes/components/base.php'); 
    if(isset($_POST['abonnement']))
    {
        $req = $bd->prepare("INSERT INTO newsletter (prenom, email) VALUES (:prenom, :email)");
        $req->execute(array(
            'prenom'=> $_POST['prenom'],
            'email' => $_POST['email']
        ));

        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $boundary = md5(rand());
        $guide = 'guide-smart-ride.pdf';
        $sujet = 'Smart Ride : Bienvenue'; 
        if(preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $email)){
            $passage_ligne = "\n";
        }else{
            $passage_ligne = "\r\n";
        }

        $message = "Salut ".$prenom." !".$passage_ligne;
        $message .= $passage_ligne;
        $message .= "Vous faites désormais partie de la communauté des Smart Riders. La communauté qui consomme moins pour mieux vivre !".$passage_ligne;
        $message .= $passage_ligne;
        $message .= "Voici un cadeau de bienvenue : un petit guide pour en découvrir plus sur les transports urbains !" .$passage_ligne;
        $message .= $passage_ligne;
        $message .= "Bonne route !".$passage_ligne;

        $headers = 'Content-Type: multipart/mixed; charset=UTF-8; boundary='.$boundary .' '. $passage_ligne;
        $headers.= "From: L'équipe Smart Ride <contact@smart-ride.fr>" . $passage_ligne; 
        $headers.= "Reply-to: ".$prenom." <".$email.">" . $passage_ligne; 
        $headers.= "MIME-Version: 1.0" . $passage_ligne; 

        $email_message = '--' . $boundary . $passage_ligne;
        $email_message .= "Content-Type: text/plain; charset='utf-8'" . $passage_ligne;
        $email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; 
        $email_message .= $passage_ligne .$message. $passage_ligne; 

        $email_message .= $passage_ligne . "--" . $boundary . $passage_ligne; 
        $email_message .= 'Content-Type: application/pdf; name="'.$guide.'"'.$passage_ligne; 
        $email_message .= 'Content-Transfer-Encoding:base64'.$passage_ligne; 
        $email_message .= 'Content-Disposition: attachment; filename="'.$guide.'"'.$passage_ligne;
        $email_message .= $passage_ligne; 
        $source = file_get_contents($guide);
        $source = base64_encode($source);
        $source = chunk_split($source);
        $email_message .= $source;
        $email_message .= $passage_ligne."--".$boundary."--";

        mail($email, $sujet, $email_message, $headers); 
    } 
?>
<main id="newsletter" class="vcenter">
    <div class="container">
        <form class="row" method="POST" action="" autocomplete="off">
            <div class="col s4">
                <div class="input-field">
                    <input id="prenom" name="prenom" type="text">
                    <label for="prenom">Prénom</label>                
                </div>
            </div>
            <div class="col s4">
                <div class="input-field">
                    <input id="email" name="email" type="email" class="validate">
                    <label for="email">E-mail</label>                
                </div>
            </div>
            <div id="SubmitButton" class="col s4">
                <button class="btn white" type="submit" name="abonnement">Je m'abonne
                </button>
            </div>
        </form>
    </div>
</main>
