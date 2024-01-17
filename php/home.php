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
   
    <!--Home transitions section starts-->
    <section class="home">
        <div class="swiper home-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide sfondo1">
                    <div class="content">
                        <span>Natural cosmetics that are good for you and the environmen</span>
                        <h3>Delicate formula</h3>
                    </div>
                </div>

                <div class="swiper-slide slide sfondo2">
                    <div class="content">
                        <span>A unique experience in perfect harmony with nature</span>
                        <h3>responsabile choices</h3>
                    </div>
                </div>

                <div class="swiper-slide slide sfondo3">
                    <div class="content">
                        <span>your virtuous beauty routine a gesture of love for the planet</span>
                        <h3>genuine | respectful | effective</h3>
                    </div>
                </div>
            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>

        </div>
    </section>
    <!--Home transitions section ends-->

    <!--home aboout section starts-->
    <section class="home-about">
        <div class="images">
            <img src="../img/home-team.jpg" alt="">
        </div>
        <div class="content">
            <h3>Su di noi</h3>
            <p>La nostra passione e il nostro impegno ci hanno guidato a sviluppare e
                diffondere il nostro concetto di haircare sostenibile anche oltre i confini
                nazionali. Oggi <strong>Alce</strong> è presente in oltre 35 Paesi nel mondo.
            </p>
            <a href="about.php" class="pulsante">Di più</a>
        </div>
    </section>
    <!--home aboout section ends-->

   <!-- services section starts -->
   <section class="services">
       
        <h1 class="heading-title">Our services</h1>
        
        <div class="box-container">
            <div class="box">
                <img src="../img/makeup.png" alt="">
                <h3>Make-up</h3>

            </div>
            
            <div class="box">
                <img src="../img/nails.png" alt="">
                <h3>Nails</h3>
            </div>

            <div class="box">
                <img src="../img/capelli.png" alt="">
                <h3>Capelli</h3>
    
            </div>

            <div class="box">
                <img src="../img/estetica.png" alt="">
                <h3>Estetica</h3>
            </div>
        </div>
        
<?php include("../html/footer.html"); ?>