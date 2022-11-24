@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Edit Coach </h1>
         <a class="btn back_btn" href="{{ url('/coach-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('coach-update',['id' => $id]) }}">

            <div class="row">
               @foreach ($errors->all() as $error)
               <div style="color:red">{{ $error }}</div>
               @endforeach
               
               <div class="col-md-6">
                  <label> Image </label>
                  <div class="user_imgs" style="margin-right: 22px;max-width: 110px;border-radius: 10px;">
                     @if($data->image)
                     <img src="{{ asset('Uploads/'.$data->image) }}" alt="image" width="100" height="100" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
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
                        Upload Photo
                     </span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> First Name </label>
                  <input type="name" name="first_name" id="first_name" value="{{ $data->first_name }}">
               </div>
               <div class="col-md-6">
                  <label> Last Name </label>
                  <input type="text" name="last_name" id="last_name" value="{{ $data->last_name }}">
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Mobile Number </label>
                  <input type="text" name="phone" id="phone" value="{{ $data->phone }}">
               </div>
               <div class="col-md-6">
                  <label> Email Address </label>
                  <input type="mail" name="email" id="email" value="{{ $data->email }}">
               </div>
            </div>
          
            <div class="row">
               <div class="col-md-12 text-end">
                  <a href="{{ url('/coach-index') }}" class="btn gry-btn"> Cancel </a>
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
<script>
   $(document).ready(function() {
      //delete  coach roles
      $(".delete_role").click(function() {
         var del_id = $(this).attr('id');
         $.ajax({
            type: 'POST',
            url: "/public/coach-role-delete",
            data: 'id=' + del_id,
            success: function(data) {
               if (data) {
                  window.location.reload(true);
               }
            }
         });
      });
      //delete group coach
      $(".delete_group").click(function() {
         var del_id = $(this).attr('id');
         $.ajax({
            type: 'POST',
            url: "/public/coach-group-delete",
            data: 'id=' + del_id,
            success: function(data) {
               if (data) {
                  window.location.reload(true);
               }
            }
         });
      });
      //coach change
      $('.coach-list').change(function() {
         var option_id = $(this).val();
         window.location.href = "{{URL::to('/coach-edit')}}?id=" + option_id;

      });
   });
</script>