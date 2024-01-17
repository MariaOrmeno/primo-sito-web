<div class="icona">
        <i id="menu-btn" class="fas fa-bars"></i>
    <?php   
if (isset($_SESSION['name'])){ ?>
        <i class="fas fa-user" id="user-icon"></i>
</div>  

    <div class="navbar2">
        <p><?php echo $user = $_SESSION['name']; ?></p>
        <a href="./../admin/update-profilo-admin.php">Aggiorna profilo</a>
        <a href="../section/logout.php"><i class="fas fa-sign-out"></i> Logout</a>

    </div>

<?php   } 

else { ?>
    <div class="accesso">
        <a href="./registrazione.php" class="btn-registrazione">Sign-up</a>
        <a href="./login.php" class="btn-login">Login</a>
        <a href="./indietro.php" class="btn-login">Indietro</a>
    </div>
<?php }?>

    </section>
<!--header admin ends-->
