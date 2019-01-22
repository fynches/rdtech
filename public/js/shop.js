jQuery(document).ready(function( $ ) {
    
    $('#shop-items').on('click', 'button[name="add"]', function() {
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
				       console.log(data.gift);
	
                        $('#' + id +' button[name="add"]').html("REMOVED");
                        $('#' + id +' button[name="add"]').attr('name','remove');
                        $('.btns-'+id).html(
                        '<div class="row adddiff" id="marg">'+
                            '<div class="col-md-6 col-xs-6">'+
                                '<button class="btn btn-lg add_submit" name="remove" id="add" data-id="'+ id +'">REMOVE</button>'+
                            '</div>'+
                            '<div class="col-md-6 col-xs-6 text-right" id="gift_price">'+
                                '<p style="font-size: 16px;font-family:Avenir-Black;line-height: 16px;">$'+(data.gift.price ? data.gift.price : data.gift.est_price)+'</p>'+
                                '<p>Est. Price <i class="fas fa-info-circle"></i></p>'+
                            '</div>'+
                        '</div>');
				} 
			});
    });
    
    $('#shop-items').on('click', 'button[name="remove"]', function() {
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
				          $('.btns-'+id).html(
				             ' <div class="row">'+
                                        '<div id="img_1" class="col-md-6 col-xs-6">'+
                                            '<button class="btn btn-primary btn-lg btn_purp gift-dets" data-id="'+ id +'" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>'+
                                        '</div>'+
                                    '</div>'+
                                    
                                    '<div class="row">'+
                                        '<div class="col-md-6 col-xs-6">'+
                                            '<button class="btn btn-primary btn-lg yellow_submit" name="add" data-id="'+id+'">ADD GIFT</button>'+
                                        '</div>'+
                                        '<div class="col-md-6 col-xs-6 text-right" id="gift_price">'+
                                            '<p style="font-size: 16px;font-family:Avenir-Black;line-height: 16px;">$'+(data.gift.price ? parseFloat(data.gift.price,10) : parseFloat(data.gift.est_price,10))+'</p>'+
                                            '<p>Est. Price <i class="fas fa-info-circle"></i></p>'+
                                       '</div>'+
                                    '</div>'
				              );
				       }
				       
				        
				} 
			});
    });
    
    $('.checkbox').click(function(){
        
        var checkedid = $(this).attr('id');
        
        var categories = [];
        var ages = []; 
        
        
        $('.checkbox[data-id="category"]:checked').each(function(){ categories.push(this.id); });
        $('.checkbox[data-id="age"]:checked').each(function(){ ages.push(this.id); });
        
        
        
         if(checkedid == 'all') {
            $(".checkbox.cat").prop('checked',this.checked);
            $(".checkbox[data-id='age']").prop('checked',this.checked);
            $('#shop-items').children().show();
        }
        
        
        
        else if((categories === undefined || categories.length === 0) && (ages === undefined || ages.length === 0)) {
            $('#shop-items').children().show();
        }
        
        else {
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
    			type: 'post',
    			url: '/category',
    			data: {
    			    categories:categories,
    			    ages:ages
    			},
    		   success: function(data) {
                       $('#shop-items').children().hide();
                       
                       for(var i in data.gift_id) {
                        $('#shop-items #' + data.gift_id[i]).show();
                       }
    	            }
            });
        }
    });
    
    $("#shop_drop li a").click(function() {
        var sort = $(this).data('id');
         
        $('#shop-items .reco_col').sort(function(a,b){
            var aa;
            var bb;
            if(sort === 1) {
                aa = $(a).data('featured');
                bb = $(b).data('featured');
                if(aa === bb) {
                    return 0;
                }
                return aa < bb ? 1 : -1;
            }
            else if(sort === 2) {
                aa = parseFloat($(a).data('price'),10);
                bb = parseFloat($(b).data('price'),10);
                if(aa === bb) {
                    return 0;
                }
                return aa > bb ? 1 : -1;
            }
            else {
                aa = parseFloat($(a).data('price'),10);
                bb = parseFloat($(b).data('price'),10);
                if(aa === bb) {
                    return 0;
                }
                return aa < bb ? 1 : -1;
            }
        }).appendTo('#shop-items');
    });
    
    
    $('#shop-items').on('click','.favorite-button',function () {
    
       var favorite = $(this).parent().parent().parent().attr('id');
       var slug = window.location.pathname.split('/')[2];
       var button = $(this);
       
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            
            $.ajax({
                type:'POST',
                url:'/favorite',
                data:{
                    id:favorite,
                    slug:slug
                },
                success:function(data){
                    if(data.is == '0') {
                        button.css('color', 'red');
                    }
                    else if(data.is == '1') {
                        button.css('color', 'white');
                    }
                },
                error:  function (error) {
                   // alert('not added');
                }
        });
               
   });
   $('#shop-items').on('click', '.gift-dets', function() {	
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
	
	$('#gift_Add').on('change', '#image-input', function() {
	     var input = $(this).val();
	     readFile(input);
	});
	
	function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	           var file = reader.readAsDataURL(input.files[0]);
	           console.log(file);
	        }
		}
	
	$('#gift_Add').on('keyup','#gift_url',function() {
	    
	    var url = $(this).val();
	    
	    if(url.length !== 0) {
    	    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
    					type: 'post',
    					url: '/customDetails',
    					data: {url:url},
    				   success: function(data) { 
    				       console.log(data);
    				       $('#gift_title').val(data.title);
    				       $('#gift_Add #gift_desc').val(data.description);
    				       if(data.image !== null) {
    				            $('#gift_Add #gift_image').attr('src',data.image);
    				            $('#gift_Add #image-input').hide();
    				       }
    				       else {
    				           $('#gift_Add #gift_image').attr('src','https://fynches.codeandsilver.com/public/front/img/upload.png');
    				           $('#gift_Add #image-input').show();
    				       }
    				   }
            });
	    }
	    else {
	        $('#gift_Add #gift_title').val('');
    		$('#gift_Add #gift_desc').val('');
    		$('#gift_Add #image-input').show();
    		$('#gift_Add #gift_image').attr('src','https://fynches.codeandsilver.com/public/front/img/upload.png');
	    }
	   $('#gift_Add input[name="image"]').val($('#gift_Add #gift_image').attr('src'));
	});
	
	$('#gift_Add').on('keyup','#gift_title,#gift_desc',function() {
	    var id = $(this).attr('id');
	    var length = $(this).val().length;
	    var maxlength = $(this).attr('maxlength');
	    $('#' + id + '_count').text((maxlength - length) + ' of ' + maxlength + ' Characters Remaining');
	});
	
	$('#gift_Add').on('click', '#gift_submit', function() {
	    var slug = window.location.pathname.split('/')[2];
	    var url = $('#gift_Add #gift_url').val();
	    var title = $('#gift_Add #gift_title').val();
	    var description = $('#gift_Add #gift_desc').val();
	    var gift_amount = $('#gift_Add #gift_price').val();
	    var image = $('#gift_Add #gift_image').attr('src');
	    
	    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
				type: 'post',
				url: '/addCustomGift',
				data: {
				    slug:slug,
				    url:url,
				    title:title,
				    description:description,
				    gift_amount:gift_amount,
				    image:image
				},
			    success: function(data) {
			        if($('#gift_Add').data('id')) {
			            $('.reco_col').each(function(i){
			                if($(this).attr('id') == $('#gift_Add').data('id')) {
			                    $(this).children().first().css('background-image','url('+ $('#gift_image').attr('src') + ')');
			                    var id = $('#gift_Add').data('id');
			                    $('.new-'+id).text(gift_amount);
			                    $('.l-'+id).text(title);
			                    $('.d-'+id).text(description);
			                }
			            });
			        }
			        else {
    			        $('.added_gifts').append('<div class="col-md-3 reco_col pointer" id="'+ data.gift.id +'">'+
                                '<div style="position: relative; background: url('+ image +'); height:250px;background-size:100% 100%; ">'+
                                    '<div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">'+
                                        '<a href="javascript:void(0)" class="favorite-button" style="color:#fff;"><i class="fas fa-heart fa-2x"></i></a>'+
                                    '</div>'+
                                '</div>'+
                            '<div class="shad-effect">'+
                                '<label>'+ title +'</label>'+
                                '<p>'+ description +'</p>'+
                                    '<div class="btns-120">'+
                                                                    '<div class="btns-120">'+
                                        '<div class="row" id="marg">'+
                                            '<div class="col-md-6 col-xs-6">'+
                                                '<button class="btn btn-primary btn-lg btn_purp gift-dets" id="giftdets-120" data-id="120" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>'+
                                            '</div>'+
                                            '<div class="col-md-6 col-xs-6" id="gift_para">'+
                                            '</div>'+
                                            '<div class="col-md-6 col-xs-6">'+
                                                '<button class="btn btn-lg add_submit" name="remove" data-id="'+ data.gift.id +'">REMOVE</button>'+
                                            '</div>'+
                                            '<div class="col-md-6 col-xs-6 text-right" id="gift_price">'+
                                                '<div class="col-md-6 col-xs-6">'+
                                                '<p class="text-center" style="font-family:Poppins,sans-serif;font-weight:700;font-size:16px;">$0</p>'+
                                                '<p class="text-center" style="font-weight:100;font-size:12px;font-family:\'Avenir-Book\'">GIFTED</p>'+
                                                '</div>'+
                                                '<div class="col-md-6 col-xs-6">'+
                                                '<p class="text-center new-'+ data.gift.id +'" style="font-family:Poppins,sans-serif;font-weight:700;font-size:16px;">$'+parseFloat(gift_amount,10).toFixed(2)+'</p>'+
                                                '<p class="text-center" style="font-weight:100;font-size:12px;font-family:\'Avenir-Book\'">NEEDED</p>'+
                                                '</div>'+
                                        '</div>'+  
                                    '</div>'+
                                    '</div>'+
                                '</div>'+   
                            '</div>');
                            console.log($('.added_gifts').children());
			        }
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
				       $('#new-'+id).text('$' + parseFloat(data.price,10).toFixed(2));
                    $('.gift_price[data-id="'+ id +'"]').each(function(i){
                        
                        $(this).children()[2].innerText = '$' + parseFloat(data.price,10).toFixed(2);
                        if($(this).children()[1]) {
                            $(this).children()[1].remove();
                        }
                    });
				   }
	    });
	});
	
	 // var category = window.location.pathname.split('/')[3];
	 // var age = $('#child-ages').val();
    // console.log(category);
    // console.log(age);
    
    // if(category) {
    //     $('#'+category).click();
    // }
    
    // if(category == 'all-gifts') {
    //     $('#all').click();
    //     return;
    // }
    
    
    // if(age) {
    //     if(age >= 13) {age = 5};
    //     if(age <= 13 && age >= 8) {ager = 4};
    //     if(age <= 8 && age >= 5) {ager = 3};
    //     if(age <= 5 && age >= 2) {ager = 2};
    //     if(age <= 2 && age >= 0) {ager = 1};
    //     $('input[data-id="age"]').each(function(){
    //         if($(this).attr('id') == ager) {
    //             $(this).click();
    //         }
    //     });
    // }
});