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

$message = cart($user_id);

include 'components/wishlist_cart.php';?>
<?php include 'components/user_header.php'; ?>

</section>
   <!--header ends-->
   
    <!--CART section starts-->
    <section class="cart">
        <h1 class="heading-title">Shopping cart:</h1>
        <div class="cart-product">
            <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="messaggi">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>
            <div class="box-container">
                <?php
                $user_id =  $_SESSION['id'];
                $grand_total = 0;
                $connessione = db();
                $select_cart = $connessione -> prepare("SELECT * FROM `cart` WHERE user_id = :user_id ");
                $select_cart -> bindParam(':user_id', $user_id);
                $select_cart -> execute();

                if ($select_cart ->rowCount() > 0){
                    while($fetch_cart = $select_cart ->fetch(PDO::FETCH_ASSOC)){
                        $product_id =$fetch_cart['pid'];
                ?>

                <div class="box-container-cart">
                    <form id="formCart" action="" method="post" class="formCart">

                        <input type="hidden" name="cart_id" id="cart_id" value="<?=$fetch_cart['id'];?>"/> 
                        <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id'];?>"/> <!--ID UTENTE-->
                        
                        <div class="flex">
                            <img src="./../img/prodotti/<?=$fetch_cart['image'];?>" class="image" alt="">
                            <input type="hidden" name="image" id="image" value="<?=$fetch_cart['image'];?>">
                        </div>

                        <div class="inputBox"><?=$fetch_cart['name'];?>
                        <input type="hidden" name="name_product" id="name_product" value="<?=$fetch_cart['name'];?>">
                        </div>

                        <div class="inputBox">
                            <div class="price"><span><?=$fetch_cart['price'];?></span> €</div>
                            <input type="hidden" value="<?=$fetch_cart['price'];?>" name="prezzo" id="prezzo">
                        </div>
                        
                        <div class="inputBox">  
                            <p>Quantità:</p>  
                            <input type="number" name="quantity" class="quantity" min="0" max="99" value="<?=$fetch_cart['quantity']; ?>">
                            <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_cart['pid'];?>"/>
                            <button type="submit" class="fas fa-edit"><input type="hidden"  name="azione" value="edit"></button>
                        </div>

                        <div class="sub-total">Totale: <span><?=$sub_total = $fetch_cart['price'] * $fetch_cart['quantity']?> €</span> </div>
                    </form>

                    <form method="post" class="flex-btn">
                        <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_cart['pid'];?>"/>
                        <input type="submit" name="azione" value="Elimina" class="butt btn-danger">
                    </form>
                </div>
                <?php
                $grand_total +=$sub_total;
                }
                }
                else{
                    echo '<p class="empty">Il tuo carrello è vuota</p>';
                }
                ?>
            </div>

            <div class="cart-total">
                <p>TOTALE : <span><?= $grand_total; ?> €</span></p>
                <form method="post" class="flex-btn">
                    <input type="hidden" name="product_id" id="product_id" value="<?= $user_id?>"/>
                    <input type="submit" name="azione" value="Continua lo shopping" class="wbut continua-s">
                    <input type="submit" name="azione" value="Procedi al checkout" class="wbut ordine">
                    
                    <!--"Elimina tutto" è disabilitato se la variabile "$grand_total" non è maggiore di 1-->
                    <input type="submit" name="azione" value="Elimina tutto" class="wbut btn-danger" <?= ($grand_total > 1)?'':'disabled'; ?>>
                </form>
            </div>
        </div>
    </section>
    <!--CART section ends-->
 
<?php include("../html/footer.html"); ?>