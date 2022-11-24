@include('header')
@include('side-bar')


			<div class="col sec_cont">
			@if(Auth::user()->role_id == "2")
				<div class="row">
					<h1> Dashboard </h1>
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Icon1.svg') }}" alt="iconone">
							<h2>{{ $users }}<span>Players</span></h2>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Group2.svg') }}" alt="iconone">
							<h2>{{ $active_users }}<span>Active Players</span></h2>
						</div>
					</div>
				
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Group4.svg') }}" alt="iconone">
							<h2>{{ $coach }}<span>Coaches</span></h2>
						</div>
					</div>
				</div>
				@else
				<div class="row">
					<h1> Dashboard </h1>
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Dashboard1.svg') }}" alt="iconone">
							<h2>{{ $users }}<span>Players</span></h2>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Dashboard2.svg') }}" alt="iconone">
							<h2>{{ $active_users }}<span>Active Players</span></h2>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Dashboard3.svg') }}" alt="iconone">
							<h2>{{ $club }}<span>Clubs</span></h2>
						</div>
					</div>
					<div class="col-xl-3 col-md-6 col-12 ico">
						<div class="box_flex">
							<img src="{{ asset('theme/assets/images/Dashboard4.svg') }}" alt="iconone">
							<h2>{{ $coach }}<span>Coaches</span></h2>
						</div>
					</div>
				</div>
				@endif

				@if(Auth::user()->role_id == "2")
				<div class="up_event">
					<div class="row">
						<div class="col-xl-6 col-12">
							<h2>Upcoming Events</h2>
							@foreach($upcoming_events as $upcoming_event)

							@if($upcoming_event->event_type_id==1)
							<div class="event_list G_ent upcoming_ev">
								@elseif($upcoming_event->event_type_id==2)
								<div class="event_list O_ent upcoming_ev">
									@else
									<div class="event_list B_ent upcoming_ev">
										@endif

										<div class="date_time">
											<img src="{{ asset('theme/assets/images/Calendar.svg') }}" alt="calender"> <span>{{date("d M, Y", strtotime($upcoming_event->date))}}</span>
											<img src="{{ asset('theme/assets/images/bistel.svg') }}" alt="bistel"> <span>{{date("H:i", strtotime($upcoming_event->appointment_time))}}</span>
										</div>
										<div class="league">
											<!-- match type -->
											@if($upcoming_event->match_type_id == 1)
											<span>League</span>
											@elseif($upcoming_event->match_type_id == 2)
											<span>Cup Game</span>
											@elseif($upcoming_event->match_type_id == 3)
											<span>Friendly</span>
											@endif
											<!-- Event type -->
											@if($upcoming_event->match_type_id == 1)
											<img src="{{ asset('theme/assets/images/green-football.svg') }}" alt="football">
											@elseif($upcoming_event->match_type_id == 2)
											<img src="{{ asset('theme/assets/images/Group_41.png') }}" alt="football">
											@elseif($upcoming_event->match_type_id == 3)
											<img src="{{ asset('theme/assets/images/Calendar-group.svg') }}" alt="football">
											@endif
										</div>
										<ul>
											<li>U16 <img src="{{ asset('theme/assets/images/Number-rank.svg') }}" alt="rank"></li>
											<li class="score no_bg"><strong>-</strong></li>
											<li>{{$upcoming_event->opponentTeam($upcoming_event->opponent_team)}}</li>
										</ul>
										
									</div>
									@endforeach
									<!-- <a href="#"> View All listing </a> -->
								</div>


								<!----------------- Right side area --------------------->
								<div class="col-xl-6 col-12">
									<h2>Recent Events</h2>
									<!---  box --->
									@foreach($recent_events as $recent_event)
									@if($recent_event->event_type_id==1)
									<div class="event_list G_ent upcoming_ev">
										@elseif($recent_event->event_type_id==2)
										<div class="event_list O_ent upcoming_ev">
											@else
											<div class="event_list B_ent upcoming_ev">
												@endif
												<div class="date_time">
													<img src="{{ asset('theme/assets/images/Calendar.svg') }}" alt="calender"> <span>{{date("d M, Y", strtotime($recent_event->date))}}</span>
													<img src="{{ asset('theme/assets/images/bistel.svg') }}" alt="bistel"> <span>{{date("H:i", strtotime($recent_event->date))}}</span>
												</div>
												<div class="league">
													<!-- match type -->
													@if($recent_event->match_type_id == 1)
													<span>League</span>
													@elseif($recent_event->match_type_id == 2)
													<span>Cup Game</span>
													@elseif($recent_event->match_type_id == 3)
													<span>Friendly</span>
													@endif
													<!-- event type -->
													@if($recent_event->match_type_id == 1)
													<img src="{{ asset('theme/assets/images/green-football.svg') }}" alt="football">
													@elseif($recent_event->match_type_id == 2)
													<img src="{{ asset('theme/assets/images/Group_41.png') }}" alt="football">
													@elseif($recent_event->match_type_id == 3)
													<img src="{{ asset('theme/assets/images/Calendar-group.svg') }}" alt="football">
													@endif
												</div>

												<ul>
													<li> U16 <img src="{{ asset('theme/assets/images/Number-rank.svg') }}" alt="rank"></li>
													<li class="score no_bg"><strong>-</strong></li>
													<li>{{$recent_event->opponentTeam($recent_event->opponent_team)}}</li>
												</ul>
												
											</div> 
											@endforeach
											<!-- <a href="#"> View All listing </a> -->
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> @endif
					<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
</body>

</html>

 