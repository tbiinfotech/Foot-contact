@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top"> 
         <h1> Add Club Information </h1>
         @if(Auth::user()->role_id == "1")
         <a class="btn back_btn" href="{{ url('/club-info-index') }}" role="button"> Back </a>
         @endif
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('club-info-create') }}">
            <div class="row">
               <div class="col-md-12">
                  <h4>Club Image</h4>
                  <div class="user_imgs" style="margin-right: 22px;max-width: 110px;border-radius: 10px;">
                  </div>
                  <div class="user_img">
                     <span>
                        <input type="file" id="logo" name="logo">
                        @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                        Upload Photo
                     </span>
                  </div>
                 
                  @if ($errors->has('logo')) 
                  <span class="text-danger">{{ $errors->first('logo') }}</span>
                  @endif
               </div>
            </div>
           
          
            <div class="row">
            <div class="col-md-6">
                  <label> Club Name </label>
                  
                  <input type="text" name="name" id="name"  required>
                  @if ($errors->has('name'))
                  <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
               </div>
              
               <div class="col-md-6">
                  <label> President </label>
                  
                  <input type="text" name="president" id="president" required>
                  @if ($errors->has('president'))
                  <span class="text-danger">{{ $errors->first('president') }}</span>
                  @endif
               </div>
            </div>
          
            <div class="row">
            <div class="col-md-6">
                  <label> Official Id Number </label>
                 
                  <input type="text" name="official_id_number" id="official_id_number"  required>
                  @if ($errors->has('official_id_number'))
                  <span class="text-danger">{{ $errors->first('official_id_number') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Main Address </label>
                
                  <input type="text" name="main_address" id="main_address" >
                  @if ($errors->has('main_address'))
                  <span class="text-danger">{{ $errors->first('main_address') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> City </label>
                
                  <input type="text" name="city" id="city"  required>
                  @if ($errors->has('city'))
                  <span class="text-danger">{{ $errors->first('city') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Postal Code </label>
                
                  <input type="text" name="postal_code" id="postal_code"  required>
                  @if ($errors->has('postal_code'))
                  <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                  <label> Official Email </label>
                  
                  <input type="text" name="official_email" id="official_email"  required>
                  @if ($errors->has('official_email'))
                  <span class="text-danger">{{ $errors->first('official_email') }}</span>
                  @endif
               </div>
             
               <div class="col-md-6">
                  <label> Contact Email </label>
                  
                  <input type="text" name="contact_email" id="contact_email" >
                  @if ($errors->has('contact_email'))
                  <span class="text-danger">{{ $errors->first('contact_email') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Website URL  </label>
                
                  <input type="text" name="website_url" id="website_url"  >
                  @if ($errors->has('website_url'))
                  <span class="text-danger">{{ $errors->first('website_url') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Federation Page Link  </label>
                
                  <input type="text" name="federation_page_link" id="federation_page_link"  >
                  @if ($errors->has('federation_page_link'))
                  <span class="text-danger">{{ $errors->first('federation_page_link') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Facebook  </label>
                
                  <input type="text" name="facebook" id="facebook"  >
                  @if ($errors->has('facebook'))
                  <span class="text-danger">{{ $errors->first('facebook') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Instagram </label>
                
                  <input type="text" name="instagram" id="instagram"  >
                  @if ($errors->has('instagram'))
                  <span class="text-danger">{{ $errors->first('instagram') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Twitter  </label>
                
                  <input type="text" name="twitter" id="twitter"  >
                  @if ($errors->has('twitter'))
                  <span class="text-danger">{{ $errors->first('twitter') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Premises Address  </label>
                
                  <input type="text" name="premises_address" id="premises_address"  >
                  @if ($errors->has('premises_address'))
                  <span class="text-danger">{{ $errors->first('premises_address') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Premises Field Type  </label>
                
                  <input type="text" name="premises_field_type" id="premises_field_type"  >
                  @if ($errors->has('premises_field_type'))
                  <span class="text-danger">{{ $errors->first('premises_field_type') }}</span>
                  @endif
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
<script> function readURL(input) {
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
   });</script>