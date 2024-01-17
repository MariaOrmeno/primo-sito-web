
<div class="icona">
    <?php
            $connessione = db();
            $count_wishlist_items = $connessione -> prepare("SELECT * FROM `wishlist` WHERE user_id = ? ");
            $count_wishlist_items -> execute([$user_id]);
            $total_wishlist_items = $count_wishlist_items ->rowCount();

            $connessione = db();
            $count_cart_items = $connessione -> prepare("SELECT * FROM `cart` WHERE  user_id = ?");
            $count_cart_items -> execute([$user_id]);
            $total_cart_items = $count_cart_items ->rowCount();
        ?>
        
        <i id="menu-btn" class="fas fa-bars"></i>
        
        <?php if (isset($_SESSION['name']) ){ ?>
        

        
        <i class="fas fa-search" id="search-icon"></i>
        <a href="./wishlist.php" class="fas fa-heart"><span> <?=$total_wishlist_items;?></span></a>
        <a href="./cart.php" class="fas fa-shopping-cart"><span> <?=$total_cart_items;?></span></a>
        <i class="fas fa-user" id="user-icon"></i>
    </div>  
    
    <div class="navbar2">
        <p><?php echo $user = $_SESSION['name']; ?></p>
        <a href="update-profilo.php">Aggiorna profilo</a>
        <a href="../php/section/logout.php"><i class="fas fa-sign-out"></i> Logout</a>

    </div>
    
    <!--Search form-->
    <form method="POST" action="search_page.php" class="search-form">
        <input type="search" placeholder="inserisci testo" name="search_box" id="search-box">
        <label name="search_btn" for="search-box" class="fas fa-search"></label>
        <!--<i class="fas fa-times" id="close"></i>-->
    </form>
    <?php   } ?>

</section>