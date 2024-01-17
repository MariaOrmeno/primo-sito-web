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
include 'components/checkout_cart.php';
?>

<?php include 'components/user_header.php'; ?>
   
    <!--Product section starts-->
    <section class="checkout-orders"> 
            <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="messaggi">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>
        <form id="formCheckout" action="" method="post" class="formCheckout">
            <h3>il tuo ordine</h3>  
     
            <div class="display-orders">
                <?php
                    $grand_total = 0;
                    $cart_items[] = '';
                    $connessione = db();
                    $select_cart = $connessione->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $select_cart->execute([$user_id]);
                    if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                            $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
                            $total_products = implode($cart_items);
                            $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                            ?>

                            <p> <?= $fetch_cart['name']; ?> <span>(<?= $fetch_cart['price'].' € x'. $fetch_cart['quantity']; ?>)</span> </p>

                            <?php
                        }
                    }
                    else{ echo '<p class="empty">your cart is empty!</p>';}
                ?>
                <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
                <div class="grand-total">TOTALE : <span><?= $grand_total; ?> €</span></div>
            </div>

            <h3>compila i tuoi dati</h3>

            <div class="flex">
                <div class="inputBox">
                    <span>Nome :</span>
                    <input type="text" name="name" placeholder="inserisce il tuo nome" class="box" maxlength="20" required>
                </div>

                <div class="inputBox">
                    <span>Numero di telefono :</span>
                    <input type="number" name="numero" placeholder="inserisce il tuo numero telefonico" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
                </div>

                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" name="email" placeholder="inserisce la tua mail" class="box" maxlength="50" required>
                </div>

                <div class="inputBox">
                    <span>Metodo di pagamento :</span>
                    <select name="method" class="box" required>
                        <option value="contanti">contanti</option>
                        <option value="carta di credito">carta di credito</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Indirizzo :</span>
                    <input type="text" name="address" placeholder="Via n° CAP città" class="box" maxlength="50" required>
                </div>
            </div>

            <input type="submit" name="azione" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="Invia ordine">
        </form> 
    </section>
    <!--Product section ends-->

<?php include("../html/footer.html"); ?>