@include('header')

@include('side-bar')
<style>
   .btn_clr{
      background-color:#6B1687;
      border-color:#6B1687;
      --bs-btn-hover-color:#6B1687;
   }
   .btn {
      --bs-btn-color:#ffffff
   }
   </style>
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Group Details </h1>
         <a class="btn back_btn" href="{{ url('/group-index') }}" role="button"> Back </a>
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
                  <div class="col-4 box_cr">
                     <img src="{{ asset('theme/assets/images/coach.svg') }}" alt="iconone">
                     <h2>{{$coach_count}}<span>Number of Coach</span></h2>
                  </div>
                  <div class="col-4 box_cr">
                     <img src="{{ asset('theme/assets/images/Group5.svg') }}" alt="iconone">
                     <h2>{{$team_count}}<span>Numbers of Teams</span></h2>
                  </div>
                  <div class="col-4 box_cr">
                     <img src="{{ asset('theme/assets/images/Group-4.svg') }}" alt="iconone">
                     <h2>{{$player_count}}<span>Numbers of Players</span></h2>
                  </div>
               </div>
            </div>
         </div>
         <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
               <button class="nav-link active" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Teams</button>

               <button class="nav-link" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="false">Players List</button>


               <button class="nav-link" id="nav-coach-tab" data-bs-toggle="tab" data-bs-target="#nav-coach" type="button" role="tab" aria-controls="nav-coach" aria-selected="false">Coaches</button>

               <button class="nav-link" id="nav-event-tab" data-bs-toggle="tab" data-bs-target="#nav-event" type="button" role="tab" aria-controls="nav-event" aria-selected="false">Events</button>

               <button class="nav-link" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="false">Information</button>
            </div>
         </nav>
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <ul>
                  @foreach($players as $player)
                  <li>
                     @if($player->image)
                     <img src="{{ asset('Uploads/'.$player->image) }}" alt="image" width="50" height="50" alt="one">
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                     @endif
                     {{$player->first_name}} {{$player->last_name}}
                  </li>
                  @endforeach
               </ul>
            </div>
            <div class="tab-pane fade active show" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="coach-m table-responsive">
                  <div>
                     <a class="btn btn_clr" style="float: right;" href="{{ route('team-add') }}" role="button">
                        + Add Team
                     </a>
                  </div>
                  <table class="table">
                     <thead>

                        <tr>
                           <th scope="col">Sr.</th>
                           <th scope="col">Team</th>
                           <th scope="col">Players</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($teams as $team)

                        <tr>
                           <td scope="row">{{$team->id}}</td>
                           <td>{{$team->team_name}}</td>
                           <td>{{ App\Models\PlayerTeam::where(['team_id'=>$team->id])->count()}} </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="tab-pane fade" id="nav-coach" role="tabpanel" aria-labelledby="nav-coach-tab">
               <ul>
                  @foreach($coaches as $coach)
                  <li>
                     @if($coach->image)
                     <img src="{{ asset('Uploads/'.$coach->image) }}" alt="image" width="50" height="50" alt="one">
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                     @endif
                     {{$coach->first_name}} {{$coach->last_name}}
                  </li>
                  @endforeach
               </ul>
            </div>

            <div class="tab-pane fade" id="nav-event" role="tabpanel" aria-labelledby="nav-event-tab">
               <ul>
                  @foreach($coaches as $coach)
                  <li>
                     @if($coach->image)
                     <img src="{{ asset('Uploads/'.$coach->image) }}"  alt="image" width="50" height="50" alt="one">
                     @else
                     <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                     @endif
                     {{$coach->first_name}} {{$coach->last_name}}
                  </li>
                  @endforeach
               </ul>

            </div>

            <div class="tab-pane fade" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">e</div>
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