<!DOCTYPE html>
<html>

<head>
   <title>Help/Contact Us</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/bootstrap.min.css') }}">
</head>

<body style="background-color:#f2f2f7;">
   <div class="container-fluid">
      <div class="row flex-nowrap dash_head align-items-center">
         <div class="col-auto col-md-3 col-xl-2 logo-site">
            <a href="#"> <img src="{{ asset('theme/assets/images/logo.png') }}" alt="site_logo"> </a>
         </div>
         <div class="col top_right_head text-end">
            <a href="#"><span>Welcome, Asap Football</span> <img src="{{ asset('theme/assets/images/ring.svg') }}" alt="bell"></a>
         </div>
      </div>
      <div class="row flex-nowrap dash_board">
         @include('side-bar')
         <div class="col sec_cont">
               <div class="row">
                  <div class="head_top plr">
                     <h1> Help/Contact Us </h1>
                     <div class="row add_coach">
                        <div class="col-12">
                           <label class="searc-btn">
                              <input type="serach" placeholder="Search Player name, group">
                              <img src="{{ asset('theme/assets/images/akar-icons_search.svg') }}" alt="search">
                           </label>
                        </div>

                     </div>
                  </div>
                  <div class="sp_rd con-us">
                  <form method="POST" enctype="multipart/form-data" action="{{ route('send-mail') }}">         
                                    <div class="row">
                           @foreach($data as $item)
                           <div class="col-md-6 mb-5">
                              <label class="tair"> {{ $item->title }}
                                 <span>{{ $item->description }} </span>
                                 <input type="radio" checked="checked" name="reason" id="reason" value="{{ $item->id }}">
                                 <span class="mak"></span>
                              </label>
                           </div>
                           @endforeach
                           <div class="col-12 mb-3">
                              <label> Message </label>
                              <textarea name="message" id="message" rows="4" cols="50"></textarea>
                           </div>
                           <div class="col-md-12 text-end mb-3">
                              <button type="submit" class="btn drk-btn"> Submit </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
         </div>
      </div>
   </div>
   <script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>