<form id="accName" method="POST" onsubmit="event.preventDefault();">
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fname">First Name</label>
      <input type="text" class="form-control" id="first_name" name="first_name" value="@if($user->meta){{$user->meta->first_name}}@endif">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="lname">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="@if($user->meta){{$user->meta->last_name}}@endif">
  </div>
  </div>
  <div id="email-row" class="form-row">
  <div class="form-group col-md-6">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
  </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <input id="accName-submit" type="submit" class="purple-submit pointer" value="SAVE CHANGES">
      </div>
    </div>
</form>
