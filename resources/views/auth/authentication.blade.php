<!DOCTYPE html>
<html>

<head>
   <title>Verification</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/bootstrap.css') }}">
   <script src="{{ asset('theme/assets/js/bootstrap.js') }}"></script>
</head>

<body style="background-color:#F5F5F5;">
   <div class="container">
      <div class="log_in">
         <form method="POST" action="{{ route('verification') }}">
            @csrf
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            </div>
            @endif
            <div class="text-center">
               <img src="{{ asset('theme/assets/images/logo-login.png') }}" alt="logo">
               <h2>Verification</h2>
            </div>

            <label>
               <input id="code" type="text" name="code" placeholder="code">

            </label>
            <button type="submit" name="submit">Verify</button>
         </form>
      </div>
   </div>
</body>

</html>