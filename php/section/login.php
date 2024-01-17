<?php 
include("../../db/connect.php");
include ("./function.php");
session_start();

if(isset($_SESSION['loggedIN'])){
    header('Location: ./preacesso.php');
    exit();
}

if(isset($_POST['login'])){
    $name=$_POST['namePHP'];
    $pass=$_POST['passPHP'];

    if($name=="" || $pass==""){
        exit('riempire i campi');
    }
    else
    verifyUser($name, $pass);
}
?>

<?php include("./template/header.html"); ?>

        <div class="icona">
            <i id="menu-btn" class="fas fa-bars"></i>
           
        </div>  
 
        <div class="accesso">
            <div class="reg">
            <a href="./registrazione.php" class=" btn-registrazione">Sign-up</a>
        </div>

    </section>
    <!--header ends-->


    <!--users login starts-->
    <section class="login_users">
        <form action="login.php" method="POST" id="form-login">
            
            <div class="message">   
                <p id="response"></p>
            </div>

            <h2>Login</h2>
            
            <div class="inputBox">
                <input type="text" name="name" id="name" maxlength="20" required 
                placeholder="inserisci il tuo username" class="box" oninput="this.value=this.value.replace(/\s/g, '')">
            </div> 

            <div class="inputBox">
                <input type="password" name="pass" id="pass" maxlength="20" required 
                placeholder="inserisci la tua password" class="box" oninput="this.value=this.value.replace(/\s/g, '')" autocomplete="on">
            </div>

            <input type="button" value="Accedi ora" class="btn" name="submit" id="submit">

        </form>

    <!--users login ends-->
       
        
<?php include("./template/footer.html"); ?>