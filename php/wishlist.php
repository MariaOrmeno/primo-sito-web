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

$message = wishlist($user_id);

include 'components/wishlist_cart.php';
?>

<?php include 'components/user_header.php'; ?>

    <!--wishlist section starts-->
    <section class="wishlist">
        <h1 class="heading-title">La tua lista dei desideri:</h1>
        <?php   if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="messaggi">
                    <span>'.$message.'</span>
                </div>
                ';
            }
        }?>
        <div class="wishlist-product">
            <div class="box-container">
                <?php
                $user_id =  $_SESSION['id'];
                $grand_total = 0;
                $connessione = db();
                $select_wishlist = $connessione -> prepare("SELECT * FROM `wishlist` WHERE user_id = :user_id ");
                $select_wishlist -> bindParam(':user_id', $user_id);
                $select_wishlist -> execute();

                if ($select_wishlist ->rowCount() > 0){
                    while($fetch_wishlist = $select_wishlist ->fetch(PDO::FETCH_ASSOC)){
                        $grand_total += $fetch_wishlist['price'];
                ?>
                
                <div class="box-container-wishlist">
                    <form id="formWishlist" class="formWishlist" action="wishlist.php" method="post" class="box"> 
                        <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_wishlist['pid'];?>"/>
                        <input type="hidden" name="wishlist_id" id="wishlist_id" value="<?=$fetch_wishlist['id'];?>"/> 
                        <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id'];?>"/> <!--ID UTENTE-->
                        
                        <div class="flex">
                            <img width="50px" src="./../img/prodotti/<?=$fetch_wishlist['image'];?>" class="image" alt="">
                            <input type="hidden" name="image" id="image" value="<?=$fetch_wishlist['image'];?>">
                        </div>

                        <div class="inputBox"><?=$fetch_wishlist['name'];?>
                        <input type="hidden" name="name_product" id="name_product" value="<?=$fetch_wishlist['name'];?>">
                        </div>

                        <div class="inputBox">
                            <div class="price"><span><?=$fetch_wishlist['price'];?></span> €</div>
                            <input type="hidden" name="prezzo" id="prezzo" value="<?=$fetch_wishlist['price'];?>">
                        </div>

                        <div class="inputBox">    
                            <p>Quantità: <input type="number" name="quantity" class="quantity" min="0" max="99" value="1"></p>
                        </div>

                        <input type="submit" name="azione" value="Aggiungi al carrello" class="butt btn-cart">

                    </form>
                
                    <form method="post" class="flex-btn">
                        <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_wishlist['pid'];?>"/>
                        <input type="submit" name="azione" value="Elimina" class="butt btn-danger">
                    </form>
                
                </div>
                <?php
                }
                }
                else{
                    echo '<p class="empty">La tua lista desideri è vuota</p>';
                }
                ?>
            </div>

            <div class="wishlist-total">
                <p>TOTALE : <span><?= $grand_total; ?> €</span></p>
                
                <form method="post" class="flex-btn">
                    <input type="hidden" name="product_id" id="product_id" value="<?= $user_id?>"/>

                    <input type="submit" name="azione" value="Continua lo shopping" class="wbut continua-s">
                    <input type="submit" name="azione" value="Elimina tutto" class="wbut btn-danger" <?= ($grand_total > 1)?'':'disabled'; ?> >
                    <!--<a href="prodotti.php" class="wbut continua-s">Continua lo shopping</a><br>
                    <a href="wishlist.php?delete_all" class="wbut btn-danger" <?= ($grand_total > 1)?'':'disabled'; ?> onclick="return confirm('delete all from wishlist?');">Elimina tutto</a>
                    -->
                <form>
            </div>
        </div>
    </section>
    <!--wishlist section ends-->

        
<?php include("../html/footer.html"); ?>
