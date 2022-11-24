@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Edit Team </h1>
         <a class="btn back_btn" href="{{ url('/team-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach">
         <form method="POST" enctype="multipart/form-data" action="{{ route('team-update',['id' => $id]) }}">
            <!-- <div class="row"> -->
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

            <!-- </div> -->
            <div class="row">
               <div class="col-md-6">
                  <label> Category </label>
                  <input type="text" name="category" id="category" value="{{ $data->category }}" required>
               </div>
               <div class="col-md-6">
                  <label> Team Rank </label>
                  <input type="text" name="team_rank" id="team_rank" value="{{ $data->team_rank }}" required>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Year Limit </label>
                  <input type="text" name="year_limit" id="year_limit" value="{{ $data->year_limit }}" required>
               </div>
               <div class="col-md-6">
                  <label> Team Name </label>
                  <input type="text" name="team_name" id="team_name" value="{{ $data->team_name }}" required>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label>Team image </label>
                  <div class="user_img">
                     @if($data->image)
                     <img src="{{ asset('Uploads/'.$data->image) }}" width="100" height="100" />
                     @endif
                  </div>
                  <div>
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
               <div class="col-md-6">
                  <label> Season </label>
                  <input type="text" name="season" id="season" value="{{ $data->season }}" required>
               </div>
            </div>
            <div class="row">
            
               <div class="col-md-6">
                  <label> Championship </label>
                  <input type="text" name="championship" id="championship" value="{{ $data->championship }}" required>
               </div>

            </div>
            <div class="row"> 
                     
                   
                                 <div class="col-md-6">
                                    <label> Coaches </label>
                                    <label class="sd">
                                    <select name="coach[]" multiple size = "3" id="coach" class="grid">
                                       @foreach($coaches as  $coach)
                                       <option value={{ $coach->id }}>{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                       @endforeach
                                       </select>
                                       <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon"> 
                                    </label>
                                    <div class="bootstrap-tagsinput">
                     @foreach($coach_teams as $coach_team)
                     <span class="tag label label-info">{{ $coach_team->first_name }} {{ $coach_team->last_name }}<span data-role="remove" class="delete_coach" id="{{$coach_team->coach_team_id}}"><img src="{{ asset('theme/assets/images/tagcross.svg') }}" alt="camera"></span></span>
                     @endforeach
                  </div>
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
   $("#phone").click(function() {
      $(".text-danger").hide();
   });
//    $("#year_limit").click(function(){
//       var category = $('#category').val();
//       var team_rank = $('#team_rank').val();
//       var team_name=category+'-'+team_rank
//       $('#team_name').val(team_name);
// });
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
   function readURL(input) {
      var preview = $('.user_img').empty();
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
      $(".delete_player").click(function() {
         var del_id = $(this).attr('id');
         $.ajax({
            type: 'POST',
            url: "/public/team-player-delete", 
            data: 'id=' + del_id,
            success: function(data) {
               if (data) {
                  window.location.reload(true);
               }
            }
         });
      });
      $(".delete_coach").click(function() {
         var del_id = $(this).attr('id');
         $.ajax({
            type: 'POST',
            url: "/public/team-coach-delete",
            data: 'id=' + del_id,
            success: function(data) {
               if (data) {
                  window.location.reload(true);
               }
            }
         });
      });
     
   });
</script>