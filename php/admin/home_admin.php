<?php session_start();
include("../../db/connect.php");
include ("../section/function.php");

if(!isset($_SESSION['loggedIN'])){
    header('Location:../section/login.php');
    exit();
}
?>

<?php include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
   

    <!--Admin section starts-->
    <section class="admin-home">

        <!--<h1 class="heading-title">Dashdoard</h1>-->

        <div class="box-container">
            <div class="box">
                <h3><span></span>Benvenuto/a<span></span></h3>
                <p><?php echo $user = $_SESSION['name'];?></p>
            </div>

            <div class="box">
                <h3><span></span><?=TotalPendings();?><span>€</span></h3>
                <p>Totale in sospeso</p>
                <a href="ordini.php" class="btn-admin">Visualizza ordini</a>
            </div>
            
            <div class="box">
                <h3><span></span><?=TotalCompletes();?><span>€</span></h3>
                <p>Ordini completati</p>
                <a href="ordini.php" class="btn-admin">Visualizza ordini</a>
            </div>

            <div class="box">
                <h3><span></span><?=selectOrders();?><span></span></h3>
                <p>Seleziona ordini</p>
                <a href="ordini.php" class="btn-admin">Visualizza ordini</a>
            </div>

            <div class="box">
                <h3><span></span><?=selectProducts();?><span></span></h3>
                <p>Prodotti aggiunti</p>
                <a href="prodotti.php" class="btn-admin">Visualizza prodotti</a>
            </div>

            <div class="box">
                <h3><span></span><?=selectNumberUsers();?><span></span></h3>
                <p>Client account</p>
                <a href="users.php" class="btn-admin">Visualizza clienti</a>
            </div>

            <div class="box">
                <h3><span></span><?=selectNumberAdmins();?><span></span></h3>
                <p>Admins account</p>
                <a href="admins.php" class="btn-admin">Visualizza admins</a>
            </div>

            <div class="box">
                <h3><span></span><?=selectMessages();?><span></span></h3>
                <p>Nuovi messaggi</p>
                <a href="messaggi.php" class="btn-admin">Visualizza messaggi</a>
            </div>
        </div>
    </section>
    <!--Admin section ends-->
       
        
<?php include("./template/footer.html"); ?>