@include('header')

@include('side-bar')
<style>
   .btn.drk-btn {
      background-color: #6B1687;
      color: #fff;
   }
</style>
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Coach Profile </h1>
         <a class="btn back_btn" href="{{ url('/coach-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd coach-pr">
         <h4>Coach Image</h4>
         <div class="row">
            <div class="col-lg-6">
               <div class="user_img">
                  @if($data->image)
                  <img src="{{ asset('Uploads/'.$data->image) }}" alt="image" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                  @endif
                  <label>{{ $data->name }} </label>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="row">
                  <div class="col-5 box_cr">
                     <img src="{{ asset('theme/assets/images/Icon1.svg') }}" alt="iconone">
                     <h2>{{ $group_player_count }}<span>Players Under Coach</span></h2>
                  </div>
                  <div class="col-5 box_cr">
                     <img src="{{ asset('theme/assets/images/Group5.svg') }}" alt="iconone">
                     <h2>{{ $coach_team_count }}<span>Numbers of Teams</span></h2>
                  </div>
                  <div class="col-2 box_cr">
                     <h2>Passcode<span>{{ isset($passcode)?$passcode:'' }}</span></h2>
                  </div>
               </div>
            </div>
         </div>
         <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
               <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Player List</button>
               <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Teams</button>
            </div>
         </nav>
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <form action="#">
                  <div class="row add_coach coa_pr">
                     <div class="col-lg-3">
                        <label class="searc-btn">
                           <input type="text" id="srch-player" placeholder="Search Player  name">
                           <img src="{{ asset('theme/assets/images/akar-icons_search.svg') }}" alt="search">
                        </label>
                     </div>
                     <div class="col-lg-5">
                        <div class="search_by">
                           <label> Search By Playerlist</label>
                           <label class="sd">
                              <select name="player-list" id="player-list" class="player-list" class="grid">
                                 <option value="0">All</option>
                                 @foreach($coach_player as $grps)
                                 <option value={{ $grps->id }}>{{ $grps->name }}</option>
                                 @endforeach
                              </select>
                              <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-2">
                        <button type="button" name="reset" id="reset" class="btn drk-btn">Reset</button>
                     </div>
               </form>
            </div>
            <ul>
               @foreach($group_player_list as $group_plyr)
               <li>
                  @if($group_plyr->image)
                  <img src="{{ asset('Uploads/'.$group_plyr->image) }}" alt="image" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                  @endif
                  {{$group_plyr->first_name}} {{$group_plyr->last_name}}
               </li>
               @endforeach
            </ul>
         </div>
         <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <form action="#">
                  <div class="row add_coach coa_pr">
                     <div class="col-lg-3">
                        <label class="searc-btn">
                           <input type="serach" id="srch-team" placeholder="Search Player name">
                           <img src="{{ asset('theme/assets/images/akar-icons_search.svg') }}" alt="search">
                        </label>
                     </div>
                     <div class="col-lg-5">
                        <div class="search_by">
                           <label> Search By Teams</label>
                           <label class="sd">
                              <select name="team-list" id="team-list" class="team-list" class="grid">
                                 <option value="0">All</option>
                                 @foreach($coach_team as $coach_grp)
                                 <option value={{ $coach_grp->id }}>{{ $coach_grp->team_name }}</option>
                                 @endforeach
                              </select>
                              <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-2">
                        <button type="button" name="reset" id="reset" class="btn drk-btn">Reset</button>
                     </div>
               </form>
            </div>
            <ul>
               @foreach($coach_team_data as $coach_grp)
               <li> <img src="{{ asset('Uploads/'.$coach_grp->image) }}" width="50" height="50" alt="one">{{ $coach_grp->team_name }} </li>
               @endforeach
            </ul>
         </div>
      </div>
   </div>
</div>
</div>
</div>


<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>
<script>
$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});
// $(document).keypress(function(event){
//         var keycode = (event.keyCode ? event.keyCode : event.which);
//         if(keycode == '13'){
//          var option_id =$("#srch-player").val(); 
        
//          const queryString = window.location.search;
//          const urlParams = new URLSearchParams(queryString);
//          const id = urlParams.get('id')
//          window.location.href = "{{URL::to('/coach-view')}}?id=" + id + "&search_name=" + option_id;
//          alert(window.location.href)
//         }
//       });
   $(document).ready(function() {

      // $('.team-list').click(function() {
      // $('#nav-home-tab').removeClass('active');
      //   $('#nav-profile-tab').addClass('active');
      // })
      // $('#srch-team').click(function() {
      // $('#nav-home-tab').removeClass('active');
      //   $('#nav-profile-tab').addClass('active');
      // })
      $('#reset').click(function() {
         const queryString = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         const id = urlParams.get('id')
         window.location.href = "{{URL::to('/coach-view')}}?id=" + id;
      })
      $('#srch-player').change(function() { 
         var option_id = $(this).val(); 
         const queryString = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         const id = urlParams.get('id')
         window.location.href = "{{URL::to('/coach-view')}}?id=" + id + "&search_name=" + option_id;

      });
      $('#srch-team').change(function() {

         var option_id = $(this).val();
         const queryString = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         const id = urlParams.get('id')

         window.location.href = "{{URL::to('/coach-view')}}?id=" + id + "&search_team=" + option_id;

      });
      //team-list change
      $('.team-list').change(function() {
         var option_id = $(this).val();
         const queryString = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         const id = urlParams.get('id')

         window.location.href = "{{URL::to('/coach-view')}}?id=" + id + "&search=" + option_id;

      });
      //player-list change
      $('.player-list').change(function() {
         var option_id = $(this).val();
         const queryString = window.location.search;
         const urlParams = new URLSearchParams(queryString);
         const id = urlParams.get('id')
         window.location.href = "{{URL::to('/coach-view')}}?id=" + id + "&search_player=" + option_id;

      });

   });
</script>