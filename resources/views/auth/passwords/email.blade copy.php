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
      <div class="log_in">
                    <form method="POST" action="#">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
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