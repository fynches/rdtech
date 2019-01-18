jQuery(document).ready(function( $ ) {
       
   $('#page-search').keyup(function() {
       
       if($('#loading').length === 0)
            $('.loading').append('<img id="loading" src="http://fynches.codeandsilver.com/public/images/gifs/loading.jpg">');
       
       var lastName = $(this).val();
      
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        $.ajax({
            type:'POST',
            url:'/search/pages',
            data:{lastName:lastName},
            success:function(data){
                $('#loading').remove();
                if(data.giftPages === null || lastName === '') {
                  $('.search_row').empty();
                  $('#search-count').text('We Found 0 Gift Pages');
                }
                else if($('#search_result').attr('name') == lastName) {}
                else {
                    $('#search-count').text('We Found '+ data.giftPages.length +' Gift Page' + (data.giftPages.length > 1 ? "s" : ""));
                    for(var i in data.giftPages) {
                    
                        var page = '<div class="col-md-12 search-row" id="search_result" name="'+ lastName +'">'+
                        '                    <div class="col-md-2">'+
                        '                        <img src="'+ data.childInfo[i].recipient_image +'" >'+
                        '                    </div>'+
                        '                    <div class="col-md-8 search-block">'+
                        '                        <p><bold>Page Title:</bold> '+ data.giftPages[i].page_title +'</p>'+
                        '                        <p><bold>Host:</bold> '+ data.giftPages[i].page_hostname +'</p>'+
                        '                        <p><bold>Child:</bold> '+ data.childInfo[i].first_name +'</p>'+
                        '                    </div>'+
                        '                    <div class="col-md-2 search-block">'+
                        '                        <a href="/gift-page/'+ data.giftPages[i].slug +'"><button class="btn btn-border btn-purp">VIEW GIFT PAGE</button></a>'+
                        '                    </div>'+
                        '                </div>';
            	
            
                        
                        $('.search_row').append(page);
                    }
                }
            },
            error:  function (error) {
              
            }
        });
   });
   
       var path = window.location.href.split('?');
       if(path.length > 1) {
           $('#page-search').val(path[1].split('=')[1]);
           $('#page-search').keyup();
       }
});