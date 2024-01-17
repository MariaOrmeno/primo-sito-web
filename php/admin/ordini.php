<?php session_start();
include("../../db/connect.php");
include("./../section/function.php");

if(!isset($_SESSION['loggedIN'])){
    header('Location:../section/login.php');
    exit();
}

$message = orders();

include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>

    <!--About section starts-->
    <section class="order">
            <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="messaggi">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>
        <h1 class="heading-title">ordini</h1>

        <div class="box-container">
           <?php
            $connessione = db();
            $select_orders = $connessione -> prepare("SELECT * FROM `orders`");
            $select_orders -> execute();
            if ($select_orders -> rowCount() > 0){
                while ($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                
            ?>
            <div class="box">
                <p>ID utente<span> <?=$fetch_orders['user_id']?></span></p>
                <p>placed on<span> <?=$fetch_orders['placed_on']?></span></p>
                <p>Nome<span> <?=$fetch_orders['name']?></span></p>
                <p>Email<span> <?=$fetch_orders['email']?></span></p>
                <p>Numero di telefono<span> <?=$fetch_orders['number']?></span></p>
                <p>Indirizzo<span> <?=$fetch_orders['address']?></span></p>
                <p>Totale prodotti<span> <?=$fetch_orders['total_products']?></span></p>
                <p>Prezzo totale<span> <?=$fetch_orders['total_price']?> €</span></p>
                <p>Metodo di pagamento<span> <?=$fetch_orders['method']?></span></p>

                <form id="formOrders" action="" method="POST">
                    <input type="hidden" name="ordine" value="<?=$fetch_orders['id']; ?>">
                    <select name="payment_status" class="drop-down">
                        <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                        <option value="in sospeso">in sospeso</option>
                        <option value="completato">completato</option>
                    </select>
                

                    <div class="flex-btn">
                        <input type="hidden" name="order_id" id="order_id" value="<?=$fetch_orders['id'];?>"/>
                        <input type="submit" name="azione" id="azione" value="Modifica" class="button btn-modifica"><!--update_payments-->
                        <input type="submit" name="azione" value="Elimina" class="button btn-danger"> <!--delete_payments-->
                    </div>
                </form>
            </div>
            <?php  
            }
                }
            else{
                echo'<p class="empty">no orders places yey!</p>';
            }
           ?> 
        </div>

    </section>
    <!--About section ends-->
       
        
<?php include("./template/footer.html"); ?>