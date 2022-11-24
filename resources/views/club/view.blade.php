@include('header')

         @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top">
                  <h1> Coach Profile </h1>
                  <a class="btn back_btn" href="{{ url('/club-index') }}" role="button"> Back </a>
               </div>
               <div class="sp_rd coach-pr">
                  <div class="row">
                     <div class="col-lg-6">
                        <div class="user_img">
                        <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                           <label>Maethis Beaureguard <span>Coach</span></label>
                        </div>
                     </div>
                     <div class="col-lg-6">
                        <div class="row">
                           <div class="col-6 box_cr">
                              <img src="{{ asset('theme/assets/images/Icon1.svg') }}" alt="iconone">
                              <h2>40<span>Players Under Coach</span></h2>
                           </div>
                           <div class="col-6 box_cr">
                              <img src="{{ asset('theme/assets/images/Group5.svg') }}" alt="iconone">
                              <h2>3<span>Numbers of Groups</span></h2>
                           </div>
                        </div>
                     </div>
                  </div>
                  <nav>
                     <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Information</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Admins</button>
                        <button class="nav-link" id="nav-coaches-tab" data-bs-toggle="tab" data-bs-target="#nav-coaches" type="button" role="tab" aria-controls="nav-coaches" aria-selected="false">Coaches</button>
                        <button class="nav-link" id="nav-contract-tab" data-bs-toggle="tab" data-bs-target="#nav-contract" type="button" role="tab" aria-controls="nav-contract" aria-selected="false">Contracts</button>

                     </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                     <ul>
                           <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one">Sofiane	Benamar </li>
                        </ul>
                        </div>
                       
                     </div>
                     <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                     <ul>
                           <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one">Sofiane	Benamar </li>
                        </ul>
                     </div>
                     <div class="tab-pane fade" id="nav-coaches" role="tabpanel" aria-labelledby="nav-coaches-tab">
                     <ul>
                           <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one">Sofiane	Benamar </li>
                        </ul>
                     </div>
                     <div class="tab-pane fade" id="nav-contract" role="tabpanel" aria-labelledby="nav-contract-tab">
                     <ul>
                           <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one">Sofiane	Benamar </li>
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