<div class="container">
    <div class="form-row" id ="rw">
        <div class="form-group col-md-5">
            <h5 style="font-family: 'Poppins',sans-serif;font-weight:700; font-size:16px;line-height:25px;letter-spacing:1px;color:#34344A;">Host Info</h5>
            <label for="hostFirstName" class="required">FIRST NAME</label>
            <input required type="text" class="form-control" name="hostFirstName" value="{{ old('hostFirstName') }}" style="width: 100%;" />
            <div class = 'form-row'>
                <label for="hostLastName" class="required">LAST NAME</label>
                <input required type="text" class="form-control" name="hostLastName" value="{{ old('hostLastName') }}" style="width: 100%;" />
            </div>
        </div>
        <div class="form-group col-md-5 col-md-offset-2">
            <h5 class="tt-header" style="font-family: 'Poppins',sans-serif;font-size:16px;line-height:25px;letter-spacing:1px;font-weight:700;color:#34344A;">Child Info</h5>
            <div  href="#" data-toggle="tooltip" title="First name of the child for gift page" style="color:black;margin-top: 11px;cursor: pointer;">&nbsp&nbsp<i class="fas fa-info-circle"></i></div>
            <label for="childName" class="required" style="width: 100%;margin-top: 7px;">CHILD NAME</label>
            <input type="text" class="form-control" name="childName" value="{{ old('childName') }}" style="width: 100%;" required />
            <div class="form-row">
                <label for="dob" class="required">DOB</label>
                <input required id="dob" placeholder="Please Select Date" class="date-input form-control" name="dob" value="{{ old('dob') }}" type="date" data-date-inline-picker="false" data-date-open-on-focus="true" style="width: 100%;"/>
            </div>
        </div>
    </div>
</div>
@include('site.gift.gift_crop')