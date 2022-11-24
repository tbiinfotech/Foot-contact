@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Add Team </h1>
         <a class="btn back_btn" href="{{ url('/team-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('team-add') }}">
            <div class="row">
               <!-- <div class="col-md-12">
                  <label> Clubs </label>
                  <label class="sd">
                     <select id="club_info_id" name="club_info_id">
                        <option value=0>Select Club</option>
                        @foreach($clubs as $club)
                        <option value={{ $club->id }}>{{ $club->name }}</option>
                        @endforeach
                     </select>
                     <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                  </label>
               </div> -->

            </div>
            <div class="row"> 
               <div class="col-md-6">
                  <label> Category </label>
                  <input type="text" name="category" id="category" required>
                  @if ($errors->has('category'))
                  <span class="text-danger">{{ $errors->first('category') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Team Rank </label>
                  <input type="text" name="team_rank" id="team_rank" required>
                  @if ($errors->has('team_rank'))
                  <span class="text-danger">{{ $errors->first('team_rank') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Year Limit </label>
                  <input type="text" name="year_limit" id="year_limit" required>
                  @if ($errors->has('year_limit'))
                  <span class="text-danger">{{ $errors->first('year_limit') }}</span>
                  @endif
               </div>
               <div class="col-md-6">
                  <label> Team Name </label>
                  <input type="text" name="team_name" id="team_name" readonly>
                  @if ($errors->has('team_name'))
                  <span class="text-danger">{{ $errors->first('team_name') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <h4>Team Image</h4>

                  <div class="user_imgs" style="margin-right: 22px;
max-width: 110px;
border-radius: 10px;">
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

                  @if ($errors->has('image'))
                  <span class="text-danger">{{ $errors->first('image') }}</span>
                  @endif
               </div>
            
               <div class="col-md-6">
                  <label> Season </label>
                  <input type="text" name="season" id="season" required>
                  @if ($errors->has('season'))
                  <span class="text-danger">{{ $errors->first('season') }}</span>
                  @endif
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label> Championship </label>
                  <input type="text" name="championship" id="championship" required>
                  @if ($errors->has('championship'))
                  <span class="text-danger">{{ $errors->first('championship') }}</span>
                  @endif
               </div>

            </div>
            <div class="row"> 
                     
           
                        <div class="col-md-6">
                           <label> Coaches </label>
                           <label class="sd">
                           <select name="coach[]" multiple size = "3" id="coach" class="grid" required>
                              @foreach($coaches as  $coach)
                              <option value={{ $coach->id }}>{{ $coach->first_name }} {{ $coach->last_name }}</option>
                              @endforeach
                              </select>
                              <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon"> 
                           </label>
                        </div>
                     </div>
                     
            <div class="row">
               <div class="col-md-12 text-end">
                  <a href="{{ url('/team-index') }}" class="btn gry-btn"> Cancel </a>
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
  $("#category").keyup(function() {
      var category = $('#category').val();
      var team_rank = $('#team_rank').val();
      var team_name=category+'-'+team_rank
      $('#team_name').val(team_name);
});
$("#team_rank").keyup(function() {
      var category = $('#category').val();
      var team_rank = $('#team_rank').val();
      var team_name=category+'-'+team_rank
      $('#team_name').val(team_name);
});
      
           
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