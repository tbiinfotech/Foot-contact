@include('header')

         @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top"> 
                  <h1> Edit Trophy </h1>
                  <a class="btn back_btn" href="{{ url('/trophy-index') }}" role="button"> Back </a>
               </div>
               <div class="sp_rd add_coach">
                  <form method="POST" enctype="multipart/form-data" action="{{ route('trophy-update',['id' => $id]) }}">

                     <div class="row">
                     @foreach ($errors->all() as $error)
              <div style="color:red">{{ $error }}</div>
            @endforeach
                        <div class="col-md-6">
                           <h4>Coach Image</h4>
                           <div class="user_img">
                           @if($data->image)
                                <img src="{{ asset('/Uploads/'.$data->image) }}" width="50" height="50" />
                                @else
                                <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                                @endif                              <span>
                                 <input type="file"  id="image" name="image">
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
                   
                        <div class="col-md-6">
                           <label>Name </label>
                           <input type="name" name="name" id="name" value="{{ $data->name }}">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-end">
                           <a href="{{ url('/trophy-index') }}" class="btn gry-btn"> Cancel </a>
                           <!-- <button type="submit" class="btn gry-btn"> Cancel </button> -->
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
