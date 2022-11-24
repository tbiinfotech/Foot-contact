@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Edit Club Notes </h1>
         <a class="btn back_btn" href="{{ url('/club-notes-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('club-notes-update',['id' => $id]) }}">

            <div class="row">
               @foreach ($errors->all() as $error)
               <div style="color:red">{{ $error }}</div>
               @endforeach
               <div class="col-md-6">
                  <label> Image </label>
                  <div class="user_imgs" style="margin-right: 22px;
    max-width: 110px;
    border-radius: 10px;">
                     @if($data->image)
                     <img src="{{ asset('Uploads/'.$data->image) }}" width="100" height="100" />
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
                        Upload Photo
                     </span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label> Title </label>
                  <input type="text" name="title" id="title" value="{{$data->title}}" required>
               </div>
               @if ($errors->has('title'))
               <span class="text-danger">{{ $errors->first('title') }}</span>
               @endif
            </div>
            <div class="row">

               <div class="col-md-12">
                  <label> Description </label>
                  <textarea type="textarea" name="description" id="description" value="{{$data->description}}" required>{{$data->description}}</textarea>
               </div>
               @if ($errors->has('description'))
               <span class="text-danger">{{ $errors->first('description') }}</span>
               @endif
            </div>
            <div class="row">
               <div class="col-md-12 text-end">
                  <a href="{{ url('/club-notes-index') }}" class="btn gry-btn"> Cancel </a>
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