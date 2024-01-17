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

include 'components/wishlist_cart.php';

?>

<?php include 'components/user_header.php'; ?>
   
    <!--search section starts-->
    <section class="search-product">
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
        <form method="POST" action="search_page.php" class="search-form">
            <input type="search" placeholder="inserisci testo" name="search_box" id="search-box">
            <label name="search_btn" for="search-box" class="fas fa-search"></label>
            <!--<i class="fas fa-times" id="close"></i>-->
        </form> 
        <div class="box-container">
            <?php
            if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
                $search_box =$_POST['search_box'];
                $connessione = db();
                $select_products = $connessione ->prepare("SELECT * FROM `product` WHERE name like '%{$search_box}%' ");
                $select_products -> execute();
                if($select_products->rowCount() > 0){
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
            <form class="formHomeProduct" id="searchProduct" action="" method="post">
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
                    echo ' <p class="empty">nessun prodotto trovato!!</p>';
                    echo $_POST['search_box'];
                }
            }
            ?>
        </div>
    </section>
    <!--search section ends-->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#searchProduct').on('submit', function(e){ /*submit --> add_to_wishlist*/
                e.preventDefault();
                $.ajax({
                    url:'search_page.php',
                    type:"POST",
                    data: $(this).serialize(), /*un'altra opzione per inviare SOLO dati del form */
                    cache:false,
                    /*contentType: false,  
                    processData:false,  */ /*per i metodi GET non sono necessari */
                    success:function(response){
                    $("#response").html(response)
                    },
                }); 
                
            });
        });
    </script>   
    
<?php include("../html/footer.html"); ?>