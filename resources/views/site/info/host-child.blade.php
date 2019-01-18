
    <div class="container">
     
        <div class="form-row" id ="rw">
                
            <div class="form-group col-md-5">
                <h5 style="font-family: 'Poppins',sans-serif;font-weight:700; font-size:16px;line-height:25px;letter-spacing:1px;color:#34344A;">Host Info</h5>
                      <label for="fname" class="required">FIRST AND LAST NAME</label>
                      <input required type="text" maxlength="20" class="form-control" id="host_name" name="host_name" value="" style="width: 100%;">
            </div>
            <div class="form-group col-md-2">
            </div>
            <div class="form-group col-md-5">
                <h5 class="tt-header" style="font-family: 'Poppins',sans-serif;font-size:16px;line-height:25px;letter-spacing:1px;font-weight:700;color:#34344A;">Child Info</h5>  <div  href="#" data-toggle="tooltip" title="First name of the child for gift page" style="color:black;margin-top: 11px;cursor: pointer;">&nbsp&nbsp<i class="fas fa-info-circle"></i></div>
                
                        <label for="cfname" class="required" style="width: 100%;margin-top: 7px;">FIRST NAME</label>
                        <input type="text" maxlength="20" class="form-control" id="child_fname" name="child_fname" value="" style="width: 100%;" required>
                     
                      <div class="form-row">
                        <label for="age" class="required">DOB</label>
                      <input required id="dod" placeholder="Please Select Date" class="date-input form-control" name="dob" value="" type="date" data-date-inline-picker="false" class="form-control" data-date-open-on-focus="true" style="width: 100%;"/>
                      </div>
            </div>
            
        </div>
    </div>

@include('site.gift.gift_crop')