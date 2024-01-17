/*Admin prodotti*/
$(document).ready(function () {
    $('#formProduct').on('#azione', function(e){
        $.ajax({
            url:'prodotti.php',
            type: 'POST',
            data: new FormData(this),  
            cache: false,
            contentType: false,  
            processData:false,  
            success:function(response){
                $("#response").html(response);
            }
        });
    });
});

/**Admins account dati */
$(document).ready(function(){
    $('#formAdmins').on('#azione', function(e){
        e.preventDefault();
        $.ajax({
            url:'admins.php',
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

/**Client account dati */
$(document).ready(function(){
    $('#formUsers').on('#azione', function(e){
        e.preventDefault();
        $.ajax({
            url:'users.php',
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

/*ORDINI */
$(document).ready(function () {
    $('#formOrders').on('#azione', function(e){
        event.preventDefault();
        $.ajax({
            url:'ordini.php',
            type: 'POST',
            data: $(this).serialize(), 
            cache: false,
            contentType: false,  
            processData:true,  
            success:function(response){
                $("#response").html(response);
            }
        });
        $('#formOrders')[0].reset(); 
    });
});

/**UPDATE-ACCOUNTS ADMIN */
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

/**MESSAGGI ADMIN */
$(document).ready(function(){
    $('#formMess').on('#azione', function(e){
        e.preventDefault();
        $.ajax({
            url:'messaggi.php',
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