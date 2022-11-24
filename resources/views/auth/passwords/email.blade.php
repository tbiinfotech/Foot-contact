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
         <form method="POST" action="{{ route('sendLink') }}">
            @csrf

            @if(session('error'))
            <div class="alert alert-danger">
               {!! session('error') !!}
            </div>
            @endif
            <div class="text-center">
               <img src="{{ asset('theme/assets/images/logo-login.png') }}" alt="logo">
               <h2>Enter Email</h2>
            </div>
            <label>
               <input id="email" type="text" name="email" placeholder="Email Address">
               <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.0001 13.9094C14.9772 13.9094 18.3334 14.5557 18.3334 17.049C18.3334 19.5433 14.9551 20.1666 11.0001 20.1666C7.02392 20.1666 3.66675 19.5204 3.66675 17.027C3.66675 14.5328 7.04501 13.9094 11.0001 13.9094ZM11.0001 1.83331C13.6943 1.83331 15.8529 3.99117 15.8529 6.68344C15.8529 9.37572 13.6943 11.5345 11.0001 11.5345C8.30682 11.5345 6.14726 9.37572 6.14726 6.68344C6.14726 3.99117 8.30682 1.83331 11.0001 1.83331Z" fill="#6B1687" />
               </svg>
            </label>
            @if (\Session::has('success'))
    <div class="alert alert-success">
       <p>{{ \Session::get('success') }}</p>
    </div> 
@endif
@if (\Session::has('failure'))
    <div class="alert alert-danger">
       <p>{{ \Session::get('failure') }}</p>
    </div>
@endif
            </label>
            <button type="submit" name="submit">Send Link</button>
         </form>
      </div>
   </div>
</body>

</html>

<script>
   if(!!window.performance && window.performance.navigation.type === 2){
       console.log('Reloading');
    window.location.reload();
}</script>