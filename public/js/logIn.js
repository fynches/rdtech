jQuery(document).ready(function( $ ) {
    
    $( "#signinForm" ).submit(function( event ) {
        return signin();
});
     $( "#forgot_pass" ).click(function() {
        $("#largeModalSI").modal('hide');
});

$( "#log" ).click(function() {
        $("#forgot_password").modal('hide');
        $("#largeModalSI").modal('show');
});

$( "#sign" ).click(function() {
        $("#forgot_password").modal('hide');
        $("#largeModalS").modal('show');
});

$( "#sig_in" ).click(function() {
        $("#largeModalS").modal('show');
        $("#largeModalSI").modal('hide');
});
$( "#sig_up" ).click(function() {
        $("#largeModalSI").modal('show');
        $("#largeModalS").modal('hide');
});
$( "#reset" ).click(function( event ) {
   
        return reset();
});    
    
    
});

function signup() {
    
    
    $.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
            $.ajax({
                type:'POST',
                url:'/signup',
                data:{
                    email:$( 'email' ).val(),
                    password:$( 'password' ).val(),
                },
                success:function(data){
                    if(data.result == 'Valid Info')
                
                        return true;
                    else
                        return false;
                },
                error:  function (error) {
                   alert('failed'); 
                }
            });
}

function reset() {
    $("#reset-message").html('');
    $.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'POST',
        url:'/reset',
        data:{
            email:$( '#email' ).val(),
        },
        success:function(data){
            if(data.error)
            {
                $("#reset-message").html(data.error);
                return;
            }
            $("#reset-message").removeClass('text-danger').addClass('text-success').html("An email has been sent with a password reset link");
        },
        error:  function (error) {}
    });
}

function signin() {
    
    $.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
            $.ajax({
                type:'POST',
                url:'/signin',
                data:{
                    email:$( 'email' ).val(),
                    password:$( 'password' ).val(),
                },
                success:function(data){
                    if(data.result == 'Found Match')
                        return true;
                    else
                        return false;
                },
                error:  function (error) {
                   alert('failed'); 
                }
            });
}