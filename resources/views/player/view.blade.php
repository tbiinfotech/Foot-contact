@include('header')
@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Player Details </h1>
         <a class="btn back_btn" href="{{ url('/player-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd coach-pr">
         <div class="row">
            <div class="col-lg-6">
               <div class="user_img">
                  @if($data->image)
                  <img src="{{ asset('Uploads/'.$data->image) }}" alt="image" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" alt="image" width="50" height="50" />
                  @endif
                  <label>{{ $data->first_name }} {{ $data->last_name }}<span>Player</span>
                     <span>
                     @if(Auth::user()->role_id == "1")
                     <img src="{{ asset('theme/assets/images/Icon-blue.svg') }}" alt="">
                           @else
                           <img src="{{ asset('theme/assets/images/Icon.svg') }}" alt="">
                           @endif
                     
                     {{date('d M,Y', strtotime($data->date_of_birth)) }}</span></label>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="row">
                  <div class="col-md-6 box_cr box-info">
                     <label>
                     @if(Auth::user()->role_id == "1")
                     <img src="{{ asset('theme/assets/images/phone.svg') }}" alt="call">
                           @else
                           <img src="{{ asset('theme/assets/images/Call.svg') }}" alt="call">
                           @endif
                        <span>{{ $data->phone }}</span>
                     </label>

                     <label>
                     @if(Auth::user()->role_id == "1")
                     <img src="{{ asset('theme/assets/images/mail.svg') }}" alt="message">
                           @else
                           <img src="{{ asset('theme/assets/images/Message.svg') }}" alt="message">
                           @endif
                        <span>{{ $data->email }}</span>
                     </label>
                  </div>
                  <div class="col-md-6 box_cr">
                  @if(Auth::user()->role_id == "1") 
                  <img src="{{ asset('theme/assets/images/Group-team.svg') }}" alt="icontwo">
                           @else
                           <img src="{{ asset('theme/assets/images/Group5.svg') }}" alt="icontwo">
                           @endif
                     <h2>{{ $data->playerGroupCount($data->id) }}<span>Numbers of Teams</span></h2>
                  </div>
               </div>
            </div>
         </div>
         <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
               <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Teams</button>
               <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Family</button>
            </div>
         </nav>
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
               <div class="row">
                  @foreach($coach_groups as $coach_group)
                  <div class="col-md-3">
                     <div class="brand_logo">
                        <img src="{{ asset('Uploads/'.$coach_group->image) }}" alt="img" width="50" height="50">
                        <h3> {{$coach_group->team_name}} </h3>
                       
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
         <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
               <div class="row">
                  @foreach($parent as $parents)
                  <div class="col-md-3">
                     <div class="brand_logo">
                        <!-- <img src="{{ asset('Uploads/'.$parents->logo) }}" alt="img" width="50" height="50"> -->
                        <h3> {{$parents->first_name}} {{$parents->last_name}} </h3>
                     </div>
                  </div>
                  @endforeach
               </div>
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