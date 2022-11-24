@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Create New Trophy </h1>
         <a class="btn back_btn" href="{{ url('/trophy-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('trophy-add') }}">
         <div class="row">
              
              @foreach ($errors->all() as $error)
              <div style="color:red">{{ $error }}</div>
            @endforeach 
            </div> 
            <div class="row">
               <div class="col-md-12">
                  <h4>Trophy Image</h4>
                  <div class="user_img">
                     <img src="{{ asset('theme/assets/images/user.png') }}" alt="user">
                     <span>
                        <input type="file" id="image" name="image">
                        @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                        Upload Photo</span>
                  </div>
               </div>
            </div>
          
            <div class="row">
               <div class="col-md-12">
                  <label> Trophy Name </label>
                  <input type="name" name="name" required>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-end">
                  <a href="{{ url('/trophy-index') }}" class="btn gry-btn"> Cancel </a>
                  <button type="submit" class="btn drk-btn"> Submit </button>
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