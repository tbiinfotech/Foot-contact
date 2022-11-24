<?php

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @if(Auth::user()->role_id == "2")
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style.css') }}">
  @else
  <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/style-admin.css') }}">
  @endif
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css">

  <link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/bootstrap.min.css') }}">
  <script src="{{ asset('theme/assets/js/bootstrap.min.js') }}"></script>
</head>

<body style="background-color:#f2f2f7;">
  <div class="container-fluid">
    <div class="row flex-nowrap dash_head align-items-center">
      <div class="col-auto col-md-3 col-xl-2 logo-site">
        @if(Auth::user()->role_id == "2")
        <a href="{{ url('/dashboard') }}"> <img src="{{ asset('theme/assets/images/logo-foot.png') }}" alt="site_logo"> </a>
        @else
        <a href="{{ url('/dashboard') }}"> <img src="{{ asset('theme/assets/images/admin-logo.png') }}" alt="site_logo"> </a>
 
        @endif
      </div>
      <div class="col top_right_head text-end d-flex justify-content-end">
        <div class="dropdown d-flex justify-contact-end main-of-head">
          <a href="#" role="button" id="dropdownMenuprofile" data-bs-toggle="dropdown" aria-expanded="false">
            <span>Welcome, {{Auth::user()->first_name}}</span>
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuprofile">
            <li><a class="dropdown-item" href="{{ url('/edit-profile') }}">Update Profile
              </a></li>
              @if(Auth::user()->role_id == "2")
              <li><a class="dropdown-item" href="{{ url('/change-password') }}">Change Password
              </a></li>
              @endif
            <a class="dropdown-item" href="{{ url('/logout-user') }}">Logout
            </a>
            </li>
          </ul>
        </div>
        <div class="dropdown d-flex justify-contact-end main-of-head notification">
          <a href="#" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('theme/assets/images/ring.svg') }}" alt="bell">
            <ul class="dropdown-menu" aria-labelledby="dropdownNotification">
              <?php
              $notifications = Notification::orderBy('id', 'desc')->limit(3)->get();
              foreach ($notifications as $notification) {
              ?>
                <li>
                  <div>
                    @if($notification->logo)
                    <img src="{{ $notification->logo }}" width="50" height="50" />
                    @else
                    <img src="http://15.188.226.196/public/Uploads/profile-picture.jpg" width="50" height="50" />
                    @endif
                    <h5>{{$notification->title}}</h5><br>
                    {{$notification->description}}<br>
                    {{$notification->created_at}}
                  </div>
                </li>
              <?php
              }

              ?>
              </li>
            </ul>
          </a>
        </div>
      </div>
    </div>
    <div class="row flex-nowrap dash_board">