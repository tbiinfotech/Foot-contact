@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Update Club Information </h1>
         @if(Auth::user()->role_id == "1")
         <a class="btn back_btn" href="{{ url('/club-info-index') }}" role="button"> Back </a>
         @endif
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('club-info-update',['id' => $id]) }}">
            <div class="row">
               <div class="col-md-12"> 
                  <h4>Club Image</h4>
                  <div class="user_imgs" style="margin-right: 22px;max-width: 110px;border-radius: 10px;">
                     @if($club_detail->logo)
                     <img src="{{ asset('Uploads/'.$club_detail->logo) }}" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                     @endif
                  </div>
                  <div class="user_img">
                     <span>
                        <input type="file" id="logo" name="logo">
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
                  <label> Club Name </label>

                  <input type="text" name="club_name" id="club_name" value="{{ $club_detail->name }}" required>
               </div>

               <div class="col-md-6">
                  <label> President </label>

                  <input type="text" name="president" id="president" value="{{ $club_detail->president }}" required>
               </div>
            </div>

            <div class="row">
               <div class="col-md-6">
                  <label> Official Id Number </label>

                  <input type="text" name="official_id_number" id="official_id_number" value="{{ $club_detail->official_id_number }}" required>

               </div>
               <div class="col-md-6">
                  <label> Main Address </label>

                  <input type="text" name="main_address" id="main_address" value="{{ $club_detail->main_address }}" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> City </label>

                  <input type="text" name="city" id="city" value="{{ $club_detail->city }}" required>
               </div>
               <div class="col-md-6">
                  <label> Postal Code </label>

                  <input type="text" name="postal_code" id="postal_code" value="{{ $club_detail->postal_code }}" required>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Official Email </label>

                  <input type="text" name="official_email" id="official_email" value="{{ $club_detail->official_email }}" required>
               </div>

               <div class="col-md-6">
                  <label> Contact Email </label>

                  <input type="text" name="contact_email" id="contact_email" value="{{ $club_detail->contact_email }}" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Website URL </label>

                  <input type="text" name="website_url" id="website_url" value="{{ $club_detail->website_url }}" >
               </div>
               <div class="col-md-6">
                  <label> Federation Page Link </label>

                  <input type="text" name="federation_page_link" id="federation_page_link" value="{{ $club_detail->federation_page_link }}" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Facebook </label>

                  <input type="text" name="facebook" id="facebook" value="{{ $club_detail->facebook }}" >
               </div>
               <div class="col-md-6">
                  <label> Instagram </label>

                  <input type="text" name="instagram" id="instagram" value="{{ $club_detail->instagram }}" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Twitter </label>

                  <input type="text" name="twitter" id="twitter" value="{{ $club_detail->twitter }}" >
               </div>
               <div class="col-md-6">
                  <label> Premises Address </label>

                  <input type="text" name="premises_address" id="premises_address" value="{{ $club_detail->premises_address }}" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Premises Field Type </label>

                  <input type="text" name="premises_field_type" id="premises_field_type" value="{{ $club_detail->premises_field_type }}" >
               </div>

            </div>
            <div class="row">
               <div class="col-md-12 text-end">

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

   $(document).on('change', "#logo", function() {
      readURL(this);
   });
</script>