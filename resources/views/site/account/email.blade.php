<form id="accEmail" method="POST" onsubmit="event.preventDefault();">
    <h6 style="font-weight: bold;">Email Preferences</h6>
    
    <div class="row">
    <label for="gift_alerts">Gift Alerts</label>
    </div>
    
    
     
    <div class="pretty p-icon p-curve p-fill p-has-indeterminate">
        <input id="alerts" name="gift_alerts" type="checkbox" value="1" @isset($user->meta->gift_alert) @if($user->meta->gift_alert == 1) {{'checked'}} @endif @endisset/>
        <div class="state">
            <i class="icon mdi mdi-check"></i>
            <label>Gift confirmation and account updates. If you opt-out of these emails you will not know when a gift is purchased</label>
        </div>
        <div class="state p-is-indeterminate">
            <i class="icon mdi mdi-minus"></i>
            <label>Indeterminate</label>
        </div>
    </div>
    <br> <br>

<div class="row">
    <label for="gift_alerts">Fynches Updates</label>
    </div>
    

<div id="update-row" class="pretty p-icon p-curve p-has-indeterminate">
        <input id="updates" name="fynches_updates" type="checkbox" value="1"  @isset($user->meta->fynches_updates) @if($user->meta->fynches_updates == 1) {{'checked'}} @endif @endisset/>
        <div class="state">
            <i class="icon mdi mdi-check"></i>
            <label>Get new products updates and the latest news</label>
        </div>
        <div class="state p-is-indeterminate">
            <i class="icon mdi mdi-minus"></i>
            <label>Indeterminate</label>
        </div>
    </div>

<br>


<div class="row">
            <div class="col-md-6">
                <input id="accEmail-submit" type="submit" class="purple-submit pointer" value="SAVE CHANGES">
            </div>
        </div> 
</form>
