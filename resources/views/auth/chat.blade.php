@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <center><h2>Laravel Firebase Push Notification - websolutionstuff.com</h2></center>
        <div class="col-md-8">            
             <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center><br>
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('send.push-notification') }}" method="POST">

                        @csrf

                        <div class="form-group">

                            <label>Title</label>

                            <input type="text" class="form-control" name="title">

                        </div>

                        <div class="form-group">

                            <label>Body</label>

                            <textarea class="form-control" name="body"></textarea>

                          </div>

                        <button type="submit" class="btn btn-primary">Send Notification</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script
    src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
    crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.0/firebase-messaging.js"></script>
<script>
  var firebaseConfig = {
    apiKey: "AIzaSyD_lTxcuE6PAU_A-lNvOesjuWFDqHmB3GM",
    authDomain: "XXXX.firebaseapp.com",
    projectId: "footcontact-bf34f",
    storageBucket: "footcontact-bf34f.appspot.com",
    messagingSenderId: "474595135988",
    databaseURL: "https://Your_Project_ID.firebaseio.com",
    appId: "1:474595135988:android:0a160f8d363467ee0c69a1" 
  };
    firebase.initializeApp(firebaseConfig);
console.log("firebase connected")
    // const messaging = firebase.messaging();
  
    // function initFirebaseMessagingRegistration() {
    //         messaging
    //         .requestPermission()
    //         .then(function () {
    //             return messaging.getToken({ vapidKey: 'Your_Public_Key' })
    //         })
    //         .then(function(token) {
    //             console.log(token);
   
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });
  
    //             $.ajax({
    //                 url: '{{ route("save-push-notification-token") }}',
    //                 type: 'POST',
    //                 data: {
    //                     token: token
    //                 },
    //                 dataType: 'JSON',
    //                 success: function (response) {
    //                     alert('Token saved successfully.');
    //                 },
    //                 error: function (err) {
    //                     console.log('User Chat Token Error'+ err);
    //                 },
    //             });
  
    //         }).catch(function (err) {
    //             console.log('User Chat Token Error'+ err);
    //         });
    //  }  
      
    // messaging.onMessage(function(payload) {
    //     const noteTitle = payload.notification.title;
    //     const noteOptions = {
    //         body: payload.notification.body,
    //         icon: payload.notification.icon,
    //     };
    //     new Notification(noteTitle, noteOptions);
    // });
   
</script>
@endsection