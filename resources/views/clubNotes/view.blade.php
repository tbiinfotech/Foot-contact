@include('header')

@include('side-bar')
<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Club Notes </h1>
         <a class="btn back_btn" href="{{ url('/club-notes-index') }}" role="button"> Back </a>
      </div>
      <div class="sp_rd coach-pr grp-d">
         <div class="row">
            <div class="col-lg-6">
               <div class="user_img">
                  @if($data->image)
                  <img src="{{ asset('/Uploads/'.$data->image) }}" width="50" height="50" />
                  @else
                  <img src="{{ asset('Uploads/profile-picture.jpg') }}" width="50" height="50" />
                  @endif
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-6">
               <div class="main_address">
                  <label>
                     <h1> Title
                     </h1>
                     <span>{{ $data->title }}</span>
                  </label>
               </div>
            </div>

         </div>
         <div class="row">
            <div class="col-lg-6">
               <div class="main_address">
                  <label>
                     <h1> Description
                     </h1>
                     <span>{{ $data->description }}</span>
                  </label>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="main_address">
               <h1> Status
                     </h1>
                  @if($data->status==0)
                  <label>Active</label>
                  @else
                  <label>Inactive</label>
                  @endif
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