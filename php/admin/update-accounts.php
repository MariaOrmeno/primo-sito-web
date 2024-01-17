<?php
include("../../db/connect.php");
include ("../section/function.php");
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

$message = updateAccounts($id);


$connessione = db();
$select_accounts = $connessione ->prepare("SELECT * FROM `users` WHERE id=:id");
$select_accounts->bindParam(':id', $id);
$select_accounts -> execute();


include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
    <!--Update profilo section starts-->
    <section class="form-container">   
        <form id="formUpdateProfilo" action="" method="post">
            <?php   if(isset($message)){
                    foreach($message as $message){
                        echo '
                        <div class="messaggio">
                            <span>'.$message.'</span>
                        </div>
                        ';
                    }
            }?>
            <?php
                 if($select_accounts->rowCount() > 0){
                    while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){
                ?>    

            <h3>Aggiorna il propfilo</h3>
            <input type="hidden" name="pass_attuale" value="<?= $fetch_accounts['password']; ?>">
            <input type="text" name="name" value="<?= $fetch_accounts['name']; ?>" required placeholder="Inserire il tuo nome" maxlength="20"  class="box">
            <input type="email" name="email" value="<?= $fetch_accounts['email']; ?>" required placeholder="enter your email" maxlength="50"  class="box">
            <input type="password" name="old_pass" placeholder="inserire la vecchia password" maxlength="20"  class="box">
            <input type="password" name="new_pass" placeholder="inserire la nuova password" maxlength="20"  class="box">
            <input type="password" name="confirm_pass" placeholder="conferma la nuova password" maxlength="20"  class="box">
            <input type="submit" value="Aggiorna ora" class="btn" name="azione">
            <?php
                    }
                }?>
        </form>
    </section>

        
<?php include("./template/footer.html"); ?>