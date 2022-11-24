<!DOCTYPE html>
<html>

<head>
   <title>Login</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/bootstrap.css') }}">
   <script src="{{ asset('theme/assets/js/bootstrap.js') }}"></script>
</head>
 
<body style="background-color:#F5F5F5;">
   <div class="container"> 
      <div class="log_in">
         <form method="POST" action="{{ route('updatePassword') }}">
            @csrf

            @if(session('error'))
            <div class="alert alert-danger">
               {!! session('error') !!}
            </div>
            @endif
 
            <div class="text-center">
               <img src="{{ asset('theme/assets/images/logo-login.png') }}" alt="logo">
               <h2>Set Password</h2>
            </div>
            <input id="token" type="hidden" name="token" value={{ $token }}>
            <label>
               <input id="password" type="password" name="password" placeholder="Password">
               <div class="lock">   
               <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.9859 1.83331C13.799 1.83331 16.0624 4.04687 16.0624 6.77965V8.18521C17.6412 8.67802 18.7916 10.1073 18.7916 11.8143V16.3398C18.7916 18.4532 17.0395 20.1666 14.8795 20.1666H7.12132C4.96033 20.1666 3.20825 18.4532 3.20825 16.3398V11.8143C3.20825 10.1073 4.35954 8.67802 5.93743 8.18521V6.77965C5.94675 4.04687 8.21019 1.83331 10.9859 1.83331ZM10.9953 12.2689C10.5482 12.2689 10.1849 12.6242 10.1849 13.0614V15.0837C10.1849 15.53 10.5482 15.8853 10.9953 15.8853C11.4517 15.8853 11.8149 15.53 11.8149 15.0837V13.0614C11.8149 12.6242 11.4517 12.2689 10.9953 12.2689ZM11.0046 3.42744C9.11371 3.42744 7.5768 4.92136 7.56749 6.76143V7.98754H14.4323V6.77965C14.4323 4.93047 12.8954 3.42744 11.0046 3.42744Z" fill="#6B1687" />
               </svg>
               </div>
               <div class="unlock">
					<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.2085 4.57417C13.7117 3.61533 12.7455 2.75 11.0002 2.75C8.06683 2.75 7.3335 5.19475 7.3335 6.41667V9.16667" stroke="#6B1687" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 11C2.75 10.2707 3.03973 9.57118 3.55546 9.05546C4.07118 8.53973 4.77065 8.25 5.5 8.25H16.5C17.2293 8.25 17.9288 8.53973 18.4445 9.05546C18.9603 9.57118 19.25 10.2707 19.25 11V17.4167C19.25 18.146 18.9603 18.8455 18.4445 19.3612C17.9288 19.8769 17.2293 20.1667 16.5 20.1667H5.5C4.77065 20.1667 4.07118 19.8769 3.55546 19.3612C3.03973 18.8455 2.75 18.146 2.75 17.4167V11ZM11.9167 12.8333C11.9167 12.5902 11.8201 12.3571 11.6482 12.1852C11.4763 12.0132 11.2431 11.9167 11 11.9167C10.7569 11.9167 10.5237 12.0132 10.3518 12.1852C10.1799 12.3571 10.0833 12.5902 10.0833 12.8333V15.5833C10.0833 15.8264 10.1799 16.0596 10.3518 16.2315C10.5237 16.4034 10.7569 16.5 11 16.5C11.2431 16.5 11.4763 16.4034 11.6482 16.2315C11.8201 16.0596 11.9167 15.8264 11.9167 15.5833V12.8333Z" fill="#6B1687"/>
					</svg>
				</div>
               @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
            </label>
            <label>
               <input id="cpassword" type="password" name="cpassword" placeholder="Confirm Password">
               <div class="clock">   
               <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.9859 1.83331C13.799 1.83331 16.0624 4.04687 16.0624 6.77965V8.18521C17.6412 8.67802 18.7916 10.1073 18.7916 11.8143V16.3398C18.7916 18.4532 17.0395 20.1666 14.8795 20.1666H7.12132C4.96033 20.1666 3.20825 18.4532 3.20825 16.3398V11.8143C3.20825 10.1073 4.35954 8.67802 5.93743 8.18521V6.77965C5.94675 4.04687 8.21019 1.83331 10.9859 1.83331ZM10.9953 12.2689C10.5482 12.2689 10.1849 12.6242 10.1849 13.0614V15.0837C10.1849 15.53 10.5482 15.8853 10.9953 15.8853C11.4517 15.8853 11.8149 15.53 11.8149 15.0837V13.0614C11.8149 12.6242 11.4517 12.2689 10.9953 12.2689ZM11.0046 3.42744C9.11371 3.42744 7.5768 4.92136 7.56749 6.76143V7.98754H14.4323V6.77965C14.4323 4.93047 12.8954 3.42744 11.0046 3.42744Z" fill="#6B1687" />
               </svg>
               </div>
               <div class="cunlock">
					<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.2085 4.57417C13.7117 3.61533 12.7455 2.75 11.0002 2.75C8.06683 2.75 7.3335 5.19475 7.3335 6.41667V9.16667" stroke="#6B1687" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 11C2.75 10.2707 3.03973 9.57118 3.55546 9.05546C4.07118 8.53973 4.77065 8.25 5.5 8.25H16.5C17.2293 8.25 17.9288 8.53973 18.4445 9.05546C18.9603 9.57118 19.25 10.2707 19.25 11V17.4167C19.25 18.146 18.9603 18.8455 18.4445 19.3612C17.9288 19.8769 17.2293 20.1667 16.5 20.1667H5.5C4.77065 20.1667 4.07118 19.8769 3.55546 19.3612C3.03973 18.8455 2.75 18.146 2.75 17.4167V11ZM11.9167 12.8333C11.9167 12.5902 11.8201 12.3571 11.6482 12.1852C11.4763 12.0132 11.2431 11.9167 11 11.9167C10.7569 11.9167 10.5237 12.0132 10.3518 12.1852C10.1799 12.3571 10.0833 12.5902 10.0833 12.8333V15.5833C10.0833 15.8264 10.1799 16.0596 10.3518 16.2315C10.5237 16.4034 10.7569 16.5 11 16.5C11.2431 16.5 11.4763 16.4034 11.6482 16.2315C11.8201 16.0596 11.9167 15.8264 11.9167 15.5833V12.8333Z" fill="#6B1687"/>
					</svg>
				</div>
            </label>
            @if(session('cpassword'))
            <div class="alert alert-danger">
               {!! session('cpassword') !!}
            </div>
            @endif
            <div id="CheckPasswordMatch"></div>
            <button type="submit" id="submit" name="submit">Change</button>
         </form>
      </div>
   </div>
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
