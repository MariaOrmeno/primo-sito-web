<?php include("../html/header.html"); 
include("../db/connect.php");
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
 

include 'components/wishlist_cart.php';
?>
<?php include 'components/user_header.php'; ?>
   

   <div class="heading">
        <h1>chi siamo?</h1>
   </div>
   
    <!--About section starts-->
    <section class="about">

        <div class="about-box">

            <div class="about-container">
                <div class="image">
                    <img src="../img/team.jpg" alt="">
                </div>

                <div class="content">
                    <h3>La nostra storia</h3>
                    <p> <strong>Alce</strong> è un’azienda italiana di prodotti professionali per capelli.
                    Nasce a Torino nel 1990 e il suo know-how si fonda su anni di esperienza
                    nel settore. Nel 2016 <strong>Alce</strong> ha deciso di rivoluzionarsi concentrandosi sulla
                    tutela del pianeta e il benessere della persona.</p>
                
                    <div class="icons-container">
                        <div class="icons">
                            <i class="fas fa-users"></i>
                            <span>Consegna gratuita</span>
                        </div>

                        <div class="icons">
                            <i class="fas fa-hand-holding-usd"></i>
                            <span>Prezzi vantaggiosi </span>
                        </div>

                        <div class="icons">
                            <i class="fas fa-headset"></i>
                            <span>24/7 Servizio cliente</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-container">
                <div class="content">
                    <h3>Profilo del consumatore</h3>    
                    <p> Dedicato all’hairstylist e al consumatore che cerca
                        cosmetici naturali con performance professionali.</p>
                </div>
                <div class="image">
                    <img src="../img/profilocliente.png" alt="">
                </div>
            </div>

            <div class="about-container">
                <div class="image">
                    <img src="../img/relazionipubbliche.png" alt="">
                </div>
                <div class="content">
                    <h3>Relazioni pubbliche</h3>
                    <p> Siamo presenti agli appuntamenti più importanti del settore a livello 
                        internazionale. Occasioni importanti per accrescere la consapevolezza
                        aziendale, aumentare il portafoglio clienti e consolidare le relazioni con
                        i nostri distributori.
                        organizziamo meeting per condividere nuovi obiettivi e festeggiare
                        insieme i nostri successi.</p>
                </div>
            </div>
        </div>

        <h1>"YOUR VIRTUOUS BEAUTY ROUTINE A GESTURE OF LOVE FOR THE PLANET"</h1>
        
<?php include("../html/footer.html"); ?>