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
    
    $( ".purchase-amounts" ).bind("keyup change", function() {
      var id = $(this).data( "id" );
      var amount = $(this).val();
      var left = $('#left-'+id).data( "left" );
      var price = $('#left-'+id).data( "price" );
      
      var lft = price - left - amount;
     
      if(lft < 0){
          var lft = 0;
      }
      
      var sum = 0;
        $('.purchase-amounts').each(function(){
            sum += +$(this).val();
        });
        $("#total").text(sum);
      
      $('#payment-total').val(sum);
      $('#left-'+id).text(lft);
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
    
    var prchs = {};
    $(".purchase-amounts").each(function() {
        prchs[$(this).data( "id" )] = $(this).val();
    });
    
    $('#last-row').empty();
   
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
    	    confirm:confirm,
    	    total:total,
    	    prchs:prchs
    	},
    	success:function(data){	
    	    console.log(data);
    	    if(data.success == 1) {
            	        var url = "/checkout-success";
                        $(location).attr('href',url);
    	    } else {
    	        $('#last-row').append('<div class="alert alert-danger">'+data.result+'</div>');
    	    }
    	},
    	error:  function (error) {
    	    
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