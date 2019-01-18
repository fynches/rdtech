<!-- SignUp Model -->
<div class="modal fade common-model" id="largeModalSI" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div id="signup-header" class="modal-header text-center">
        <a href="http://fynches.codeandsilver.com"><img src="http://fynches.codeandsilver.com/public/front/img/logo.png" alt="logo" title=""></a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fas fa-times"></i></span>
        </button>
        
      </div>
      <h4 class="text-center" id="sign_in">Sign In</h4>
      <div class="modal-body-signup">
        <div class="row">
        	<div class="col-sm-12 col-md-12">
        	    <form id="signinForm" id="signinForm" class="form-horizontal" method="POST" onsubmit="event.preventDefault();">
             {{ csrf_field() }}
        			<div class="form-group">
        			    <label for="email" class="required">E-MAIL</label>
        				<input required type="email" id="signin-email" name="login_email" class="form-control required">
					</div>
					<div class="form-group">
					    <label for="password" class="required">PASSWORD</label>
        				<input required type="password" id="signin-password" name="login_password" class="form-control required" minlength=8>
        				<p class="text-right"><a href="#" data-toggle="modal" id="forgot_pass" data-target="#forgot_password" style="color:#FF0055 !important">Forgot Password?</a></p>
					</div>
					<button type="submit" class="btn common pink-btn">SIGN UP WITH EMAIL</button>
					<a href="{{ url('/auth/facebook') }}" class="btn btn-facebook">SIGN UP WITH FACEBOOK</a>
        		</form>
        		 
        		<div class="terms-conditions">
            	    <div>By creating your Fuynches account you agree to our <a href="/terms-condition" style="color:#00B4c1">Terms of Use</a> and <a href="/privacy-policy" style="color:#00B4c1">Privacy Policy</a></div>
            	    <div>Dont have have an account? <a href="#" id="sig_in" data-toggle="modal" data-target="#largeModalS" style="color:#00B4c1">Sign Up</a></div>
        	    </div>
						 <div id="signupSuccessMessage"></div>
						 <div id="signupErrorMessage"></div> 
        	</div>					
        </div>
      </div>
    </div>
  </div>
</div>

