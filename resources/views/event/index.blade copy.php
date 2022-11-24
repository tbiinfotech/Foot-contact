@include('header')
@include('side-bar')
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css'>
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css'>
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css'>
<style>
   .head_top {
    margin-top: -23px;
}
.fc .fc-toolbar.fc-header-toolbar {
    margin-bottom: 1.5em;
    margin-top: -20px;
}
.eve_mng .nuro:first-child {
    padding-right: 0px;
    margin-top: -15px;
}

.col.sec_cont table td:last-child {
    /* display: flex; */
    padding: 0px 0px;
    /* align-items: center; */
    /* height: 25%; */
}
   form .eve_mng {
    background-color: #fff;
    padding: 28px 0;
    border-radius: 10px;
    margin-top: -23px;
}
html, body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}
#calendar {
  max-width: 900px;
  margin: 40px auto;
}

.fc .fc-button-primary:not(:disabled).fc-button-active, .fc .fc-button-primary:not(:disabled):active {
    color: #fff;
    color: var(--fc-button-text-color,#fff);
    background-color: #6B1687;
    background-color: #6B1687;
    border-color: #fff;
    border-color: var(--fc-button-active-border-color,#fff);
}
.fc .fc-button-primary {
    color: #fff;
    color: var(--fc-button-text-color,#fff);
    background-color: #6B1687;
    background-color: var(--fc-button-bg-color,#6B1687);
    border-color: #fff;
    border-color: var(--fc-button-border-color,#fff);
}
.fc-timeGrid-view .fc-day-grid .fc-row .fc-content-skeleton {
    padding-bottom: 1em;
    display: none;
}
.newheading{
    color: #0000;
}
.eve_mng .nuro ul li{
   background-color:#fff;
   border:none
}
</style>
<div class="col sec_cont">
   <form>
      <div class="row">
         <div class="head_top">
            <h1> Event Management </h1>
            <div class="ri-year">
               <!-- <label class="sd">
                  <select>
                     <option> Year </option>
                     <option> 1995 </option>
                     <option> 2000 </option>
                     <option> 2005 </option>
                     <option> 2010 </option>
                     <option> 2015 </option>
                     <option> 2020 </option>
                  </select>
                  <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
               </label> -->
               <a type="button" href="{{ route('event-add') }}" class="btn drk-btn">
                  + Create Event
               </a>

               <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                     <div class="modal-content">
                        <div class="modal-header cross_bi">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <img src="{{ asset('theme/assets/images/banner-popup.png') }}" alt="bannerpop">
                           <div class="row vs_mtc">
                              <div class="col-md-8">
                                 <ul>
                                    <li> <img src="{{ asset('theme/assets/images/image-log.png') }}" alt="imglog"> <span> ASSOA </span> </li>
                                    <li> <span> VS </span> </li>
                                    <li> <img src="{{ asset('theme/assets/images/bo-log.png') }}" alt="bolog"> <span> Bobigny </span> </li>
                              </div>
                              <div class="col-md-4 text-end">
                                 <a href="#" class="view-pr"> +Add Notes </a>
                              </div>
                           </div>

                           <div class="league-details">
                              <div class="row">
                                 <h4>U16 - League</h4>
                                 <div class="col-md-3 col-6">
                                    <p>Fixture Time</p>
                                    <label> <img src="{{ asset('theme/assets/images/time.svg') }}" alt="tme"> 08:00 </label>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <p>End Time</p>
                                    <label> <img src="{{ asset('theme/assets/images/time.svg') }}" alt="tme"> 09:30 </label>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <p>Date</p>
                                    <label> <img src="{{ asset('theme/assets/images/time.svg') }}" alt="tme"> 10 June, 2022 </label>
                                 </div>
                                 <div class="col-md-3 col-6">
                                    <p>Appointment Time</p>
                                    <label> <img src="{{ asset('theme/assets/images/time.svg') }}" alt="tme"> 07:30 </label>
                                 </div>
                                 <div class="col-12">
                                    <p>Address</p>
                                    <label> <img src="{{ asset('theme/assets/images/Location.svg') }}" alt="tme"> Terrain d'honneur, Rue Rossini, 95280 Jouy-le-Moutier, France <a href="#"> View on Map </a> </label>
                                 </div>
                                 <div class="col-12">
                                    <p>Additional Information</p>
                                    <label> One Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, </label>
                                 </div>
                              </div>
                           </div>

                           <div class="sor_ting">
                              <div class="row">
                                 <div class="col-6 text-start">
                                    <h2> Player Details </h2>
                                 </div>
                                 <div class="col-6 text-end">
                                    <button type="submit"> <img src="{{ asset('theme/assets/images/Vector.svg') }}" alt="sort"> Sort </submit>
                                 </div>
                              </div>
                           </div>

                           <div class="row plyr-dtl">
                              <ul>
                                 <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one"> <span>Sofiane Benamar </br><img src="{{ asset('theme/assets/images/dashicons_car.svg') }}" alt="imgdash"> <span> </li>
                                 <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one"> <span>Sofiane Benamar </br><img src="{{ asset('theme/assets/images/dashicons_car.svg') }}" alt="imgdash"> <span> </li>
                                 <li> <img src="{{ asset('theme/assets/images/3.png') }}" alt="three">Rayan Jouani</li>
                                 <li><img src="{{ asset('theme/assets/images/4.png') }}" alt="four">Raphaël De Abreu</li>
                                 <li><img src="{{ asset('theme/assets/images/1.png') }}" alt="five">Mathis Beauregard</li>
                                 <li> <img src="{{ asset('theme/assets/images/1.png') }}" alt="one"> <span>Sofiane Benamar </br><img src="{{ asset('theme/assets/images/dashicons_car.svg') }}" alt="imgdash"> <span> </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="add_coach eve_mng">
            <form action="/action_page.php">
               <ul class="nav nav-tabs nuro" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                     <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Match </button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Training</button>
                  </li>
                  <li class="nav-item" role="presentation">
                     <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">General Event</button>
                  </li>
               </ul>
               <ul class="nuro justify-content-end">
                  <!-- <li class="">
                     <div class="dropdown-center">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           By Group
                        </button>
                        <div class="dropdown-menu">
                           <div><a class="dropdown-item" href="#">Senior 1</a></div>
                           <div><a class="dropdown-item" href="#">Senior 2</a></div>
                           <div><a class="dropdown-item" href="#">U18 1</a></div>
                           <div><a class="dropdown-item" href="#">U16 1</a></div>
                           <div><a class="dropdown-item" href="#">U16 2</a></div>
                        </div>
                     </div>
                  </li> -->
                  <li class="nav-item dropdown">
                     <label class="sd">
                     </label>
                  </li>
                  <ul>
                     <li></li>
                     <li></li>
                  </ul>
               </ul>
               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                  <h1 style="text-align: center" class="newheading">Intercept 'prev' and 'next' buttons</h1>
   
                  <div id='calendar2'></div>
                  </div>
                  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                  <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                  <h1 style="text-align: center" class="newheading">Intercept 'prev' and 'next' buttons</h1>
   
                  <div id='calendar3'></div>
                  </div>
                  </div>
                  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                  <div class="tab-pane fade show active" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                  <h1 style="text-align: center" class="newheading">Intercept 'prev' and 'next' buttons</h1>
   
                  <div id='calendar'></div>
                  </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </form>
</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
<script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js'></script>
      <script id="rendered-js" >
document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');
  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: ['dayGrid', 'timeGrid'],
    events:<?php echo json_encode($match); ?>,
    header: {
      left: 'dayGridMonth,timeGridWeek',
      center: 'title',
      right: 'prev,next' },
    footer: {
      left: '',
      center: '',
      right: 'prev,next' },
    customButtons: {
      prev: {
        text: 'Prev',
        click: function () {
          
          calendar.prev();
          
        } },
      next: {
        text: 'Next',
        click: function () {
       
          calendar.next();
       
        } } } });
  calendar.render();
});
  // 2nd
  document.addEventListener('DOMContentLoaded', function () {

  var calendarE2 = document.getElementById('calendar2');
  var calendar2 = new FullCalendar.Calendar(calendarE2, {
    plugins: ['dayGrid', 'timeGrid'],
    events:<?php echo json_encode($traning); ?>,
    header: {
      left: 'dayGridMonth,timeGridWeek',
      center: 'title',
      right: 'prev,next' },
    footer: {
      left: '',
      center: '',
      right: 'prev,next' },
    customButtons: {
      prev: {
        text: 'Prev',
        click: function () {
          
          calendar2.prev();
          
        } },
      next: {
        text: 'Next',
        click: function () {
       
          calendar2.next();
       
        } } } });
  calendar2.render();
});
// 3nd
document.addEventListener('DOMContentLoaded', function () {

var calendarE3 = document.getElementById('calendar3');
  var calendar3 = new FullCalendar.Calendar(calendarE3, {
    plugins: ['dayGrid', 'timeGrid'],
    events:<?php echo json_encode($event); ?>,
    header: {
      left: 'dayGridMonth,timeGridWeek',
      center: 'title',
      right: 'prev,next' },
    footer: {
      left: '',
      center: '',
      right: 'prev,next' },
    customButtons: {
      prev: {
        text: 'Prev',
        click: function () {
          
          calendar3.prev();
          
        } },
      next: {
        text: 'Next',
        click: function () {
       
          calendar3.next();
       
        } } } });
  calendar3.render();
});
</script>
<style>
 html, body {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
  font-size: 14px;
}

#calendar {
  max-width: 900px;
  margin: 40px auto;
}
</style>
</body>

</html>