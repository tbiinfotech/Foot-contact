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
         <form method="POST" action="{{ route('login') }}">
            @csrf

            @if(session('error'))
            <div class="alert alert-danger">
               {!! session('error') !!}  
            </div>
            @endif
            <div class="text-center">
               <img src="{{ asset('theme/assets/images/logo-login.png') }}" alt="logo">
               <h2>Login</h2>
            </div>
            <label>
               <input id="email" type="text" name="email" placeholder="Email Address">
               <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.0001 13.9094C14.9772 13.9094 18.3334 14.5557 18.3334 17.049C18.3334 19.5433 14.9551 20.1666 11.0001 20.1666C7.02392 20.1666 3.66675 19.5204 3.66675 17.027C3.66675 14.5328 7.04501 13.9094 11.0001 13.9094ZM11.0001 1.83331C13.6943 1.83331 15.8529 3.99117 15.8529 6.68344C15.8529 9.37572 13.6943 11.5345 11.0001 11.5345C8.30682 11.5345 6.14726 9.37572 6.14726 6.68344C6.14726 3.99117 8.30682 1.83331 11.0001 1.83331Z" fill="#6B1687" />
               </svg>
            </label>
           

            <label>
				<input id="password" type="password" name="password" placeholder="Password">
				<div class="lock">   
					<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 11C2.75 10.2707 3.03973 9.57118 3.55546 9.05546C4.07118 8.53973 4.77065 8.25 5.5 8.25H16.5C17.2293 8.25 17.9288 8.53973 18.4445 9.05546C18.9603 9.57118 19.25 10.2707 19.25 11V17.4167C19.25 18.146 18.9603 18.8455 18.4445 19.3612C17.9288 19.8769 17.2293 20.1667 16.5 20.1667H5.5C4.77065 20.1667 4.07118 19.8769 3.55546 19.3612C3.03973 18.8455 2.75 18.146 2.75 17.4167V11ZM11.9167 12.8333C11.9167 12.5902 11.8201 12.3571 11.6482 12.1852C11.4763 12.0132 11.2431 11.9167 11 11.9167C10.7569 11.9167 10.5237 12.0132 10.3518 12.1852C10.1799 12.3571 10.0833 12.5902 10.0833 12.8333V15.5833C10.0833 15.8264 10.1799 16.0596 10.3518 16.2315C10.5237 16.4034 10.7569 16.5 11 16.5C11.2431 16.5 11.4763 16.4034 11.6482 16.2315C11.8201 16.0596 11.9167 15.8264 11.9167 15.5833V12.8333Z" fill="#6B1687"/>
						<path d="M7.3335 9.16667V6.41667C7.3335 5.44421 7.7198 4.51157 8.40744 3.82394C9.09507 3.13631 10.0277 2.75 11.0002 2.75V2.75C11.9726 2.75 12.9053 3.13631 13.5929 3.82394C14.2805 4.51157 14.6668 5.44421 14.6668 6.41667V9.16667" stroke="#6B1687" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
               <span class="text-danger">@isset($errors){{ $errors->first('email')}}@endisset</span>
				</div>
				<div class="unlock">
					<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.2085 4.57417C13.7117 3.61533 12.7455 2.75 11.0002 2.75C8.06683 2.75 7.3335 5.19475 7.3335 6.41667V9.16667" stroke="#6B1687" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 11C2.75 10.2707 3.03973 9.57118 3.55546 9.05546C4.07118 8.53973 4.77065 8.25 5.5 8.25H16.5C17.2293 8.25 17.9288 8.53973 18.4445 9.05546C18.9603 9.57118 19.25 10.2707 19.25 11V17.4167C19.25 18.146 18.9603 18.8455 18.4445 19.3612C17.9288 19.8769 17.2293 20.1667 16.5 20.1667H5.5C4.77065 20.1667 4.07118 19.8769 3.55546 19.3612C3.03973 18.8455 2.75 18.146 2.75 17.4167V11ZM11.9167 12.8333C11.9167 12.5902 11.8201 12.3571 11.6482 12.1852C11.4763 12.0132 11.2431 11.9167 11 11.9167C10.7569 11.9167 10.5237 12.0132 10.3518 12.1852C10.1799 12.3571 10.0833 12.5902 10.0833 12.8333V15.5833C10.0833 15.8264 10.1799 16.0596 10.3518 16.2315C10.5237 16.4034 10.7569 16.5 11 16.5C11.2431 16.5 11.4763 16.4034 11.6482 16.2315C11.8201 16.0596 11.9167 15.8264 11.9167 15.5833V12.8333Z" fill="#6B1687"/>
					</svg>
				</div>
          
            </label>
            <label>
            <a href="{{ url('/reset-email') }}">Forgot password? </a>   
            </label>
            <button type="submit" name="submit">Login</button>
         </form>
      </div>
   </div>
</body>

</html>
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
</script>
