$(document).ready(function( $ ) {
   $('#post_message').click(function(event) {
       event.preventDefault();
        sendMessage();
    });
    $('.give-gift').click(function(event) {
       event.preventDefault();
        $(this).hide();
        var id = $(this).data( "id" );
        $('#prch-'+id).show();
        $('#dlr-'+id).show();
        $('#img-'+id).hide();
        $('#imgrp-'+id).show();
        $('#para-'+id).show();
        $('#cancel-'+id).show();
        $('#gift-image-'+id).css('cursor', 'pointer');
    });
    
     $('.purchase').keyup(function(event){
         var id = $(this).data( "id" );
         console.log(id);
         var amount = $(this).val();
         if(amount === '') {
             amount = 0;
         }
         var needed = $('#needed-'+id).data( "amount" );
         var gifted = $('#gifted-'+id).data( "amount" );
         
         var need = parseFloat(needed,10) - parseFloat(amount,10);
         var gift = parseFloat(gifted,10) + parseFloat(amount,10);
         
         $('#checkout').show();
         
         if(need < 0) {
             var need = 0;
         }
         
         if(isNaN(need)) {
             var need = 0;
             
         }
         
         if(isNaN(gift)) {
             var gift = 0;
         }
         $('#needed-'+id).text(need.toFixed(2));
         $('#gifted-'+id).text(gift.toFixed(2));
         
         $('#needed-'+id).data('result', need);
         $('#gifted-'+id).data('result', gift);
         
        var sum = 0;
        $(".purchase").each(function(){
            sum += +$(this).val();
        });
        $('#total').text(sum.toFixed(2));
         
        var giftedAmount = $('#gifted-'+id).data( "result" );
        
        if(parseFloat($('#prch-'+id).val(),10) == parseFloat($('#needed-' + id).data('amount'),10)) {
            $('#imgrp-'+id).hide();
            $('#img-'+id).hide();
            $('#fagift-'+id).show();
            $('#cancel-'+id).hide();
        }
        else {
            $('#fagift-'+id).hide();
            $('#img-'+id).hide();
            $('#imgrp-'+id).show();
            $('#cancel-'+id).show();
        }
        
        cart(id, giftedAmount); 
         
    });
    
    $('.cart,.cancel').click(function(event){
        var id = $(this).data( "id" );
        var needed = $('#needed-'+id).data( "result" );
        var gifted = $('#gifted-'+id).data( "result" );
        
        cart(id, gifted);
        
        if(needed === undefined || needed === null || needed === '') {
            if($('#needed-'+id).data( "amount" )) {
                needed = parseFloat($('#needed-'+id).data( "amount" ),10);
            }
            else {
                needed = 0;
            }
            console.log(needed);
        }
        
        if(needed <= 0){
            $('#fagift-'+id).hide();
            $('#imgrp-'+id).hide();
            $('#para-'+id).hide();
            $('#cancel-'+id).hide();
            $('#gift-image-'+id).show();
            $('#img-'+id).show();
        }
        else {
            $('#fagift-'+id).hide();
            $('#imgrp-'+id).hide();
            $('#para-'+id).hide();
            $('#gft-'+id).show();
            $('#cancel-'+id).hide();
            $('#prch-'+id).hide();
            $('#dlr-'+id).hide();
            $('#img-'+id).show();
        }
        
    });
    
});

function giveGift() {
    var name = $('#live_textname').val();
    var message = $('#live_textmsg').val();
    var childs_name = $('#childs_name').val();
    var textname = $('#live_textname').attr('name');
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    
   
                
    $.ajax({
    	type:'POST',
    	url:'/gift-live/message',
    	data:{
    	    message:message,
    	    name:name,
    	    childs_name: childs_name
    	},
    	success:function(data){	},
    	error:  function (error) {
    	    alert('error');
    	}
    });
}

function cart(id, giftedAmount) {
    var amount = $('#prch-'+id).val();
    if(amount === '') {
        amount = 0;
    }
    var pageid = $('#page-id').val();
    console.log(amount);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                
    $.ajax({
    	type:'POST',
    	url:'/gift-live/cart',
    	data:{
    	    amount:amount,
    	    gift_page_id:pageid,
    	    gift_id:id
    	},
    	success:function(data){	
    	    
    	},
    	error:  function (error) {
    	   
    	}
    });
}

function sendMessage() {
    var name = $('#live_textname').val();
    var message = $('#live_textmsg').val();
    var id = $('#post_message').data( "id" );
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    
   
                
    $.ajax({
    	type:'POST',
    	url:'/gift-live/message',
    	data:{
    	    message:message,
    	    name:name,
    	    id:id
    	},
    	success:function(data){
  
    	    var text = $('#live_textmsg').val();
    	    var name = $('#live_textname').val();
    	    $('#live_textmsg').val('');
    	    $('#live_textname').val('');
    	    
            var html = '<div class="row" id="msg">'+
            '             '+
            '            <div class="col-md-1 col-xs-4">'+
            '                <img src="'+data.child.recipient_image+'" style="width:100%">'+
            '            </div>'+
            '           '+
            '            <div class="col-md-11 col-xs-8">'+
            '                <div class="row">'+
            '                    <div class="col-md-2 col-xs-4">'+
            '                        <h5><strong>'+ name +'</strong></h5>'+
            '                    </div>'+
            '                    <div class="col-md-10 col-xs-8">'+
            '                        <p style="color:#d9d9d9;margin: 8px 0 0 0;"><i class="far fa-clock"></i> Just Now</p>'+
            '                    </div>'+
            '                </div>    '+
            '                '+
            '                <div class="row">'+
            '                    <div class="col-md-12" >'+
            '                        <p class="small_msg">'+ text +'</p>'+
            '                    </div>'+
            '                </div>'+
            '                '+
            '            </div>'+
            '            '+
            '        </div>';
            	
            $('#messages').prepend(html);
    	    
    	},
    	error:  function (error) {
    	    alert('error');
    	}
    }); 
}