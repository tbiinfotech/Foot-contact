@include('header')
@include('side-bar')
<style>
   .input-container input {
      border: none;
      box-sizing: border-box;
      outline: 0;
      padding: .75rem;
      position: relative;
      width: 100%;
   }

   input[type="date"]::-webkit-calendar-picker-indicator {
      background: transparent;
      bottom: 0;
      color: transparent;
      cursor: pointer;
      height: auto;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      width: auto;
   }
</style>

<script>
   var timepicker = new TimePicker('time', {
      lang: 'en',
      theme: 'dark'
   });
   timepicker.on('change', function(evt) {

      var value = (evt.hour || '00') + ':' + (evt.minute || '00');
      evt.element.value = value;

   });
</script>
<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet" />

<div class="col sec_cont">
   <div class="row">
      <div class="head_top">
         <h1> Event Management </h1>
         <a class="btn back_btn" href="#" role="button"> Back </a>
      </div>
      <div class="sp_rd add_coach eve_mng">
         <form method="POST" enctype="multipart/form-data" action="{{ route('event-create') }}">

            <div class="row">
               <label>Event Type</label>
               <div class="col-md-4 col-xl-2">
                  <label class="tair event_type">
                     <span> <img src="{{ asset('theme/assets/images/event1.svg') }}" alt="event"></br>
                        Match </span>
                     <input type="radio" name="event_type_id" value="1" checked>
                     <span class="mak"></span>
                  </label>
               </div>

               <div class="col-md-4 col-xl-2">
                  <label class="tair event_type">
                     <img src="{{ asset('theme/assets/images/event2.svg') }}" alt="event"></br>
                     Training<input type="radio" name="event_type_id" value="2">
                     <span class="mak"></span>
                  </label>
               </div>

               <div class="col-md-4 col-xl-2">
                  <label class="tair event_type">
                     <img src="{{ asset('theme/assets/images/event3.svg') }}" alt="event"></br>
                     General Event<input type="radio" name="event_type_id" value="3">
                     <span class="mak"></span>
                  </label>
               </div>
            </div>
            <div class="row">
               <label>Match Type</label>
               <div class="col-md-4">
                  <label class="tair match_type">
                     <input type="radio" name="match_type_id" value="1" checked>
                     <span class="mak"> League </span>
                  </label>
               </div>
               <div class="col-md-4">
                  <label class="tair match_type">
                     <input type="radio" name="match_type_id" value="2">
                     <span class="mak"> Cup Game </span>
                  </label>
               </div>
               <div class="col-md-4">
                  <label class="tair match_type">
                     <input type="radio" name="match_type_id" value="3">
                     <span class="mak"> Friendly </span>
                  </label>
               </div>
            </div>
            <div class="row">
               <label>Choice</label>
               <div class="col-md-4">
                  <label class="tair match_type">
                     <input type="radio" name="is_home" value="1" checked>
                     <span class="mak"> Home </span>
                  </label>
               </div>
               <div class="col-md-4">
                  <label class="tair match_type">
                     <input type="radio" name="is_home" value="2">
                     <span class="mak"> Away </span>
                  </label>
               </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                  <h4>Background Image</h4>

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
            </div>
            <div class="row">


           
               <div class="col-md-12">
                  <label>Title</label>
                  <input type="text" name="title" id="title">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label>Team</label>
                  <label class="sd">
                     <select id="opponent_team" name="opponent_team">
                        <option value=0>Select Team</option>
                        @foreach($team as $teams)
                        <option value={{ $teams->id }}>{{ $teams->team_name }}</option>
                        @endforeach
                     </select>
                     <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                  </label>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label>Date </label>
                  <label class="sd dt">
                     <input type="date" name="date" id="date" class="date" onfocus="(this.type = 'date')" min="<?= date("Y-m-d") ?>" placeholder="MM/DD/YYYY">
                     <img src="{{ asset('theme/assets/images/Calendar.svg') }}" alt="Polygon">
                  </label>
               </div>
               <div class="col-md-6">
                  <label> Recurrent</label>
                  <label class="sd">
                     <select id="recurrent" name="recurrent">
                        <option> </option>
                        <option value="1"> Yes </option>
                        <option value="2"> No </option>
                     </select>
                     <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                  </label>
               </div>
            </div>
          
            <div class="row">
               <div class="col-md-6">
                  <label> Fixture Time </label>
                  <label class="sd dt">
                     <input type="time" id="fixture_time" name="fixture_time" min="00:00" max="23:59">
                     <img src="{{ asset('theme/assets/images/time.svg') }}" alt="Polygon">
                  </label>
               </div>
               <div class="col-md-6">
                  <label> End Time </label>
                  <label class="sd dt">
                     <input type="time" id="end_time" name="end_time" id="end_time" min="00:00" max="23:59">
                     <img src="{{ asset('theme/assets/images/time.svg') }}" alt="Polygon">
                  </label>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <label> Appointment Time </label>
                  <label class="sd dt">
                     <input type="time" id="appointment_time" name="appointment_time" min="00:00" max="23:59">
                     <img src="{{ asset('theme/assets/images/time.svg') }}" alt="Polygon">
                  </label>
               </div>
            
            </div>
            <div class="row">
               <div class="col-12">
                  <label> Address </label>
                  <input type="text" name="address" id="address">
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <label> Additional Information </label>
                  <textarea name="additional_info" id="additional_info" rows="4" cols="50"></textarea>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-end">
                  <button type="submit" class="btn drk-btn"> Submit </button>
                  <!-- <a href="{{ url('/event-player') }}" class="btn drk-btn"> Select Players </a> -->
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
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
</body>

</html>