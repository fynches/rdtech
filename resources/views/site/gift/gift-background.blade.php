<div class="modal" id="gift_background" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content" style="padding:0px !important">
      <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#gift_background').hide();" style="margin:10px !important">
          <span aria-hidden="true">&times;</span>
        </button>
         <h5 class="text-center">CHOOSE BACKGROUND IMAGE FROM OUR LIBRARY</h5>
        
         <div class="row" id="background">
             @foreach($background_images as $images)
             <div class="col-md-4">
                 <img class="background-image" src="{{$images->image_url}}" style="width:100%;height: 150px;" data-image-id="{{$images->id}}">
             </div>
             @endforeach
             
         </div>
         
      <div class="modal-footer" style="border-top: 0px solid #e5e5e5;">
      </div>
    </div>
  </div>
</div>
</div>
