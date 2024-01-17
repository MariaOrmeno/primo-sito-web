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
 
include 'components/wishlist_cart.php';?>

<?php include 'components/user_header.php'; ?>
   
    <!--Product section starts-->
    <section class="product">
        <?php   if(isset($message)){
            foreach($message as $message){
                echo '
                <div class="messaggi">
                    <span>'.$message.'</span>
                </div>
                ';
            }
        }?>
        
        <!--<h1 class="heading-title">Prodotti</h1>-->    
        <div class="box-container">
            <?php
                $connessione = db();
                $select_products = $connessione ->prepare("SELECT * FROM `product`");
                $select_products -> execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                        $name_product =$fetch_products['name'];
            ?>
            <form class="formHomeProduct" id="formHomeProduct" action="" method="post">
                
                <div class="product-box">
                    <input type="hidden" name="product_id" id="product_id" value="<?=$fetch_products['id'];?>"/>
                    <input type="hidden" name="id_user" id="id_user" value="<?= $_SESSION['id'];?>"/> <!--ID UTENTE-->

                    <!--PREFERITI-->
                    <button type="submit" name="add_to_wishlist" class="fas fa-heart"></button> 
                    
                    <!--VISUALIZZAZIONE DEL PRODOTTO-->
                    <a href="viewProduct.php<?='?page=view-product&id='.$fetch_products['id'] ?>" id="id" class="fas fa-eye"></a>
                    
                    <img src="./../img/prodotti/<?=$fetch_products['image'];?>" class="image" alt="">
                    <input type="hidden" name="image" id="image" value="<?=$fetch_products['image'];?>">

                    <div class="name"><?=$fetch_products['name'];?>
                        <input type="hidden" name="name_product" id="name_product" value="<?=$fetch_products['name'];?>">
                    </div>

                    <div class="price"><span><?=$fetch_products['price'];?></span> €                    
                        <input type="hidden" name="price" id="price" value="<?=$fetch_products['price'];?>">
                    </div>
                </div>
            </form>
            <?php
                    }
                }
                else{
                    echo ' <p class="empty">nessun prodotto aggiunto!!</p>';
                }
            ?>
        </div>
    </section>
    <!--Product section ends-->



    
<?php include("../html/footer.html"); ?>