$(document).ready(function( $ ) {
    
   $('.remove').click(function(event) {
       event.preventDefault();
       var id = $(this).data( "id" );
        removeGift(id);
    });
    
    $('#place-order').click(function(event) {
       event.preventDefault();
        placeOrder();
    });
    
    $( "#forgot_pass" ).click(function() {
        $("#largeModalSI").modal('hide');
        });
        
        $( "#log" ).click(function() {
                $("#forgot_password").modal('hide');
        });
        
        $( "#sign" ).click(function() {
                $("#forgot_password").modal('hide');;
        });
    
    $( "#sig_in" ).click(function() {
        $("#largeModalSI").modal('hide');
    });

    $( "#sig_up" ).click(function() {
            $("#largeModalS").modal('hide');
    });

    $( ".purchase-amounts" ).bind("keyup change", function()
    {
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        var id = $(this).data( "id" );
        var amount = $(this).val();

        $.post('/gift-live/cart-edit', {purchaseId: id, amount: amount}, function(json)
        {
            var balance = json.balance;
            $('#left-'+id).text(balance);
            var sum = 0;
            $('.purchase-amounts').each(function(){
                sum += +$(this).val();
            });
            $("#total").text(sum);
            $('#payment-total').val(sum);
        }, 'json');
    });
    
    
function placeOrder() {
 
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    
    var name = $('#cc_name').val();
    var number = $('#cc_number').val();
    var month = $('#cc_month').val();
    var year = $('#cc_year').val();
    var cvv = $('#cc_cvv').val();
    var fname = $('#cc_fname').val();
    var lname = $('#cc_lname').val();
    var address = $('#cc_address').val();
    var city = $('#cc_city').val();
    var state = $('#cc_state').val();
    var zip = $('#cc_zip').val();
    var country = $('#cc_country').val();
    var email = $('#cc_email').val();
    var confirm = $('#cc_confirm').val();
    var total = $('#payment-total').val();
    var message = $("#message").val();
    
    var prchs = {};
    $(".purchase-amounts").each(function() {
        prchs[$(this).data( "id" )] = $(this).val();
    });
    
    $('#error').html('');
   
    $.ajax({
    	type:'POST',
    	url:'/checkout/place-order',
    	data:{
    	    name:name,
    	    number:number,
    	    month:month,
    	    year:year,
    	    cvv:cvv,
    	    fname:fname,
    	    lname:lname,
    	    address:address,
    	    city:city,
    	    state:state,
    	    zip:zip,
    	    country:country,
    	    email:email,
    	    email_confirmation:confirm,
    	    total:total,
    	    prchs:prchs,
            message: message
    	},
    	success:function(json)
        {
    	    if(json.status == 'success')
    	    {
    	        window.location = '/checkout-success';
    	    }
    	    else
    	        {
    	            let html = '<div class="alert alert-danger">';
    	            html += "We have encountered the following errors processing this transaction <br/>";
    	            $.each(json.errors, function(i, error)
                    {
                        html += error + "<br/>";
                    });
    	            html += "</div>";
    	        $('#error').html(html);
    	    }
    	},
    	error:  function (error) {
    	    alert("We have encountered an error completing this purchase");
    	}
    });
}    

function removeGift(id) {
 
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                
    $.ajax({
    	type:'POST',
    	url:'/checkout/remove-gift',
    	data:{
    	    gift_id:id
    	},
    	success:function(data){	
    	    
    	    $('#prch-'+data.result).remove();
    	    
    	    $('.cart-items').each(function(){
              var totalPoints = 0;
              $(this).find('.purchase-amounts').each(function(i,n){
                totalPoints += parseInt($(n).val(),10); 
              });
              $('#total').text(totalPoints);
              $('#payment-total').val(totalPoints);
            });
    	},
    	error:  function (error) {
    	    
    	}
    });
}

});