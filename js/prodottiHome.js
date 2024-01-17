/* HomeProduct */
$(document).ready(function(){
    $('#formHomeProduct').on('submit', function(e){ /*submit --> add_to_wishlist*/
        /*console.log('dentro');*/
        e.preventDefault();
        $.ajax({
            url:'prodotti.php',
            type:"POST",
            data: $(this).serialize(), /*un'altra opzione per inviare SOLO dati del form */
            cache:false,
            /*contentType: false,  
            processData:false,  */ /*per i metodi GET non sono necessari */
            success:function(response){
            $("#response").html(response)
            },
        }); 
        
    });
});

/*CONTATTACI */
$(document).ready(function () {
    $('#contattaci-form').on('#send', function(e){
        e.preventDefault();
        $.ajax({
            url:'contattaci.php',
            type: 'POST',
            data: $(this).serialize(), 
            cache: false,
            contentType: false,  
            processData:true,  
            success:function(data){
                $("#response").html(data);
                $('#contattaci-form')[0].reset(); 
            }
        });
    });
});


/*CARRELLO */
$(document).ready(function () {
    $('#formCart').on('#azione', function(e){
        e.preventDefault();
        $.ajax({
            url:'cart.php',
            type: 'POST',
            data: $(this).serialize(), 
            cache: false,
            contentType: false,  
            processData:true,  
            success:function(response){
                $("#response").html(response);
            }
        });
        $('#formCart')[0].reset(); 
    });
});

/*WISHLIST */
$(document).ready(function () {
    $('#formWishlist').on('#azione', function(e){
        e.preventDefault();
        $.ajax({
            url:'prova.php',
            type: 'POST',
            data: $(this).serialize(), 
            cache: false,
            contentType: false,  
            processData:true,  
            success:function(response){
                $("#response").html(response);
            }
        });
        $('#formWishlist')[0].reset(); 
    });
});

/*CHECHOUT */
$(document).ready(function () {
    $('#formCheckout').on('#azione', function(e){
        console.log('checkout');
        e.preventDefault();
        $.ajax({
            url:'checkout.php',
            type: 'POST',
            data: $(this).serialize(), 
            cache: false,
            contentType: false,  
            processData:true,  
            success:function(response){
                $("#response").html(response);
            }
        });
        $('#formCheckout')[0].reset(); 
    });
});

/**UPDATE PROFILE CLIENT */
$(document).ready(function(){
    $('#formUpdateProfilo').on('#azione', function(e){
        e.preventDefault();
        $.ajax({
            url:'update-profilo.php',
            type:"POST",
            data: $(this).serialize(), /*un'altra opzione per inviare SOLO dati del form */
            /*cache:false,*/
            contentType: false,  
            processData:false,   /*per i metodi GET non sono necessari */
            success:function(response){
            $("#response").html(response);
            },
        }); 
        
    });
});

/*SEARCH */
