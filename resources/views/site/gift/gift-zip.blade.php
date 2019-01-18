<div class="modal" id="giftZip" tabindex="-1" role="dialog">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#giftZip').hide();">
          <span aria-hidden="true">&times;</span>
        </button>
         <h5 class="text-center">Zip Code</h5>
         <div class="gift-zipcode">
         <p>Your current recommendations are based on zip code <span id="base-zip">{{$gift_page->child->child_zipcode}}</span></p>
         
         <div class="row" id="gift-zipcode">
             
             <label>ZIP CODE</label>
             <input id="child-zipcode" type="number" class="form-control" placeholder="Enter Zip Code">
             <button id="update-child-zipcode" class="btn btn-border yellow-submit">UPDATE ZIP CODE </button>
         </div>
         </div>
      <div class="modal-footer" style="border-top: 0px solid #e5e5e5;">
      </div>
    </div>
  </div>
</div>
</div>
