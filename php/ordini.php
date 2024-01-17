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
 }else{
    $user_id = '';
 };
 
include 'components/wishlist_cart.php';
?>

<?php include 'components/user_header.php'; ?>
   
    <!--Ordine section starts-->
    <section class="orders-view">
        <h1 class="heading-title">Ordini inviati</h1>    
        <div class="box-container">

            <?php
            $connessione = db();
                $select_orders = $connessione->prepare("SELECT * FROM `orders` WHERE user_id =:user_id");
                $select_orders->bindParam(':user_id', $user_id);
                $select_orders->execute();

                if($select_orders->rowCount() > 0){
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="box">
            <p>Data di invio : <span><?= $fetch_orders['placed_on']; ?></span></p>
            <p>Nome : <span><?= $fetch_orders['name']; ?></span></p>
            <p>Email : <span><?= $fetch_orders['email']; ?></span></p>
            <p>Numero di telefono : <span><?= $fetch_orders['number']; ?></span></p>
            <p>Indirizzo : <span><?= $fetch_orders['address']; ?></span></p>
            <p>Metodo di pagamento : <span><?= $fetch_orders['method']; ?></span></p>
            <p>I tuoi ordini : <span><?= $fetch_orders['total_products']; ?></span></p>
            <p>Prezzo totale : <span>$<?= $fetch_orders['total_price']; ?>/-</span></p>
            <p> Stato di pagamento : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
            </div>
            <?php
            }
            }else{
                echo '<p class="empty">no orders placed yet!</p>';
            }
            
            ?>

        </div>
    </section> 
    <!--Ordine section ends-->
<?php include("../html/footer.html"); ?>