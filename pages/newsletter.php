<?php 
    include_once('./includes/components/base.php'); 
    if(isset($_POST['abonnement']))
    {
        $req = $bd->prepare("INSERT INTO newsletter (prenom, email) VALUES (:prenom, :email)");
        $req->execute(array(
            'prenom'=> $_POST['prenom'],
            'email' => $_POST['email']
        ));
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
