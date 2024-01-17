<?php include("../html/header.html"); 
include("../db/connect.php");
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
 
$id = "";
if(isset($_GET['id'])){
    $id = trim($_GET['id']);    
}

$connessione = db();
$select_products = $connessione ->prepare("SELECT * FROM `product` WHERE id=:id");
$select_products->bindParam(':id', $id);
$select_products -> execute();

include 'components/wishlist_cart.php';
?>

<?php include 'components/user_header.php'; ?>
   
    <!--Product section starts-->
    <section class="view-Product">
            <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="messaggi">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>

        <div class="product-box">
            <?php

            if($select_products->rowCount() > 0){
                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form action="" method="post" class="formView">
                <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_products['id'];?>"/>
                
                <div class="flex">
                    <img src="./../img/prodotti/<?=$fetch_products['image'];?>" class="image" alt="">
                    <input type="hidden" name="image" id="image" value="<?=$fetch_products['image'];?>">
                </div>

                <div class="container">
                    <div class="inputBox"><?=$fetch_products['name'];?>
                        <input type="hidden" name="name_product" id="name_product" value="<?=$fetch_products['name'];?>">
                    </div>

                    <div class="categoria_nome"><?=$fetch_products['categoria_nome'];?>
                        <input type="hidden" name="categoria_nome" id="categoria_nome" value="<?=$fetch_products['categoria_nome'];?>">
                    </div>

                    <div class="price"><span><?=$fetch_products['price'];?></span> €                    
                        <input type="hidden" name="price" id="price" value="<?=$fetch_products['price'];?>">
                    </div>

                    <?php if ($fetch_products['quantity'] == 0){?>
                        <p class="nondisponibile"> <?php echo 'Non è disponibile';?> </p>
                    <?php
                    } 
                    else {?>  <p class="disponibile"> <?php echo 'DISPONIBILE';?> </p>

                    <div class="qt">    
                        <p>Quantità: <input type="number" name="quantity" class="quantity" min="0" max="99" value="1"></p>
                    </div>

                    <input type="submit" name="add_to_cart" value="Aggiungi al carrello" class="butt btn-cart">
                    <?php
                    }?>

                    <div class="details">
                        <h3 class="info">Informazioni su questo articolo</h3>
                        <?=$fetch_products['details'];?>
                        <input type="hidden" name="details" id="details" value="<?=$fetch_products['details'];?>">
                    </div>

                </div>
            </form>
            <?php
                }
            }
            else{ echo ' <p class="empty">nessun prodotto aggiunto!!</p>'; }?>

        </div>
    </section>
    <!--Product section ends-->

   
<?php include("../html/footer.html"); ?>