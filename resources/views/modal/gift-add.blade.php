<div class="modal" id="gift_Add" tabindex="-1" role="dialog">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content" style="padding:0px !important">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="$('#gift_Add').hide();" style="margin:10px !important">
                    <span aria-hidden="true">&times;</span>
                </button>

                <h5>ADD A CUSTOM EXPERIENCE</h5>
                <div class="row" id="add_form">
                    <div class="col-md-6">
                        <a href="#" id="custom-gift-image" data-toggle="modal" data-target="#gift_crop"><img id="gift_image" src="/front/img/upload.png" style="width:100%"></a>
                    </div>
                    <div class="col-md-6">
                        <label class="required">Enter URL of Experience</label>
                        <input required type="text" class="form-control" id="gift_url"name="url" style="width:100%" placeholder="https://www.example-url.com/">

                        <div class="row">
                            <label class="col-md-6 required text-left">Gift Title</label>
                            <p id="gift_title_count" class="col-md-6 text-right" style="letter-spacing:0.62px;font-size: 8px;margin-top: 5px;line-height: 11px;font-family: 'Avenir-Book';">39 of 39 Characters Remaining</p>
                        </div>
                        <input required type="text" class="form-control" id="gift_title" name="title" maxlength="39" style="width:100%">

                        <div class="row">
                            <label class="col-md-6 required text-left">Gift Description</label>
                            <p id="gift_desc_count" class="col-md-6 text-right" style="letter-spacing:0.62px;font-size: 8px;margin-top: 5px;line-height: 11px;font-family: 'Avenir-Book';">60 of 60 Characters Remaining</p>
                        </div>
                        <textarea required name="message" class="form-control" id="gift_desc" style="resize:none;" maxlength="60" rows="6"></textarea>

                        <div class="row" id="gift_amount">
                            <div class="col-md-6">
                                <button class="btn btn-primary yellow_submit" id="gift_submit" data-toggle="modal" data-target="#gift_Add">ADD TO GIFTS</button>
                            </div>
                            <div class="col-md-6">
                                <p class="required" style="font-family:'Avenir-Medium';line-height:11px;font-size:8px;letter-spacing:1px;color:#34344A;margin:0 10px">GIFT AMOUNT <i class="fas fa-info-circle"></i></p>
                                <div class="input-group prefix">
                                    <span class="input-group-addon prefix dollar">$</span>
                                    <input required type="number" class="form-control" id="gift_price" name="price" style="border-radius:5px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 0px solid #e5e5e5;">
                </div>
            </div>
        </div>
    </div>
</div>