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
 
 
 $message = updateProfile($user_id);

include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
    <!--Update profilo section starts-->
    <section class="form-container">  
        <form id="formUpdateProfilo" class="formUpdateProfilo" action="" method="post">
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
                $connessione = db();
                $select_profile = $connessione -> prepare("SELECT * FROM `users` WHERE id=:id");
                $select_profile->bindParam(':id', $user_id);
                $select_profile -> execute();
                if ($select_profile -> rowCount() > 0){
                    while ($fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)){           
                ?>

            <h3>Aggiorna il tuo propfilo</h3>
            <input type="hidden" name="pass_attuale" value="<?= $fetch_profile['password']; ?>">
            <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="Inserire il tuo nome" maxlength="20"  class="box">
            <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" required placeholder="enter your email" maxlength="50"  class="box">
            <input type="password" name="old_pass" placeholder="inserire la vecchia password" maxlength="20"  class="box">
            <input type="password" name="new_pass" placeholder="inserire la nuova password" maxlength="20"  class="box">
            <input type="password" name="confirm_pass" placeholder="conferma la nuova password" maxlength="20"  class="box">
            <input type="submit" value="Aggiorna ora" class="btn" name="azione">
            <?php
                    }
                }?>
        </form>
    </section>
        
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#formUpdateProfilo').on('#azione', function(e){
                e.preventDefault();
                $.ajax({
                    url:'update-profilo-admin.php',
                    type:"POST",
                    data: $(this).serialize(), /*un'altra opzione per inviare SOLO dati del form */
                    cache:false,
                    /*contentType: false,  
                    processData:false,  */ /*per i metodi GET non sono necessari */
                    success:function(response){
                    $("#response").html(response);
                    },
                }); 
                
            });
        });
    </script>   
        
<?php include("./template/footer.html"); ?>