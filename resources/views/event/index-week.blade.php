@include('header')
@include('side-bar')
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
                        <select>
                           <option> Jan </option>
                           <option> Fab </option>
                           <option> March </option>
                           <option> April </option>
                           <option> May </option>
                           <option> June </option>
                           <option> July </option>
                           <option> August </option>
                           <option> September </option>
                           <option> October </option>
                           <option> November </option>
                           <option> December </option>
                        </select>
                        <img src="{{ asset('theme/assets/images/Polygon.svg') }}" alt="Polygon">
                     </label>
                  </li>
                  <ul>
                     <li><a href="#"><img src="{{ asset('theme/assets/images/white-calendar.svg') }}" alt="whitecalender"> </a></li>
                     <li><a href="#"><img src="{{ asset('theme/assets/images/eva_list-outline.svg') }}" alt="eva_list"></a></li>
                  </ul>
               </ul>
               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                     <div id='calendar'></div>
                  </div>
                  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">b</div>
                  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">c</div>
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
<script>
   document.addEventListener('DOMContentLoaded', function() {
     
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
         timeZone: 'UTC',
         initialView: 'timeGridWeek',
         headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,timeGridDay'
         },
        
            events:<?php echo json_encode($event); ?>
        
      });

      calendar.render();
   });
</script>
<style>
   #calendar {
      max-width: 1100px;
      margin: 40px auto;
   }

   .fc .fc-toolbar {
      width: 100%;
      align-items: center;
      justify-content: space-between;
   }

   .fc {
      width: 100%;
   }

   #calendar {
      max-width: 100%;
      margin: 0;
      margin-top: 70px;
   }

   .fc .fc-timegrid-slot {
      height: 4.5em;
   }

   table.fc-scrollgrid-sync-table {
      display: none;
   }

   .fc .fc-timegrid-divider {
      padding: 0;
      border: 0;
   }

   table.fc-col-header th {
      padding: 26px 0;
      border-bottom: 0;
   }

   table.fc-col-header th a {
      text-decoration: none;
      color: #4C4C4C;
      font-size: 16px;
      font-family: 'Outfit-SemiBold';
   }

   .fc-header-toolbar.fc-toolbar.fc-toolbar-ltr {
      display: none;
   }

   .fc .fc-scroller::-webkit-scrollbar {
      width: 6px;
   }

   .fc .fc-scroller::-webkit-scrollbar-track {
      background: #f1f1f1;
   }

   .fc .fc-scroller::-webkit-scrollbar-thumb {
      background: #ddd;
   }

   .fc .fc-scroller::-webkit-scrollbar-thumb:hover {
      background: #999;
   }

   .fc-theme-standard .fc-scrollgrid {
      border-left: 0;
      border-right: 0;
   }

   .fc-theme-standard td,
   .fc-theme-standard th {
      border: 1px solid #eee;
   }
</style>
</body>

</html>