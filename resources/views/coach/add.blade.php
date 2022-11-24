@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Add Coach </h1>
         <a class="btn back_btn" href="{{ url('/coach-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('coach-add') }}">
            <div class="row">
               <div class="col-md-12">
                  <h4>Coach Image</h4>
                  <div class="user_imgs" style="margin-right: 22px;max-width: 110px;border-radius: 10px;">
                  </div>
                  <div class="user_img">
                     <span>
                        <input type="file" id="image" name="image" required>
                        @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                        Upload Photo
                     </span>
                  </div>

                  @if ($errors->has('image'))
                  <span class="text-danger">{{ $errors->first('image') }}</span>
                  @endif
               </div>
            </div>
          
            <div class="row">
               <div class="col-md-6">
                  <label> First Name </label>
                  <input type="text" name="first_name" id="first_name" required>
                  @if ($errors->has('first_name'))
                  <span class="text-danger">{{ $errors->first('first_name') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Last Name </label>
                  <input type="text" name="last_name" id="last_name" required>
                  @if ($errors->has('last_name'))
                  <span class="text-danger">{{ $errors->first('last_name') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Mobile Number </label> 
                  <input type="text" name="phone" id="phone" required>
                  @if ($errors->has('phone'))
                  <span class="text-danger">{{ $errors->first('phone') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Email Address </label>
                  <input type="text" name="email" id="email" required>
                  @if ($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
                  @endif
               </div>
            </div>
         
            <div class="row">
               <div class="col-md-12 text-end">
                  <a href="{{ url('/coach-index') }}" class="btn gry-btn"> Cancel </a>
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