@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Update Club Admin </h1>
         @if(Auth::user()->role_id == "1")
         <a class="btn back_btn" href="{{ url('/club-index') }}" role="button"> Back </a>
         @endif
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('club-update',['id' => $id]) }}">
            <div class="row">
               <div class="col-md-12">
                  <label> Clubs </label>
                  <label class="sd">
                     <select id="club_info_id" name="club_info_id">
                        <!-- <option value=0>Select Club</option> -->
                        @foreach($clubs as $club)
                        @if($user_detail->club_info_id == $club->id)
                        <option id="{{$club->id}}" value={{ $club->id }} selected>{{ $club->name }}</option>
                        @else
                        <option id="{{$club->id}}" value={{ $club->id }}>{{ $club->name }} </option>
                        @endif
                        @endforeach
                     </select>
                     <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                  </label>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label> Image </label>
                  <div class="user_imgs" style="margin-right: 22px;
    max-width: 110px;
    border-radius: 10px;">
                     @if($user_detail->image)
                     <img src="{{ asset('Uploads/'.$user_detail->image) }}" alt="image" width="100" height="100" />
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
            @if($role_id == "1")
            <div class="row">
               <div class="col-md-6">
                  <label> First Name </label>
                  <input type="text" name="first_name" id="first_name" value="{{ $user_detail->first_name }}" required>
               </div>
               <div class="col-md-6">
                  <label> Last Name </label>
                  <input type="text" name="last_name" id="last_name" value="{{ $user_detail->last_name }}" required>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Mobile Number </label>
                  <input type="text" name="phone" id="phone" value="{{ $user_detail->phone }}">
               </div>
               <div class="col-md-6">
                  <label> Email Address </label>
                  <input type="text" name="email" id="email" value="{{ $user_detail->email }}">
               </div>
            </div>
            @endif
            @if($role_id == "2")
            <div class="row">
               <div class="col-md-6">
                  <label> First Name </label>
                  <input type="text" name="first_name" id="first_name" value="{{ $user_detail->first_name }}" disabled>
               </div>
               <div class="col-md-6">
                  <label> Last Name </label>
                  <input type="text" name="last_name" id="last_name" value="{{ $user_detail->last_name }}" disabled>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Mobile Number </label>
                  <input type="text" name="phone" id="phone" value="{{ $user_detail->phone }}">
               </div>
               <div class="col-md-6">
                  <label> Email Address </label>
                  <input type="text" name="email" id="email" value="{{ $user_detail->email }}">
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label> Official Id Number </label>
                  @if(!empty($club_detail))
                  <input type="text" name="official_id_number" id="official_id_number" value="{{ $club_detail->official_id_number }}">
                  @else
                  <input type="text" name="official_id_number" id="official_id_number" required>
                  @endif

               </div>
               <div class="col-md-6">
                  <label> President </label>
                  @if(!empty($club_detail))
                  <input type="text" name="president" id="president" value="{{ $club_detail->president }}">
                  @else
                  <input type="text" name="president" id="president" required>
                  @endif
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label> Club Name </label>
                  @if(!empty($club_detail))
                  <input type="text" name="club_name" id="club_name" value="{{ $club_detail->name }}">
                  @else
                  <input type="text" name="club_name" id="club_name" required>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Main Address </label>
                  @if(!empty($club_detail))
                  <input type="text" name="main_address" id="main_address" value="{{ $club_detail->main_address }}" required>
                  @else
                  <input type="text" name="main_address" id="main_address" required>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> City </label>
                  @if(!empty($club_detail))
                  <input type="text" name="city" id="city" value="{{ $club_detail->city }}" required>
                  @else
                  <input type="text" name="city" id="city" required>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Postal Code </label>
                  @if(!empty($club_detail))
                  <input type="text" name="postal_code" id="postal_code" value="{{ $club_detail->postal_code }}" required>
                  @else
                  <input type="text" name="postal_code" id="postal_code" required>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Website URL </label>
                  @if(!empty($club_detail))
                  <input type="text" name="website_url" id="website_url" value="{{ $club_detail->website_url }}" required>
                  @else
                  <input type="text" name="website_url" id="website_url" required>
                  @endif
               </div>
            </div>
            @endif
            <div class="row">
               <div class="col-md-12 text-end">
                  @if(Auth::user()->role_id == "1")
                  <a href="{{ url('/club-index') }}" class="btn gry-btn"> Cancel </a>
                  @endif
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
   $("#phone").click(function() {
      $(".text-danger").hide();
   });

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