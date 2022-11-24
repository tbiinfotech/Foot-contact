@include('header')

         @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top">
                  <h1> Change Password </h1>
                  <a class="btn back_btn" href="{{ url('/dashboard') }}" role="button"> Back </a>
               </div>

               <div class="sp_rd add_coach">
               <form method="POST" action="{{ route('update-password') }}">
               <input id="token" type="hidden" name="token" value={{ $id }}>
                  <div class="row">
                        <div class="col-md-6">
                           <label>New Password </label>
                           <input type="password" name="password" id="password"  required>
                        </div>
                        @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                     </div> 
                     <div class="row">
                        <div class="col-md-6">
                           <label> Confirm Password </label>
                           <input type="password" name="cpassword" id="cpassword"  required>
                        </div>
                        @if(session('cpassword'))
            <div class="alert alert-danger">
               {!! session('cpassword') !!}
            </div>
            @endif
                     </div>
                     <div id="CheckPasswordMatch"></div>

                  
                     <div class="row">
                        <div class="col-md-12 text-end">

                           <button type="submit" id="submit" class="btn drk-btn"> Submit </button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
    function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#cpassword").val();
      
        if (password != confirmPassword){
         $("#submit").hide();
            $("#CheckPasswordMatch").html("Passwords does not match!");
        }
        else{
         $("#submit").show();
            $("#CheckPasswordMatch").html("Passwords match.");
        }
       
    }
    $(document).ready(function () {
        
        $("#submit").hide();
       $("#cpassword").keyup(checkPasswordMatch);
    });
   </script>
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
   $(".unlock").hide();
  $(".lock").click(function(){
   $(".unlock").show();
   $(".lock").hide();

   var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  });
});
$(".unlock").click(function(){
   $(".lock").show();
   $(".unlock").hide();
   var x = document.getElementById("password");
  if (x.type === "text") {
    x.type = "password";
  } else {
    x.type = "text";
  }
});

//
$(document).ready(function(){
   $(".cunlock").hide();
  $(".clock").click(function(){
   $(".cunlock").show();
   $(".clock").hide();

   var x = document.getElementById("cpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
  });
});
$(".cunlock").click(function(){
   $(".clock").show();
   $(".cunlock").hide();
   var x = document.getElementById("cpassword");
  if (x.type === "text") {
    x.type = "password";
  } else {
    x.type = "text";
  }
});
</script>
