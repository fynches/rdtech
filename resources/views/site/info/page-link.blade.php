<div class="container">
    <div class="row" id="rw1">
        <div class="col-md-12">
            <h5 style="margin-bottom:20px;">What Would You Like The Link to Your Gift Page To Be?</h5>
            <div class="guest">This link is how your guests will find your gift page. Make it simple and easy to remember.</div>
        </div>
        <div class="col-md-12">
            <div class="row" id="lk">
                <div class="col-md-4 col-xs-6 text-right">
                    <p id="gp">https://www.fynches.com/gift-page/</p>
                </div>
                <div class="col-md-7 col-xs-8 text-left no-padding" >
                    <input required id="slug" name="slug" type="text" placeholder="" style="width: 100%;border-radius: 0 5px 5px 0;" value="{{ old('slug') }}" pattern="[A-Za-z0-9]*">
                    <p style="margin-top:5px;">Please use only letters or numbers only</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <input id="page-link" type="submit" class="yellow-submit pointer" value="FINISH">
        </div>
    </div>
</div>