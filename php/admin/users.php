<?php
include("../../db/connect.php");
include ("../section/function.php");

session_start();

if(!isset($_SESSION['loggedIN'])){
    header('Location:../section/login.php');
    exit();
}

gestisciUser();

include("./template/header.html"); ?>

<?php include '../components/admin_header.php'; ?>
   
    <!--users section starts-->
    <section class="accounts">
        <form id="formUsers" class="formUsers" action="users.php" method="POST">
            
            <h1 class="heading-title">Accounts client</h1>
            
            <div class="message">   
                <p id="response"></p>
            </div>
            <!--<form action="users.php" class="formUsers" id="formUsers" method="GET">-->
        
            <div class="box-container">
                <?php
                    $select_users = selectUsers();
                    if($select_users ->rowCount() > 0){
                        while ($fetch_users= $select_users->fetch(PDO::FETCH_ASSOC)){
                ?>
                    <div class="box">
                        <p>ID utente<span> <?=$fetch_users['id']?></span></p>
                        <p>Nome<span> <?=$fetch_users['name']?></span></p>
                        <p>Lastname<span> <?=$fetch_users['lastname']?></span></p>
                        <p>Email<span> <?=$fetch_users['email']?></span></p>
                        <p>Password<span> <?=$fetch_users['password']?></span></p>
                        <p>Tipo<span> <?=$fetch_users['type']?></span></p>
                        
                        <form method="post" class="flex-btn">
                            <input type="hidden" name="id" id="id" value="<?=$fetch_users['id'];?>"/>
                            <a href="update-accounts.php<?='?page=update-accounts&id='.$fetch_users['id'] ?>" id="id" class="fas-modifica">Modifica</a>
                            <input type="submit" name="azione" id="azione" value="Elimina" class="button btn-danger"> <!--delete_payments-->
                        </form>
                    </div>

                <?php  
                        }
                    } 
                    else{echo'<p class="empty">non ci sono ancora degli account!</p>'; }?> 
            </div>
        </form>
    </section>
    <!--users section ends--> 
<?php include("./template/footer.html"); ?>
