<?php session_start();
include("../../db/connect.php");
include ("../section/function.php");


if(!isset($_SESSION['loggedIN'])){
    header('Location:../section/login.php');
    exit();
}

$message = messaggiAdmin();


include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
    <!--Messaggi section starts-->
    <section class="messages">
            <?php   if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="messaggi">
                        <span>'.$message.'</span>
                    </div>
                    ';
                }
            }?>
        <form id="formMess" class="formMess" action="messaggi.php" method="POST">

            <h1 class="heading-title">Messaggi</h1>
            <div class="box-container">
                <?php
                $connessione = db();
                $select_messages = $connessione -> prepare("SELECT * FROM `messages`");
                $select_messages -> execute();
                if ($select_messages -> rowCount() > 0){
                    while ($fetch_messages = $select_messages->fetch(PDO::FETCH_ASSOC)){
                    
                ?>
                <div class="box">
                    <p>ID utente<span> <?=$fetch_messages['user_id']?></span></p>
                    <p>Nome<span> <?=$fetch_messages['name']?></span></p>
                    <p>Email<span> <?=$fetch_messages['email']?></span></p>
                    <p>Numero di telefono<span> <?=$fetch_messages['number']?></span></p>
                    <p>Messaggio<span> <?=$fetch_messages['message']?></span></p>
                    
                    <form action="" method="POST"></form>
                        <div class="flex-btn">
                            <input type="hidden" id="id" name="id" value="<?=$fetch_messages['id']; ?>">
                            <!--<input type="submit" name="update_payments" id="azione" value="Modifica" class="button btn-modifica">--><!--update_payments-->
                            <input type="submit" name="azione" value="Elimina" class="button btn-danger"> <!--delete_payments-->
                        </div>
                    </form>
                </div>
                <?php  
                }
                    }
                else{
                    echo'<p class="empty">Non ci sono nuovi messaggi!</p>';
                }
                ?> 

            </div>
        </form>
    </section>
    <!--Messaggi section ends-->
        
<?php include("./template/footer.html"); ?>