<form id="accPriv" method="POST" onsubmit="event.preventDefault();">
    <h6 style="font-weight: bold;">Privacy Settings</h6>
    <div class="row">
    <label for="gift_alerts">Google Visibility</label>
    </div>
    
    <div class="row navUL">
    <label for="gift_alerts">Do you want your gift search to be visible and searchable on Google  <i class="fas fa-info-circle"><div class="bubblePosition hoverBubble"><h1>TEST</h1></div></i></label>
    </div>
    
   <div class="row">
 <div class="pretty p-icon p-curve p-smooth">
        <input id="google_search" type="radio" name="google" value="1" @isset($user->meta->google_visibility) @if($user->meta->google_visibility == 1) {{'checked'}} @endif @endisset>
        <div class="state">
            <i class="icon mdi mdi-check"></i>
            <label>Yes</label>
        </div>
    </div>

    </div>
    
    <div class="row">
 <div class="pretty p-icon p-curve p-smooth">
        <input type="radio" name="google" value-"0" @isset($user->meta->google_visibility) @if($user->meta->google_visibility == 0) {{'checked'}} @endif @endisset>
        <div class="state">
            <i class="icon mdi mdi-check"></i>
            <label>No</label>
        </div>
    </div>
    </div>
    <br>
    <div class="row">
    <label for="gift_alerts">Fynches Search Visibility</label>
    </div>
    
    <div class="row">
    <label for="gift_alerts">Do you want your gift search to be visible and searchable on Fynches  <i class="fas fa-info-circle"></i></label>
    </div>
    
   <div class="row">
 <div class="pretty p-icon p-curve p-smooth">
        <input id="fynches_search" type="radio" name="fynches" value="1" @isset($user->meta->fynches_search_visibility) @if($user->meta->fynches_search_visibility == 1) {{'checked'}} @endif @endisset/>
        <div class="state">
            <i class="icon mdi mdi-check"></i>
            <label>Yes &nbsp&nbsp&nbsp page is visible by default</label>
        </div>
    </div>

    </div>
    
    <div id="success-row" class="row">
 <div class="pretty p-icon p-curve p-smooth">
        <input type="radio" name="fynches" value="0" @isset($user->meta->fynches_search_visibility) @if($user->meta->fynches_search_visibility == 0) {{'checked'}} @endif @endisset/>
        <div class="state">
            <i class="icon mdi mdi-check"></i>
            <label>No</label>
        </div>
    </div>
    </div>
    
    

<div class="row">
            <div class="col-md-6" style="padding:0px">
                <input id="accPriv-submit" type="submit" class="purple-submit pointer" value="SAVE CHANGES">
            </div>
        </div>  
</form>
