$(document).ready(function( $ ) {
   
   $('body').on('click','.favorite-button',function () {
    
       var favorite = $(this).parent().parent().parent().attr('id');
       var slug = window.location.pathname.split('/')[2];
       //console.log(favorite);
       
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            
            $.ajax({
                type:'POST',
                url:'/favorite',
                data:{
                    id:favorite,
                    slug:slug
                },
                success:function(data){
                    var added = '';
                    
                    if(data.added == 1) {
                                       added +=  
                    '                                    <div class="row" id="marg">'+
                    '                                        <div class="col-md-6 col-xs-6">'+
                    '                                            <button class="btn btn-lg add_submit" name="remove" id="add" data-id="'+ favorite +'">ADDED</button>'+
                    '                                        </div>'+
                    '                                        <div class="col-md-6 col-xs-6 text-right">'+
                    '                                           <div class="col-md-6 col-xs-6"> <p class="text-center" style="font-weight:bold;font-size:16px;">$'+ data.gift.price +'</p><p class="text-center">GIFTED</p></div>'+
                    '                                           <div class="col-md-6 col-xs-6"><p class="text-center" style="font-weight:bold;font-size:16px;">$45</p><p class="text-center">NEEDED</p></div>'+
                    '                                        </div>'+
                    '                                    </div>  ';
                                    } else {

                                    added +=     '<div class="row">'+
'                                        <div class="col-md-6 col-xs-6">'+
'                                            <button class="btn btn-primary btn-lg btn_purp" data-toggle="modal" data-target="#myModal">GIFT DETAILS</button>'+
'                                        </div>'+
'                                        <div class="col-md-6 col-xs-6" id="gift_para">'+
'                                            <p><i class="fas fa-map-marker-alt"></i>  1.1 MIL</p>'+
'                                        </div>'+
'                                    </div>   '+
'                                    '+
'                                    <div class="row">'+
'                                        <div class="col-md-6 col-xs-6">'+
'                                            <button class="btn btn-primary btn-lg yellow_submit" name="add">QUICK ADD</button>'+
'                                        </div>'+
'                                        <div class="col-md-6 col-xs-6 text-right" id="gift_price">'+
'                                            <p style="font-weight:bold;font-size:18px;">$'+ (data.gift.price !== null ? data.gift.price : data.gift.est_price) +'</p>'+
                                        (data.gift.price === null ? '<p>Est. Price <i class="fas fa-info-circle"></i></p>' : '')+
'                                        </div>'+
'                                    </div> ';
                            }
                    
                    if(data.is == 1) {
                        $('#favorites #'+ favorite).remove();
                        $('.heart-'+ favorite).css('color', '#fff');
                        return;
                    } else {
                        $('.heart-'+ favorite).css('color', 'red');
                    var gift =  '<div class="col-md-3 reco_col pointer" id="'+ favorite +'">'+
'                            <div style="position: relative; background: url('+ data.image +'); width:100%; height:250px; background-size:100% 100%; ">'+
'                                <div style="position: absolute; top: 1em; left: 1em; font-weight: bold; color: #fff;">'+
'                                    <a href="javascript:void(0)" class="favorite-button" data-pnum="'+ favorite +'"><i class="fas fa-heart fa-2x" style="color:red;"></i></a>'+
'                                </div>'+
'                            </div>'+
'                            <div class="shad-effect">'+
'                                <label>'+ data.gift.title +'</label>'+
'                                <p>'+ data.business +'</p>'+ added +
'                                </div>    '+
'                        </div>';

                    $('#favorites').append(gift);
                    
                    }
                    console.log(data.added);
                    
                    
                },
                error:  function (error) {
                   // alert('not added');
                }
        });
               
   });
   

   $( "#favorites" ).on( "click", 'a', function() {  
       
       var slug = window.location.pathname.split('/')[2];
        
       var favorited = $(this).attr('data-pnum');
       
      $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            
            $.ajax({
                type:'POST',
                url:'/favorited',
                data:{
                    id:favorited,
                    slug:slug
                },
                success:function(data){
                        $('.heart-'+ favorited).css('color', '#fff');    
                        $('#favorites #' + favorited).remove();
                },
                error:  function (error) {
                   // alert('not added');
                }
        });
               
   });
  
   
});