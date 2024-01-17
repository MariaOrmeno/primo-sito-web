<?php include("../html/header.html"); 
include("../db/connect.php");
include ("section/function.php");
session_start();

if(!isset($_SESSION['loggedIN'])){
    header('Location:./section/login.php');
    exit();
}

if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
}
else{
    $user_id = '';
}

if(isset($_POST['send'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $messaggio = $_POST['messaggio'];
    $user_id = $_SESSION['id'];
    $message = contactUs($name,$email,$telefono,$messaggio,$user_id);

}

include 'components/wishlist_cart.php';
?>
<?php include 'components/user_header.php'; ?>
   
    <!--About section starts-->
    <section class="contattaci">
        
        <h1 class="heading-title">Contattaci</h1>
        
        <form action="contattaci.php" method="POST" id="contattaci-form" class="contattaci-form">
  
    <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="message">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>
    
            <div class="flex">

                <div class="inputBox">
                    <span>Nome:</span>
                    <input type="text" required placeholder="Inserisci il tuo nome" name="name">
                </div>  

                <div class="inputBox">
                    <span>Mail:</span>
                    <input type="email" required placeholder="Inserisci la tua mail" name="email">
                </div>
                

                <div class="inputBox">
                    <span>Telefono:</span>
                    <input type="number" required placeholder="Inserisci il tuo numero telefonico" name="telefono">
                </div>

                <div class="inputBox">
                    <textarea class="messaggio" type="text" required placeholder="COME POSSIAMO AIUTARTI?" name="messaggio"></textarea>   
                </div>

            </div>

            <input type="submit" value="Invia" class="btn" name="send">

        </form>
</section>

<?php include("../html/footer.html"); ?>