@include('header')

         @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top">
                  <h1> Edit Player </h1>
                  <a class="btn back_btn" href="{{ url('/player-index') }}" role="button"> Back </a>
               </div>
               <div class="sp_rd add_coach">
                  <form method="POST" enctype="multipart/form-data" action="{{ route('player-update',['id' => $id]) }}">
                  <div class="row">
               <div class="col-md-12"> 
                  <h4>Coach Image</h4>
                  <div class="user_imgs" style="margin-right: 22px;max-width: 110px;border-radius: 10px;">
                     @if($data->image)
                     <img src="{{ asset('Uploads/'.$data->image) }}" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                     @endif
                  </div>
                  <div class="user_img">
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
                        <div class="col-md-6">
                           <label> First Name </label>
                           <input type="text" name="first_name" id="first_name" value="{{$data->first_name}}" required>
                        </div>
                        <div class="col-md-6">
                           <label> Last Name </label>
                           <input type="text" name="last_name" id="last_name" value="{{$data->last_name}}" required>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label> Mobile Number </label>
                           <input type="text" name="phone" id="phone" value="{{$data->phone}}" required>
                        </div>
                        <div class="col-md-6">
                           <label> Email Address </label>
                           <input type="text" name="email" id="email" value="{{$data->email}}" disabled>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-end">
                        <a href="{{ url('/player-index') }}" class="btn gry-btn"> Cancel </a>
                           <!-- <button type="button"  class="btn gry-btn"> Cancel </button> -->
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
<script>
   function readURL(input) {
      var preview = $('.user_imgs').empty();
      if (input.files) $.each(input.files, readAndPreview);

      function readAndPreview(i, file) {
         if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
         }
         var reader = new FileReader();
         $(reader).on("load", function() {
            preview.append($("<img/>", {
               src: this.result
            }));
         });
         reader.readAsDataURL(file);
      }
   }

   $(document).on('change', "#image", function() {
      readURL(this);
   });
</script>