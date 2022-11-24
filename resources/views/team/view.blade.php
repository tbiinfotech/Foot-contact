@include('header')

@include('side-bar')
<style>
   .btn_clr {
      background-color: #6B1687;
      border-color: #6B1687;
      --bs-btn-hover-color: #6B1687;
   }

   .btn {
      --bs-btn-color: #ffffff
   }
</style>
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Team Details </h1>
         <a class="btn back_btn" href="{{ url('/team-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd coach-pr grp-d">
         <div class="row">
            <div class="col-lg-5">
               <div class="user_img">
                  <td>
                     @if($data->image)
                     <img src="{{ asset('/Uploads/'.$data->image) }}" alt="image" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                     @endif
                  </td>
                  <label style="font-size:40px;">{{ $data->name }}</label>
               </div>
            </div>
            <div class="col-lg-7">
               <div class="row">
                  <div class="col-6 box_cr">
                     <img src="{{ asset('theme/assets/images/coach.svg') }}" alt="iconone">
                     <h2>{{$coach_count}}<span>Number of Coach</span></h2>
                  </div>

                  <div class="col-6 box_cr">
                     <img src="{{ asset('theme/assets/images/Group-4.svg') }}" alt="iconone">
                     <h2>{{$player_count}}<span>Numbers of Players</span></h2>
                  </div>
               </div>
            </div>
         </div>
         <div class="col sec_cont team_view col-xl-10">

            <div class="row">
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Category </h1>
                        <span>{{ $data->category }}</span>
                     </label>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Team Rank </h1>
                        <span>{{ $data->team_rank }}</span>
                     </label>
                  </div>
               </div>
            </div>
            
            <div class="row">
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Year Limit </h1>
                        <span>{{ $data->year_limit }}</span>
                     </label>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Team Name </h1>
                        <span>{{ $data->team_name }}</span>
                     </label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Season </h1>
                        <span>{{ $data->season }}</span>
                     </label>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Championship </h1>
                        <span>{{ $data->championship }}</span>
                     </label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <div class="team_ac">
                     <label>
                        <h1>Team Code</h1>
                        <span>{{ $data->teamcode }}</span>
                     </label>
                  </div>
               </div>
            </div>

         </div>
         <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
               <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Players</button>

               <button class="nav-link" id="nav-coach-tab" data-bs-toggle="tab" data-bs-target="#nav-coach" type="button" role="tab" aria-controls="nav-coach" aria-selected="false">Coaches</button>

            </div>
         </nav>

         <div class="tab-content" id="nav-tabContent">

            <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <ul>
                  @foreach($players as $player)
                  <li>
                     @if($player->image)
                     <img src="{{ asset('Uploads/'.$player->image) }}" alt="image" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                     @endif
                     {{$player->first_name}} {{$player->last_name}}
                  </li>
                  @endforeach
               </ul>
            </div>

            <div class="tab-pane fade" id="nav-coach" role="tabpanel" aria-labelledby="nav-coach-tab">
               <ul>
                  @foreach($coaches as $coach)
                  <li>
                     @if($coach->image)
                     <img src="{{ asset('Uploads/'.$coach->image) }}" alt="image" width="50" height="50" />
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                     @endif
                     {{$coach->first_name}} {{$coach->last_name}}
                  </li>
                  @endforeach
               </ul>
            </div>

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