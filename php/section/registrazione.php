<?php 
include("../../db/connect.php");
include ("./function.php");
session_start();

if(isset($_POST['register'])){
    $name=$_POST['newnamePHP'];
    $lastname=$_POST['newlastnamePHP'];
    $email=$_POST['newemailPHP'];
    $pass=$_POST['newpassPHP'];
    $cpass=$_POST['newcpassPHP'];

    if($name=="" || $lastname=="" ||$email=="" ||$pass==""  ||$cpass==""){
        exit('riempire i campi');}
    else userExists($name,$lastname,$email,$pass,$cpass);
}
?>
<?php include("./template/header.html"); ?>

<div class="icona">
    <i id="menu-btn" class="fas fa-bars"></i>
</div>
<div class="accesso">
    <!--<a href="./login.php" class="btn-login">Login</a>-->
    <a href="./login.php" class="btn-login">Indietro</a>
</div>

</section>
<!--header ends-->

    <!--Register section starts-->
   <section class="register_users">
    <form id="form-regis" action="registrazione.php" method="POST">
            
        <div class="message">   
            <p id="response"></p>
        </div>

        <h2>Registrazione</h2>
        
        <div class="inputBox">
        <input type="text" name="name" id="name" maxlength="20" required 
            placeholder="Inserisci il tuo nome" class="box" oninput="this.value=this.value.replace(/\s/g, '')">
        </div> 

        <div class="inputBox">
        <input type="text" name="lastname" id="lastname" maxlength="20" required 
            placeholder="Inserisci il tuo cognome" class="box" oninput="this.value=this.value.replace(/\s/g, '')">
        </div> 
        
        <div class="inputBox">  
            <input type="text" name="email" id="email" maxlength="100" required 
                placeholder="Inserisci la tua mail" class="box" oninput="this.value=this.value.replace(/\s/g, '')">                        
        </div>

        <div class="inputBox">
            <input type="password" name="pass" id="pass" maxlength="20" required 
            placeholder="Inserisci la tua password" class="box" oninput="this.value=this.value.replace(/\s/g, '')">
        </div>

        <div class="inputBox">
        <input type="password" name="cpass" id="cpass" maxlength="20" required 
        placeholder="Conferma la tua password" class="box" oninput="this.value=this.value.replace(/\s/g, '')">
        </div>

        <input type="submit" value="Registrati ora" class="btn" name="submit" id="submit_reg">
    </form>

    <!--Register section ends-->
<?php include("./template/footer.html"); ?>
