/*LOGIN */
$(document).ready(function(){
    $("#submit").on('click', function(){
        var name = $("#name").val();
        var pass = $("#pass").val();

        $.ajax({
            url:'login.php',
            method:'POST',
            data:{
                login:1,
                namePHP:name,
                passPHP:pass,
            },
            success:function(response){
                $("#response").html(response);

                if(response.indexOf('success') >=0){
                    window.location = './preacesso.php';
                }
            },
            dataType:'text'
        });
        $('#form-login')[0].reset();
    })
});

/**REGISTRAZIONE */
$(document).on('click', '#submit_reg', function(){       
    var name = $("#name").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var pass = $("#pass").val();
    var cpass = $("#cpass").val();
    
    $.ajax({
        url: 'registrazione.php',
        type: 'POST',
        data:{
        register:1,
        newnamePHP:name,
        newlastnamePHP:lastname,
        newemailPHP:email,
        newpassPHP:pass,
        newcpassPHP:cpass,
        }, 
        success:function(response){
            $("#response").html(response);
        },
    });
    $('#form-regis')[0].reset();   
})
