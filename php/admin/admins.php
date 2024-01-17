<?php
include("../../db/connect.php");
include ("../section/function.php");
session_start();

if(!isset($_SESSION['loggedIN'])){
    header('Location:../section/login.php');
    exit();
}

gestisciAdmin();

include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
   
    <!--About section starts-->
    <section class="accounts">
        <form id="formAdmins" class="formAdmins" action="admins.php" method="POST">
            <h1 class="heading-title">Accounts admins</h1>
            <div class="box-container">
                <div class="box-add">
                    <p>Regista un nuovo admin</p>
                    <input class="dati" type="text" placeholder="Nome" value="" name="name" id="name_product" maxlength="100" >
                    <input class="dati" type="text" placeholder="Cognome" value="" name="lastname" id="lastname" maxlength="100">
                    <input class="dati" type="text" placeholder="e-mail" value="" name="email" id="email" maxlength="100">
                    <input class="dati" type="text" placeholder="password" value="" name="password" id="password" maxlength="100">
                    <input class="dati" type="text" placeholder="tipo" value="" name="tipo" id="tipo" maxlength="100">
                    <input type="submit" name="azione" id="azione" value="Aggiungi" class="button btn-add"> <!--delete_payments-->
                </div>

                <?php
                    $select_admins = selectAdmins();
                    if($select_admins ->rowCount() > 0){
                        while ($fetch_admins= $select_admins->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="box">
                        <p>ID admin<span> <?=$fetch_admins['id']?></span></p>
                        <p>Nome<span> <?=$fetch_admins['name']?></span></p>
                        <p>Cognome<span> <?=$fetch_admins['lastname']?></span></p>
                        <p>E-mail<span> <?=$fetch_admins['email']?></span></p>
                        <p>Password<span> <?=$fetch_admins['password']?></span></p>
                        <p>Tipo<span> <?=$fetch_admins['type']?></span></p>

                        <form method="post" class="flex-btn">
                            <input type="hidden" name="id" id="id" value="<?=$fetch_admins['id'];?>"/>
                            <a href="update-accounts.php<?='?page=update-accounts&id='.$fetch_admins['id'] ?>" id="id" class="fas-modifica">Modifica</a>
                            <input type="submit" name="azione" id="azione" value="Elimina" class="button btn-danger"> <!--delete_payments-->
                        </form>
                    </div>

                <?php  
                }
                    }
                else{
                    echo'<p class="empty">non ci sono ancora degli account!</p>';
                }
            ?> 
            </div>
        </form>
    </section>
    <!--About section ends-->
        
<?php include("./template/footer.html"); ?>
