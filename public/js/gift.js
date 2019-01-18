jQuery(document).ready(function( $ ) {
    var count = 0;
    
    $('body').on('click', 'button[data-target="#myModal"]',function() {
           if(count < 1) {
              $("#lightSlider").lightSlider({
                  gallery:true,
                  controls:false,
                  enableDrag:false,
                  item:1
              });
              count++;
           }
        });
        
    jQuery.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");    
        
   
   
   $("#gift_form").validate({
	        ignore: [],
	        highlight: function (element) {
	            $(element).parent('div').addClass('has-error');
	        },
	        unhighlight: function (element) {
	            $(element).parent('div').removeClass('has-error');
	        },
	        errorClass: 'help-block help-block-error',
	        errorElement: 'div',
	        rules: {
				gift_title: {required: true},
				message: {required: true},
				inp_date: {required: true,},
				inp_age: {required: true},
				inp_host: {required: true, lettersonly: true},
			},
			messages: {
			    inp_host: {lettersonly: "Please Enter Valid Name"},
			},
	        errorPlacement: function (error, element) {         
	                error.insertAfter(element);           
	        },
	        success: function (element) {
	            $(element).parent('.form-group').removeClass('has-error');
        	},
        	    
		});
    
    $('#live-submit').click(function() {
        var valid = $("#gift_form").valid();
        
        if(valid){
        var id = $(this).data('id');
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); 
                     $.ajax({
                    	type: 'post',
                    	url: '/make-live',
                    	data: {
                    		id:id,
                    },
                    success: function(data) {
                        var route = '/gift-page/'+data.slug;
                        window.location.replace(route);    
                    }
                });
        }
    });
    
    $('#private_dash').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); 
             $.ajax({
            	type: 'post',
            	url: '/make-private',
            	data: {
            		id:id,
            },
            success: function(data) {
                var route = '/gift/'+data.slug;
                window.location.replace(route);    
            }
        });
    });
     
    $('body').on('mouseover','.hoverimg', function(event) {
       event.preventDefault();
        var id = $(this).data( "id" );
        $('#cartimg-'+id).show();
        $('#cancel_1-'+id).show();
    });    
    
     $('body').on('mouseleave','.hoverimg', function(event) {
       event.preventDefault();
        var id = $(this).data( "id" );
        $('#cartimg-'+id).hide();
        $('#cancel_1-'+id).hide();
    });  
    
    $('.added_gifts .draggable').mousedown(function() {
        if($(".added_gifts").is(':ui-sortable')) {
            $(".added_gifts").sortable('enable');
        }
        else {
            $(".added_gifts").sortable({
                update: function(event, ui) {
                    $(".added_gifts").sortable('disable');
                    var ids = [];
                    var slug = window.location.pathname.split('/')[2];
                    $('.added_gifts .reco_col').each(function(i){
                        if($(this).length && !isNaN(parseInt($(this).attr('id'),10))) {
                            ids[i] = parseInt($(this).attr('id'),10);
                        }
                    });
                    ids = ids.filter(function(v){return v!== (undefined || null)});
                   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); 
                   $.ajax({
            			type: 'post',
            			url: '/giftSort',
            			data: {
            			    ids:ids,
            			    slug:slug
            			},
            		   success: function(data) {
            		       
                        }
            		});
                }
            });
        }
    });
    
    $('body').on('click','button[name="add"]',function() {
        var id = $(this).data('id');
        var slug = window.location.pathname.split('/')[2];
         $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
					type: 'post',
					url: '/addGift',
					data: {
					    id:id,
					    slug:slug
					},
				   success: function(data) {
				       var style;
				       if(data.favorite == 'favorited-button') {
				           style = 'style="color:red;"';
				       }
				       else {
				           style = 'style="color:white;"';
				       }
				       if(data.is == 1) {
                        return;
                    } else {
                        var gift =  '<div class="col-md-3 reco_col pointer" id="'+ id +'">'+
'                            <div id="hoverimg-'+ id +'" class="hoverimg" data-id="'+ id +'" style="position: relative; background: url('+ data.image +'); width:100%; height:250px; background-size:100% 100%; ">'+
'                                <div id="cartimg-'+ id +'" class="cart_1" data-id="'+ id +'"></div>'+
'                                <div class="row cancel_1"  data-id="'+ id +'" id="cancel_1-'+ id +'">'+
'                                    <div class="col-md-6 text-left"></div>'+
'                                    <div class="col-md-6 text-right">'+
'                                        <div class="col-md-4"><img id="move-'+ id +'" class="draggable" data-id="'+ id +'" src="http://fynches.codeandsilver.com/public/front/img/Move_white.png" style="width:100%"></div>'+
'                                        <div class="col-md-4"><img id="edit-'+ id +'" class="edit-dets" data-toggle="modal" data-target="#gift_Add" data-id="'+ id +'" src="http://fynches.codeandsilver.com/public/front/img/edit_white.png" style="width:100%"></div>'+
'                                        <div class="col-md-4"><img id="move-'+ id +'" class="trash" data-id="'+ id +'" src="http://fynches.codeandsilver.com/public/front/img/Delete_white.png" style="width:100%"></div>'+
'                                    </div>'+
'                               </div>'+
'                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">'+
'                                    <a href="javascript:void(0)" class="'+ data.favorite +'" data-pnum="'+ id +'"><i class="fas fa-heart fa-2x heart-'+ id +'" '+ style +'></i></a>'+
'                                </div>'+
'                           </div>'+
            '                            <div class="shad-effect">'+
            '                                <label>'+ data.gift.title +'</label>'+
            '                                <p>'+ data.business +'</p>'+
            '                                    <div class="row" id="marg">'+
            '                                        <div class="col-md-6 col-xs-6">'+
            '                                            <button class="btn btn-lg add_submit" name="remove" data-id="'+ id +'">REMOVE</button>'+
            '                                        </div>'+
            '                                        <div class="col-md-6 col-xs-6 text-right">'+
            '                                           <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">$'+ data.gift.price +'</p><p class="text-center" style="font-weight:100;font-size:10px;font-family:Avenir-Book;margin-top:5px">GIFTED</p></div>'+
            '                                           <div class="col-md-6 col-xs-6"><p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">$45</p><p class="text-center" style="font-weight:100;font-size:10px;font-family:Avenir-Book;margin-top:5px">NEEDED</p></div>'+
            '                                        </div>'+
            '                                   </div>'+    
'                                           </div>' +
            '                        </div>';
                        
                        $('#added').append(gift);
                        
                        $('.btns-'+id).html(
                        '<div class="row" id="marg">'+
                            '<div class="col-md-6 col-xs-6">'+
                                '<button class="btn btn-lg add_submit" data-id="'+ id +'" name="remove">REMOVE</button>'+
                            '</div>'+
                            '<div class="col-md-6 col-xs-6 text-right">'+
                                '<div class="col-md-6 col-xs-6"> <p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">$'+ data.gift.price +'</p><p class="text-center" style="font-weight:100;font-size:10px;font-family:Avenir-Book;margin-top:5px">GIFTED</p></div>'+
                                '<div class="col-md-6 col-xs-6"><p class="text-center" style="font-family:Avenir-Black;font-size:16px;color:#34344A;margin-top: 10px;line-height: 16px;">$45</p><p class="text-center" style="font-weight:100;font-size:10px;font-family:Avenir-Book;margin-top:5px">NEEDED</p></div>'+
                            '</div>'+
                        '</div>');
                    }
				} 
			});
    });
    
    $('body').on('click','.trash, button[name="remove"]',function() {
        var id = $(this).data('id');
        var slug = window.location.pathname.split('/')[2];
         $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
					type: 'post',
					url: '/removeGift',
					data: {
					    id:id,
					    slug:slug
					},
				   success: function(data) {
				       if(data.is == 1) {
				          $('#added #' + data.id).remove();
				          $('.btns-'+id).html(
				             ' <div class="row">'+
                                        '<div id="img_1" class="col-md-6 col-xs-6">'+
                                            '<button class="btn btn-primary btn-lg btn_purp gift-dets" data-id="'+ id +'" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>'+
                                        '</div>'+ 
                                    '</div>'+   
                                    
                                    '<div class="row">'+
                                        '<div class="col-md-6 col-xs-6">'+
                                            '<button class="btn btn-primary btn-lg yellow_submit" name="add" data-id="'+id+'">QUICK ADD</button>'+
                                        '</div>'+
                                        '<div class="col-md-6 col-xs-6 text-right" id="gift_price">'+
                                            '<p style="font-size:16px;font-family:Avenir-Black;color:#34344A;line-height:16px">$'+ (data.gift.price !== null ? data.gift.price : data.gift.est_price) +'</p>'+
                                            (data.gift.price === null ? '<p>Est. Price <i class="fas fa-info-circle"></i></p>' : '')+
                                       '</div>'+
                                    '</div>'
				              );
				       }
				       
				        
				} 
			});
    });
    
    $( '#update-child-zipcode' ).click(function() {
		    
				$.ajax({
					type: 'post',
					url: '/update-child-zipcode',
					data: {
					    '_token': $('input[name=_token]').val(),
					    'child_zipcode': $('#child-zipcode').val(),
						'page_id': $('#gift_head').data('page-id'),
					},
				   success: function(data) {
				       
				       $('#giftZip').removeClass('in').hide();
				       $('body').removeClass('modal-open').css({"padding-right": ""});
				       $( '.modal-backdrop' ).remove();
				       $('#child-zip-code').text(data.zip);
				       $('#base-zip').text(data.zip);
				       $('#child-zip-code').click();
				     
					} 
				}).done(function(data) {
				    
				});
		
			
		});
    
    $( '.background-image' ).click(function() {
		    
				$.ajax({
					type: 'post',
					url: '/background-image',
					data: {
					    '_token': $('input[name=_token]').val(),
						'image_id': $(this).data('image-id'),
						'page_id': $('#gift_head').data('page-id'),
					},
				   success: function(data) {
				       
				       $('#gift_background').removeClass('in').hide();
				       $('body').removeClass('modal-open').css({"padding-right": ""});
				       $( '.modal-backdrop' ).remove();
				       $('section.gift_experience').css({"background" : 'url('+data.url+')', "background-size" : 'cover'}); 
				       $('.bg').click();
				     
					} 
				}).done(function(data) {});
		
			
		});
	$('#gft_title').keyup(function() {
	    var limit = 60;
        var chars = $(this).val().length;
        $('#title-limit').text((limit - chars) + ' of 60 characters remaining');
	});
    $('#gft_det').keyup(function() {
	    var limit = 360;
        var chars = $(this).val().length;
        $('#details-limit').text((limit - chars) + ' of 360 characters remaining');
	});
	
	$('body').on('click', '.edit-dets', function() {	
	    var id = $(this).data('id');
	    console.log(id);
	    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
			type: 'post',
			url: '/editGift',
			data: {id:id},
		    success: function(data) { 
		        $('#gift_Add').attr('data-id',id);
			    $('#gift_Add #gift_url').val(data.url);
			    $('#gift_Add #gift_title').val(data.title);
			    $('#gift_Add #gift_desc').val(data.description);
			    $('#gift_Add #gift_image').attr('src', data.image);
			    $('#gift_Add input[name="image"]').val(data.image);
			    $('#gift_Add #gift_price').val(data.price);
             }
        });	
	});	
	
		$('#gift_Add').on('change', '#image-input', function() {
	     var input = $(this).val();
        var reader = new FileReader();
       var file = reader.readAsDataURL(input.files[0]);
	     console.log(input);
	     readFile(input);
	});
	
	function readFile(input) {
 			if (input.files && input.files[0]) {
	           console.log(file);
	        }
		}
	
	$('body').on('click', '.gift-dets', function() {	
	    var id = $(this).data('id');
	    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
					type: 'post',
					url: '/giftDetails',
					data: {id:id},
				   success: function(data) { 
				       $('#myModal').attr('data-id',id);
                        var myvar = '<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$(\'#myModal\').hide();">'+
                        '          <span aria-hidden="true">×</span>'+
                        '        </button>'+
                        '          <div class="col-md-6">'+
                        '            <ul id="lightSlider" style="width:100%!important;height:100%;">';
                        for(var i in data.images) {
                        myvar += '     <li data-thumb="'+ data.images[i] +'" style="width:100%!important;">'+
                        '                  <img src="'+ data.images[i] +'" width="100%" alt="picture"/>'+
                        '              </li>';
                        }
                        myvar +='</ul>'+
                        '        </div>'+
                        '        <div class="col-md-6" id="images_gift">'+
                        '            <h5 >'+ data.bName +'</h5>'+
                        '            <h1>'+ data. bTitle +'</h1>'+
                        '            <h4><strong>AGES   </strong>'+ data.age_range +'</h4>'+
                        '            <div class="col-md-6" style="padding-left:0">'+
                        '                <h4><a id="gifts">GIFT DESCRIPTION</a></h4>'+
                        '            </div>'+
                        '            <div class="col-md-6">'+
                        '                <h4><a id="business">BUSINESS INFO</a></h4>'+
                        '            </div><br><br>'+
                        '            <div id="gift_descrip">'+
                        '                <p>'+
                        '                    <strong>Description</strong><br>'+ data.bDesc +'</p>'+
                        '               <br><br>'+
                        '            </div>'+
                        '             <div id="bus_descrip" style="display:none">'+
                        '                <p>'+ data.details +'</p>'+
                        '                <p><strong>'+ (data.address.length ? data.address : "") +'</strong><br></p>'+
                        '                <p><strong>'+ (data.phone.length ? data.phone : "") +'</strong><br></p>'+
                         '                <p><a href="'+ (data.website.length ? data.website : "")+'" target="_blank">WEBSITE</a><br></p>'+
                        '            </div>'+
                        '        <div class="col-md-6">'+
                        '            <div class="row">'+
                        '                <button class="btn btn-primary yellow_submit" id="add-to-gifts" data-toggle="modal" data-target="#myModal">'+ (data.price ? "UPDATE GIFT" : "ADD TO GIFTS") +'</button>'+
                        '            </div>'+
                        '        </div>'+
                        '        <div class="col-md-6">'+
                        '            <label for="fidt-amount">GIFT AMOUNT&nbsp;&nbsp;&nbsp;</label><a href ="" data-toggle="tooltip" data-placement="top" title="You will receive the cash equivalent of this gift amount when the gift is purchased from your gift page."><i class="fas fa-info-circle" style="color:black;"></i></a>'+
                        '            <div class="row input-group">'+
                        '                <span class="input-group-addon" style="padding-bottom:4px;">$</span>'+
                        '                <input class="form-control" id="gift-amount" type="text">'+
                        '            </div>'+
                        '        </div>'+
                        '      </div>'+
                        '      <div class="modal-footer" style="border-top: 0px solid #e5e5e5;">'+
                        '      </div>';
	                
	                 $('#myModal .modal-body').empty();
	                 $('#myModal .modal-body').append(myvar);
	                 if(data.price !== null) {
	                    $('#myModal .modal-body #gift-amount').val(data.price);
	                 }
	                 $('#lightSlider').lightSlider({
                      gallery:true,
                      controls:false,
                      enableDrag:false,
                      item:1
                        });
             }
        });	
	});	
	
	$('#myModal').on('click', '#add-to-gifts', function() {
	   
	    var id = $('#myModal').data('id');
	    var price = $('#gift-amount').val();
	     $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	    $.ajax({
					type: 'post',
					url: '/addPrice',
					data: {
					    id:id,
					    price:price
					},
				   success: function(data) { 
				       $('.new-'+id).text('$' + parseFloat(data.price,10).toFixed(2));
                    $('.gift_price[data-id="'+ id +'"]').each(function(i){
                        
                        $(this).children()[2].innerText = '$' + parseFloat(data.price,10).toFixed(2);
                        if($(this).children()[1]) {
                            $(this).children()[1].remove();
                        }
                    });
				   }
	    });
	});
		
	$('body').on('click','#gifts', function() {	
	    $('#gift_descrip').show();
	    $('#bus_descrip').hide();
	    
    	});
    	
    	$('body').on('click','#business',function() {	
    	    $('#gift_descrip').hide();
    	    $('#bus_descrip').show();
    	    
    	});
        
	
	$('#remove_photo').click(function(e) {
	    e.preventDefault();
	    var slug = $(this).data('slug');
	    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	    $.ajax({
					type: 'post',
					url: '/remove-image',
					data: {slug:slug},
				   success: function(data) { 
				    $("#prof_pic").attr("src", "/public/front/img/dpImage.png")
				   }
	    });
	});	
	
	
	
    
    $( '#gft_title, #gft_det, #inp_date, #inp_age, #inp_host ' ).on( 'focusout', function(e) {
        
				$.ajax({
					type: 'post',
					url: '/update-gift-page',
					data: {
						'_token': $('input[name=_token]').val(),
						'gft_title': $('#gft_title').val(),
						'gft_det': $('#gft_det').val(),
						'inp_date': $('#inp_date').val(),
						'inp_age': $('#inp_age').val(),
						'inp_host': $('#inp_host').val(),
						'slug': $('#slug').val()
					},
				   success: function(data) {
					} 
				}).done(function(data) {
				    
				});
		
			e.preventDefault();
		});
		
	$('.gift_box input,textarea , .gift_details input,textarea').hover(function(){
        var id = $(this).attr('id');
        $(this).css({'color' : '#000'});
        $('#' + id + '-req').css({'color' : '#FF0055'});
    }, function(){
        var id = $(this).attr('id');
        $('#' + id + '-req').css({'color' : '#000'});
    });
});

function copyURL() {
  /* Get the text field */
  var copyText = document.getElementById("inp_link");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  //alert("Copied the text: " + copyText.value);
}