@include('header')
@include('side-bar')
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.css'>
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.css'>
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.css'>
<link rel='stylesheet' href='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.css'>

<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css'>
<style>
   .head_top {
      margin-top: -23px;
   }

   .fc .fc-toolbar.fc-header-toolbar {
      margin-bottom: 1.5em;
      margin-top: -6px;
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
   #match_listing .fc-toolbar.fc-header-toolbar .fc-left {
    padding-left: 170px;
}
div#home-tab-pane i#blue-list-match {
    left: 0px;
}
div#home-tab-pane i#grey-calander-match {
    left: 40px;
}
.tab-pane .match_icon_listing, .tab-pane .training_icon_listing, .tab-pane .event_icon_listing {
    top: 54.5px;
}
i#blue-calander-match {
    top: 53.5px;
}
   html,
   body {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
   }

   #calendar {
      max-width: 900px;
      margin: 40px auto;
   }

   .fc .fc-button-primary:not(:disabled).fc-button-active,
   .fc .fc-button-primary:not(:disabled):active {
      color: #fff;
      color: var(--fc-button-text-color, #fff);
      background-color: #6B1687;
      background-color: #6B1687;
      border-color: #fff;
      border-color: var(--fc-button-active-border-color, #fff);
   }

   .fc .fc-button-primary {
      color: #fff;
      color: var(--fc-button-text-color, #fff);
      background-color: #6B1687;
      background-color: var(--fc-button-bg-color, #6B1687);
      border-color: #fff;
      border-color: var(--fc-button-border-color, #fff);
   }

   .fc-timeGrid-view .fc-day-grid .fc-row .fc-content-skeleton {
      padding-bottom: 1em;
      display: none;
   }


   .eve_mng .nuro ul li {
      background-color: #fff;
      border: none
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
                  <i class="fa fa-list" aria-hidden="true"></i>

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
                     <!-- List -->
                     <i class="fa fa-list match_icon_listing" id="grey-list-match"> <img src="{{ asset('theme/assets/images/list-grey.png') }}"  alt="one"></i>
                     <i class="fa fa-list match_icon_listing" id="blue-list-match"> <img src="{{ asset('theme/assets/images/list-blue.png') }}" alt="one"></i>
                     <!-- Match -->
                     <i class="fa fa-list match_icon_calendar" id="grey-calander-match"> <img src="{{ asset('theme/assets/images/calander-grey.png') }}" alt="one"></i>
                     <i class="fa fa-list match_icon_calendar" id="blue-calander-match"> <img src="{{ asset('theme/assets/images/calander-blue.png') }}" alt="one"></i>

                     <h1 style="text-align: center" class="newheading" id="match">Match</h1>

                     <div id='match_calendar'></div>
                     <div id='match_listing'>
                     </div>

                  </div>
                  <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                     <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <!-- List -->
                        <i class="fa fa-list training_icon_listing" id="grey-list-training"><img src="{{ asset('theme/assets/images/list-grey.png') }}" alt="one"></i>
                        <i class="fa fa-list training_icon_listing" id="blue-list-training"><img src="{{ asset('theme/assets/images/list-blue.png') }}" alt="one"></i>
                        <!-- Match -->
                        <i class="fa fa-list training_icon_calendar" id="grey-calander-training"><img src="{{ asset('theme/assets/images/calander-grey.png') }}" alt="one"></i>
                        <i class="fa fa-list training_icon_calendar" id="blue-calander-training"> <img src="{{ asset('theme/assets/images/calander-blue.png') }}" alt="one"></i>
                        <h1 style="text-align: center" class="newheading" id="traning">Training</h1>
                        <div id='training_calendar'></div>
                        <div id='training_listing'></div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                     <div class="tab-pane fade show active" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                        <!-- List -->
                        <i class="fa fa-list event_icon_listing" id="grey-list-event"><img src="{{ asset('theme/assets/images/list-grey.png') }}" alt="one"></i>
                        <i class="fa fa-list event_icon_listing" id="blue-list-event"><img src="{{ asset('theme/assets/images/list-blue.png') }}" alt="one"></i>
                        <!-- Match -->
                        <i class="fa fa-list event_icon_calendar" id="grey-calander-event"><img src="{{ asset('theme/assets/images/calander-grey.png') }}" alt="one"></i>
                        <i class="fa fa-list event_icon_calendar" id="blue-calander-event"><img src="{{ asset('theme/assets/images/calander-blue.png') }}" alt="one"></i>

                        <h1 style="text-align: center" class="newheading" id="event">Event</h1>
                        <div id='event_calendar'></div>
                        <div id='event_listing'></div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </form>
   <div id="listModal" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <table class="fc-list-table">
                  <tbody>
                     <tr class="fc-list-heading">
                        <td class="fc-widget-header">
                           <span class="fc-list-heading-main">Monday</span>
                        </td>
                     </tr>
                     <tr class="fc-list-item">
                        <td class="fc-list-item-time fc-widget-content">04:04 PM</td>
                        <td class="fc-list-item-marker fc-widget-content"><span class="fc-event-dot">
                           </span></td>

                        <td class="fc-list-item-title fc-widget-content"><a>test</a></td>

                     </tr>
                  </tbody>
               </table>
            </div>

         </div>
      </div>
   </div>
   

</div>
</div>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.js"></script>
<script src='https://unpkg.com/@fullcalendar/core@4.4.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/daygrid@4.4.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/timegrid@4.4.0/main.min.js'></script>
<script src='https://unpkg.com/@fullcalendar/list@4.4.0/main.min.js'></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js'></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<!-- interaction plugin must be included after core -->
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js"></script>

<script id="rendered-js">
   $(document).ready(function() {
      /*event calendar*/
      $("#event_listing").hide();
      $("#match_listing").hide();
      $("#training_listing").hide();
      //match
      $("#blue-list-match").hide();
      $("#grey-calander-match").hide();
      //traning
      $("#blue-list-training").hide();
      $("#grey-calander-training").hide();
      //event
      $("#blue-list-event").hide();
      $("#grey-calander-event").hide();

      //event
      $(".event_icon_listing").click(function() {
         $("#event_listing").show();
         $("#event_calendar").hide();
         $("#blue-list-event").show();
         $("#grey-list-event").hide();
         $("#grey-calander-event").show();
         $("#blue-calander-event").hide();
      });

      $(".event_icon_calendar").click(function() {
         $("#event_listing").hide();
         $("#event_calendar").show();
         $("#blue-list-event").hide();
         $("#grey-list-event").show();
         $("#grey-calander-event").hide();
         $("#blue-calander-event").show();
      });

      /*match calendar*/

      $(".match_icon_listing").click(function() {
         $("#match_listing").show();
         $("#match_calendar").hide();
         $("#blue-list-match").show();
         $("#grey-list-match").hide();
         $("#grey-calander-match").show();
         $("#blue-calander-match").hide();
      });

      $(".match_icon_calendar").click(function() {
         $("#match_listing").hide();
         $("#match_calendar").show();
         $("#blue-list-match").hide();
         $("#grey-list-match").show();
         $("#grey-calander-match").hide();
         $("#blue-calander-match").show();
      });
      // /****** */

      /*training calendar*/

      $(".training_icon_listing").click(function() {
         $("#training_listing").show();
         $("#training_calendar").hide();
         $("#blue-list-training").show();
         $("#grey-list-training").hide();
         $("#grey-calander-training").show();
         $("#blue-calander-training").hide();
      });

      $(".training_icon_calendar").click(function() {
         $("#training_listing").hide();
         $("#training_calendar").show();
         $("#blue-list-training").hide();
         $("#grey-list-training").show();
         $("#grey-calander-training").hide();
         $("#blue-calander-training").show();
      });
      /****** */

      /****** */
      // $("#profile-tab").click(function() {
      //    alert('test'); 
      //    $("#training_calendar").show();
      // });
   });
   //event
   document.addEventListener('DOMContentLoaded', function() {

      var event_calendar = document.getElementById('event_calendar');
      var calendar_event = new FullCalendar.Calendar(event_calendar, {
         plugins: ['dayGrid', 'timeGrid'],
         events: <?php echo json_encode($event); ?>,
         eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
         },
         header: {
            left: 'dayGridMonth,timeGridWeek',
            center: 'title',
            right: 'prev,next'
         },
         eventClick: function(info) {
            // $('fc-day').click(function() {
            var eventDate = info.event.start;
            var final_date = moment(eventDate).format("YYYY-MM-DD")
            $("#event_listing").show();
            $("#event_calendar").hide();
            $("#blue-list-event").show();
            $("#grey-list-event").hide();
            $("#grey-calander-event").show();
            $("#blue-calander-event").hide();
            var event_listing = document.getElementById('event_listing');
            var default_Date = $('#hidden_input').val();
            var listing_event = new FullCalendar.Calendar(event_listing, {
               plugins: ['list'],
               timeZone: 'UTC',
               defaultView: 'listDay',

               defaultDate: final_date,
               // customize the button names,  
               // otherwise they'd all just say "list"
               views: {
                  listDay: {
                     buttonText: 'list day'
                  },
                  listWeek: {
                     buttonText: 'list week'
                  },
                  listMonth: {
                     buttonText: 'list month'
                  }
               },

               header: {
                  left: 'title',
                  center: '',
                  right: 'listDay,listWeek,listMonth'
               },
               events: <?php echo json_encode($event); ?>,
               eventTimeFormat: {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
               },
            });
            listing_event.render();
         },
         footer: {
            left: '',
            center: '',
            right: 'prev,next'
         },
         customButtons: {
            prev: {
               text: 'Prev',
               click: function() {

                  calendar_event.prev();

               }
            },
            next: {
               text: 'Next',
               click: function() {

                  calendar_event.next();

               }
            }
         }
      });
      calendar_event.render();
   });
   // match calendar
   // 2nd
   document.addEventListener('DOMContentLoaded', function() {
      var match_calendar = document.getElementById('match_calendar');
      var calendar_match = new FullCalendar.Calendar(match_calendar, {
         plugins: ['dayGrid', 'timeGrid'],
         events: <?php echo json_encode($match); ?>,
         eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
         },
         header: {
            left: 'dayGridMonth,timeGridWeek',
            center: 'title',
            right: 'prev,next'
         },
         dateClick: function(info) {
            alert("dateClick");
         },
         eventClick: function(info) {
            // $('fc-day').click(function() {
            var eventDate = info.event.start;
            var final_date = moment(eventDate).format("YYYY-MM-DD")
            $("#match_listing").show();
            $("#match_calendar").hide();
            $("#blue-list-match").show();
            $("#grey-list-match").hide();
            $("#grey-calander-match").show();
            $("#blue-calander-match").hide();
            var match_listing = document.getElementById('match_listing');
            var default_Date = $('#hidden_input').val();
            // console.log(default_Date,'sdfsdf')
            var listing_match = new FullCalendar.Calendar(match_listing, {
               plugins: ['list'],
               timeZone: 'UTC',
               defaultView: 'listDay',

               defaultDate: final_date,
               // customize the button names,
               // otherwise they'd all just say "list"
               views: {
                  listDay: {
                     buttonText: 'list day'
                  },
                  listWeek: {
                     buttonText: 'list week'
                  },
                  listMonth: {
                     buttonText: 'list month'
                  }
               },

               header: {
                  left: 'title',
                  center: '',
                  right: 'listDay,listWeek,listMonth'
               },
               events: <?php echo json_encode($match); ?>,
               eventTimeFormat: {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
               },
            });
            listing_match.render();
            // });
         },
         footer: {
            left: '',
            center: '',
            right: 'prev,next'
         },
         customButtons: {
            prev: {
               text: 'Prev',
               click: function() {

                  calendar_match.prev();

               }
            },
            next: {
               text: 'Next',
               click: function() {

                  calendar_match.next();

               }
            }
         }
      });
      calendar_match.render();
   });


   // Traning
   document.addEventListener('DOMContentLoaded', function() {
      var training_calendar = document.getElementById('training_calendar');
      var calendar_training = new FullCalendar.Calendar(training_calendar, {
         plugins: ['dayGrid', 'timeGrid'],
         events: <?php echo json_encode($traning); ?>,
         eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
         },
         header: {
            left: 'dayGridMonth,timeGridWeek',
            center: 'title',
            right: 'prev,next'
         },
         eventClick: function(info) {
            var eventDate = info.event.start;
            var final_date = moment(eventDate).format("YYYY-MM-DD")
            $("#training_listing").show();
            $("#training_calendar").hide();
            $("#blue-list-training").show();
            $("#grey-list-training").hide();
            $("#grey-calander-training").show();
            $("#blue-calander-training").hide();
            var training_listing = document.getElementById('training_listing');
            var default_Date = $('#hidden_input').val();
            // console.log(default_Date,'sdfsdf')
            var listing_training = new FullCalendar.Calendar(training_listing, {
               plugins: ['list'],
               timeZone: 'UTC',
               defaultView: 'listDay',

               defaultDate: final_date,
               // customize the button names,
               // otherwise they'd all just say "list"
               views: {
                  listDay: {
                     buttonText: 'list day'
                  },
                  listWeek: {
                     buttonText: 'list week'
                  },
                  listMonth: {
                     buttonText: 'list month'
                  }
               },

               header: {
                  left: 'title',
                  center: '',
                  right: 'listDay,listWeek,listMonth'
               },
               events: <?php echo json_encode($traning); ?>,
               eventTimeFormat: {
                  hour: '2-digit',
                  minute: '2-digit',
                  hour12: true
               },
            });
            listing_training.render();
         },
         footer: {
            left: '',
            center: '',
            right: 'prev,next'
         },
         customButtons: {
            prev: {
               text: 'Prev',
               click: function() {

                  calendar_training.prev();

               }
            },
            next: {
               text: 'Next',
               click: function() {

                  calendar_training.next();

               }
            }
         }
      });
      calendar_training.render();
   });
   
   //listing of traning

   document.addEventListener('DOMContentLoaded', function() {

      var training_listing = document.getElementById('training_listing');
      var listing_training = new FullCalendar.Calendar(training_listing, {
         plugins: ['list'],
         timeZone: 'UTC',
         defaultView: 'listWeek',

         // customize the button names,
         // otherwise they'd all just say "list"
         views: {
            listDay: {
               buttonText: 'list day'
            },
            listWeek: {
               buttonText: 'list week'
            },
            listMonth: {
               buttonText: 'list month'
            }
         },

         header: {
            left: 'title',
            center: '',
            right: 'listDay,listWeek,listMonth'
         },
         events: <?php echo json_encode($traning); ?>
      });
      listing_training.render();
   });
   //listing of match

   document.addEventListener('DOMContentLoaded', function() {

      var match_listing = document.getElementById('match_listing');
      var listing_match = new FullCalendar.Calendar(match_listing, {
         plugins: ['list'],
         timeZone: 'UTC',
         defaultView: 'listWeek',

         // customize the button names,
         // otherwise they'd all just say "list"
         views: {
            listDay: {
               buttonText: 'list day'
            },
            listWeek: {
               buttonText: 'list week'
            },
            listMonth: {
               buttonText: 'list month'
            }
         },

         header: {
            left: 'title',
            center: '',
            right: 'listDay,listWeek,listMonth'
         },
         events: <?php echo json_encode($match); ?>
      });
      listing_match.render();
   });
   //listing of event

   document.addEventListener('DOMContentLoaded', function() {

      var event_listing = document.getElementById('event_listing');
      var listing_event = new FullCalendar.Calendar(event_listing, {
         plugins: ['list'],
         timeZone: 'UTC',
         defaultView: 'listWeek',

         // customize the button names,
         // otherwise they'd all just say "list"
         views: {
            listDay: {
               buttonText: 'list day'
            },
            listWeek: {
               buttonText: 'list week'
            },
            listMonth: {
               buttonText: 'list month'
            }
         },

         header: {
            left: 'title',
            center: '',
            right: 'listDay,listWeek,listMonth'
         },
         events: <?php echo json_encode($event); ?>
      });
      listing_event.render();
   });
</script>
<style>
   html,
   body {
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