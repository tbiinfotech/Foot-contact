@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Trophy Details </h1>
         <a class="btn back_btn" href="{{ url('/trophy-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd coach-pr grp-d">
         <div class="row">
         <div class="col-lg-6">
               <div class="user_img">
               @if($data->image)
                            <img src="{{ asset('/Uploads/'.$data->image) }}" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                  @endif
               </div>
            </div>
            <div class="col-lg-6">
               <div class="user_img">
                  <label style="font-size:40px;">{{ $data->name }}</label>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
</div>
</div>


<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>