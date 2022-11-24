@include('header')

      @include('side-bar')
         <div class="col sec_cont">
            <div class="row">
               <div class="head_top">
                  <h1> Add Coach </h1>
                  <a class="btn back_btn" href="{{ url('/coach-index') }}" role="button"> Back </a>
               </div>
               <div class="sp_rd add_coach">
                  <form action="/action_page.php">
                     <div class="row">
                     @foreach ($errors->all() as $error)
              <div style="color:red">{{ $error }}</div>
            @endforeach
                        <div class="col-md-6">
                           <label> Select Existing Coach </label> 
                           <label class="sd">
                              <select class="coach-list">
                              <option  value=0>Select Coach</option>
 
                              @foreach($coachs as $coach) 
                                 <option id="{{$coach->id}}" value={{ $coach->id }}>{{ $coach->first_name }} {{ $coach->last_name }}</option>
                                 @endforeach
                              </select>
                              <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon"> 
                           </label>
                        </div>
                        <div class="col-md-6">
                           <h4>Coach Image</h4>
                           <div class="user_img">
                              <img src="{{ asset('theme/assets/images/user.png') }}" alt="user">
                              <span>
                              <input type="file" name="user" disabled>
                              @if(Auth::user()->role_id == "1")
                                 <img src="{{ asset('theme/assets/images/Camera-b.svg') }}" alt="camera">
                           @else
                           <img src="{{ asset('theme/assets/images/Camera.svg') }}" alt="camera">
                           @endif
                              Upload Photo</span>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label> First Name </label>
                           <input type="name" name="name" disabled>
                        </div>
                        <div class="col-md-6">
                           <label> Last Name </label>
                           <input type="text" name="name" disabled>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <label> Mobile Number </label>
                           <input type="text" name="name" disabled>
                        </div>
                        <div class="col-md-6">
                           <label> Email Address </label>
                           <input type="mail" name="name" disabled>
                        </div>
                     </div>
                     <div class="row">
                      
                        <div class="col-md-6">
                           <label> Assign Teams </label>
                           <label class="sd">
                              <select disabled>
                                 <option> </option> 
                                 <option> Assign Role </option>
                                 <option> Assign Role </option>
                              </select>
                              <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon"> 
                           </label>
                         
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 text-end">
                        <a href="{{ url('/coach-index') }}" class="btn gry-btn"> Cancel </a>
                           <!-- <button type="submit" class="btn drk-btn"> Submit </button> -->
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
   $(document).ready(function() {
      $('.coach-list').change(function()
    {
      var option_id = $(this).val();
      window.location.href = "{{URL::to('/coach-edit')}}?id="+option_id;

    });
      
   });
</script> 