<!DOCTYPE html>
<html>
   <head>
      <title>Send OTP</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/bootstrap.css') }}">
      <script src="{{ asset('theme/assets/js/bootstrap.js') }}"></script>
   </head> 
   <body style="background-color:#F5F5F5;">
      <div class="container"> 
         <div class="log_in">
         <form method="GET" action="{{ route('sendotp') }}">
               <div class="text-center">
                  <img src="{{ asset('theme/assets/images/logo-login.png') }}" alt="logo">    
                  <h2>Send OTP</h2>
               </div>
               <label>
                  <input id="phone" type="text"  name="phone"  placeholder="phone" required>
               </label>
               <button type="submit" name="submit">Send OTP</button>
            </form>
         </div> 
      </div>
   </body>
</html> 