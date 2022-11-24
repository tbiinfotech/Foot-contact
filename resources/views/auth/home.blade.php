<?php

use Illuminate\Support\Facades\Auth;
?>
@include('header')
@include('side-bar')
<style>
    body {
        font-family: 'Raleway', sans-serif;
        background-color: #ACCEDC;
        margin: 50px 0px;
    }

    .main-section small {
        font-size: 12px;
    }

    .main-section h3,
    .main-section h5 {
        margin: 0px;
    }

    .main-section {
        width: 960px;
        background-color: #fff;
        margin: auto;
    }

    .head-section {
        border-bottom: 1px solid #E6E6E6;
        clear: both;
        overflow: hidden;
        width: 100%;
    }

    .headLeft-section {
        width: calc(30% - 1px);
        float: left;
        border-right: 1px solid #E6E6E6;
    }

    .headLeft-sub {
        padding: 15px;
        text-align: center;
    }

    .headLeft-sub input {
        width: 60%;
        border-radius: 0px;
        border: 1px solid #E6E6E6;
        padding: 7px;
    }

    .headLeft-sub button {
        background: #009EF7;
        color: #fff;
        border: 1px solid #E6E6E6;
        padding: 7px 15px;
    }

    .headRight-section {
        width: 70%;
        float: left;
    }

    .headRight-sub {
        padding: 10px 15px 0px 15px;
    }

    .body-section {
        clear: both;
        overflow: hidden;
        width: 100%;
    }

    .left-section {
        width: calc(30% - 1px);
        float: left;
        height: 500px;
        border-right: 1px solid #E6E6E6;
        background-color: #FFF;
        z-index: 1;
        position: relative;
    }

    .left-section ul {
        padding: 0px;
        margin: 0px;
        list-style: none;
    }

    .left-section ul li {
        padding: 15px 0px;
        cursor: pointer;
    }

    .left-section ul li.active {
        background: #009EF7;
        color: #fff;
        position: relative;
    }

    .mCustomScrollBox,
    .mCSB_container {
        overflow: unset !important;
    }

    .left-section ul li.active .desc .time {
        color: #fff;
    }

    .left-section ul li.active:before {
        position: absolute;
        content: '';
        right: -10px;
        border: 5px solid #009EF7;
        top: 0px;
        bottom: 0px;
        border-radius: 0px 3px 3px 0px;
    }

    .left-section ul li.active:after {
        position: absolute;
        content: "";
        bottom: 0px;
        right: 0px;
        left: auto;
        width: 100%;
        top: 0px;
        -webkit-box-shadow: -8px 4px 10px #a1a1a1;
        -moz-box-shadow: -8px 4px 10px #a1a1a1;
        box-shadow: -8px 4px 10px #a1a1a1;
    }

    .left-section .chatList {
        overflow: hidden;
    }

    .left-section .chatList .img {
        width: 60px;
        float: left;
        text-align: center;
        position: relative;
    }

    .left-section .chatList .img img {
        width: 30px;
        border-radius: 50%;
    }

    .left-section .chatList .img i {
        position: absolute;
        font-size: 10px;
        color: #52E2A7;
        border: 1px solid #fff;
        border-radius: 50%;
        left: 10px;
    }

    .left-section .chatList .desc {
        /* width: calc(100% - 60px); */
        float: left;
        position: relative;
    }

    .left-section .chatList .desc h5 {
        margin-top: 6px;
        line-height: 5px;
    }

    .left-section .chatList .desc .time {
        position: absolute;
        right: 15px;
        color: #c1c1c1;
    }

    .right-section {
        width: 70%;
        float: left;
        height: 500px;
        background-color: #F6F6F6;
        position: relative;
    }

    .message {
        height: calc(100% - 68px);
        font-family: sans-serif;
    }

    .message ul {
        padding: 0px;
        list-style: none;
        margin: 0px auto;
        width: 90%;
        overflow: hidden;
    }

    .message ul li {
        position: relative;
        width: 80%;
        padding: 15px 0px;
        clear: both;
    }

    .message ul li.msg-left {
        float: left;
    }

    .message ul li.msg-left img {
        position: absolute;
        width: 40px;
        bottom: 30px;
    }

    .message ul li.msg-left .msg-desc {
        margin-left: 70px;
        font-size: 12px;
        background: #E8E8E8;
        padding: 5px 10px;
        border-radius: 5px 5px 5px 0px;
        position: relative;
    }

    .message ul li.msg-left .msg-desc:before {
        position: absolute;
        content: '';
        border: 10px solid transparent;
        border-bottom-color: #E8E8E8;
        bottom: 0px;
        left: -10px;
    }

    .message ul li.msg-left small {
        float: right;
        color: #c1c1c1;
    }

    .message ul li.msg-right {
        float: right;
    }

    .message ul li.msg-right img {
        position: absolute;
        width: 40px;
        right: 0px;
        bottom: 30px;
    }

    .message ul li.msg-right .msg-desc {
        margin-right: 70px;
        font-size: 12px;
        background: #cce5ff;
        color: #004085;
        padding: 5px 10px;
        border-radius: 5px 5px 5px 0px;
        position: relative;
    }

    .message ul li.msg-right .msg-desc:before {
        position: absolute;
        content: '';
        border: 10px solid transparent;
        border-bottom-color: #cce5ff;
        bottom: 0px;
        right: -10px;
    }

    .message ul li.msg-right small {
        float: right;
        color: #c1c1c1;
        margin-right: 70px;
    }

    .message ul li.msg-day {
        border-top: 1px solid #EBEBEB;
        width: 100%;
        padding: 0px;
        margin: 15px 0px;
    }

    .message ul li.msg-day small {
        position: absolute;
        top: -10px;
        background: #F6F6F6;
        color: #c1c1c1;
        padding: 3px 10px;
        left: 50%;
        transform: translateX(-50%);
    }

    .right-section-bottom {
        background: #fff;
        width: 100%;
        padding: 15px;
        position: absolute;
        bottom: 0px;
        border-top: 1px solid #E6E6E6;
        text-align: center;
    }

    .right-section-bottom input {
        border: 0px;
        padding: 8px 5px;
        width: calc(100% - 150px);
    }

    .right-section-bottom .btn-send {
        border: 0px;
        padding: 8px 10px;
        float: right;
        margin-right: 30px;
        color: #009EF7;
        font-size: 18px;
        background: #fff;
        cursor: pointer;
    }

    .upload-btn {
        position: relative;
        overflow: hidden;
        display: inline-block;
        float: left;
    }

    .upload-btn .btn {
        border: 0px;
        padding: 8px 10px;
        color: #009EF7;
        font-size: 18px;
        background: #fff;
        cursor: pointer;
    }

    .upload-btn input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }
</style>
<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.css">
</head>

<body>

    <div class="col-md-9 col-xl-10 chat_wrapper">
        <div class="main-section">
            <div class="head-section">
                <div class="headRight-section">
                    <div class="headRight-sub">
                        <!-- <h3 class="first_name" id="first_name"></h3> -->
                    </div>
                </div>
            </div>
            <div class="body-section">
                <div class="left-section mCustomScrollbar" data-mcs-theme="minimal-dark">
                   
                    <ul>
                        @foreach($users as $key=>$item)
                        <li>
                            <div class="chatList">
                                <div class="desc">
                                    <h3 class="userId" data-id="{{$item->id}}">{{ $item->first_name }} {{ $item->last_name }}</h3>
                                </div> 
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="right-section">
                    <div class="message mCustomScrollbar" data-mcs-theme="minimal-dark">
                        <ul>
                            <input type="hidden" name="firstreciveId" id="firstreciveId" value="{{$first_user}}">
                            <input type="hidden" name="reciveId" id="reciveId" value="">
                            <div id="appendata">
                            </div>
                            <div id="reciverappendata">
                            </div>
                        </ul>
                    </div>
                    <div class="right-section-bottom">
                        <form onsubmit="return sendMessage();">
                            <input id="message" placeholder="Enter message" onkeydown="keyDown(event)" autocomplete="off" required>
                            <?php
                            $id = auth()->user()->id;
                            ?>
                            <input type="hidden" name="loginId" id="loginId" value="{{$id}}">
                            <input class="clear" type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- custom scrollbar plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>

</html>
<!-- create a form to send message -->
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.2.1/firebase-firestore.js"></script>
<script>
    //    function keyDown(e) { 
    //   var e = window.event || e;
    //   var key = e.keyCode;
    //   //space pressed
    //    if (key == 32) { //space
    //     e.preventDefault();
    //    }

    // }
    document.addEventListener('DOMContentLoaded', event => {
        var loginId = document.getElementById("loginId").value;
        var reciver_id = document.getElementById("reciveId").value;
        if (reciver_id == "") {
            var reciver_id = document.getElementById("firstreciveId").value;
        }
        const firebaseConfig = {
            apiKey: "AIzaSyD_lTxcuE6PAU_A-lNvOesjuWFDqHmB3GM",
            authDomain: "footcontact-bf34f.firebaseapp.com",
            databaseURL: "https://footcontact-bf34f-default-rtdb.firebaseio.com",
            projectId: "footcontact-bf34f",
            storageBucket: "footcontact-bf34f.appspot.com",
            messagingSenderId: "474595135988",
            appId: "1:474595135988:web:4005da2622fb16500c69a1",
            measurementId: "G-WGN3NNPCSZ"
        }
        try {
            var ids = loginId + reciver_id;

            firebase.initializeApp(firebaseConfig)
            const db = firebase.firestore()
            docRef = db.collection("Chats").doc(ids)
                .get().then((doc) => {
                    if (doc.exists) {
                        var firbaseData = doc.data().message
                        firbaseData.forEach(function(doc) {
                            if (doc.reciverID != loginId) {
                                if ((doc.userID == loginId)) {
                                    if ((doc.reciverID == reciver_id)) {
                                        $("#appendata").append("<li class='msg-left'><div class='msg-left-sub'><div class='msg-desc'>" + doc.message + "</div> <small></small></div></li>");
                                    }
                                }
                            } else {
                                if ((doc.reciverID == loginId)) {
                                    if ((doc.userID == reciver_id)) {

                                        $("#reciverappendata").append("<li class='msg-right'><div class='msg-left-sub'><div class='msg-desc'>" + doc.message + "</div><small></small></div></li>");
                                    }
                                }
                            }
                        });
                    } else {
                        // doc.data() will be undefined in this case
                        console.log("No such document!");
                    }
                })
        } catch (err) {
            console.log("ASDFASDF", err);
        }
    });
</script>
<script>
   
    var loginId = document.getElementById("loginId").value;
    $(".userId").click(function() {
        var userID = $(this).attr('data-id');
        $('#reciveId').val(userID)
        jQuery('#appendata').html('');
        jQuery('#reciverappendata').html('');
        messageList();
    });

    function messageList() {
        var loginId = document.getElementById("loginId").value;
        var reciver_id = document.getElementById("reciveId").value;
        if (reciver_id == "") {
            var reciver_id = document.getElementById("firstreciveId").value;
        }
        try {
            var ids = loginId + reciver_id;
            const db = firebase.firestore()
            docRef = db.collection("Chats").doc(ids)
                .get().then((doc) => {
                    if (doc.exists) {
                        var firbaseData = doc.data().message
                        firbaseData.forEach(function(doc) {
                            if (doc.reciverID != loginId) {
                                if ((doc.userID == loginId)) {
                                    if ((doc.reciverID == reciver_id)) {
                                        $("#appendata").append("<li class='msg-left'><div class='msg-left-sub'><div class='msg-desc'>" + doc.message + "</div> <small></small></div></li>");
                                    }
                                }
                            } else {

                                if ((doc.reciverID == loginId)) {
                                    if ((doc.userID == reciver_id)) {
                                        $("#reciverappendata").append("<li class='msg-right'><div class='msg-left-sub'><div class='msg-desc'>" + doc.message + "</div><small></small></div></li>");
                                    }
                                }
                            }
                        });
                    } else {
                        // doc.data() will be undefined in this case
                        console.log("No such document!");
                    }
                })
        } catch (err) {
            console.log("ASDFASDF", err);
        }
    }

    function sendMessage() {
        var loginId = document.getElementById("loginId").value;
        var reciver_id = document.getElementById("reciveId").value;
        if (reciver_id == "") {
            var reciver_id = document.getElementById("firstreciveId").value;
        }
        var ids = loginId + reciver_id;
        // get message    
        var message = document.getElementById("message").value;
        if ($.trim($('#message').val()) != '') {
            try {
                const db = firebase.firestore();
                var new_message = {
                    "createdAt": 234,
                    "message": message,
                    "userID": loginId,
                    "reciverID": reciver_id,
                    "userName": "test",
                }
                $("#message").val('');
                var docRef = db.collection("Chats").doc(ids);
                docRef.get().then((doc) => {
                    if (doc.exists) {
                        var firbaseData = doc.data().message
                        //store all firebase msg into local storage
                        localStorage.setItem("all_msg", JSON.stringify(firbaseData));
                        //get all msg back from local storage
                        var all_msg = JSON.parse(localStorage.getItem("all_msg"));
                        //push new msg into list
                        if (null === all_msg) {
                            var all_msg = [];
                        }
                        all_latest_msg
                        all_msg.push(new_message);
                        localStorage.setItem('all_latest_msg', JSON.stringify(all_msg));
                        var all_latest_msg = JSON.parse(localStorage.getItem("all_latest_msg"));

                        if (all_latest_msg != null) {
                            db.collection("Chats").doc(ids).set({
                                "message": all_latest_msg
                            });
                            $("#appendata").append("<li class='msg-left'><div class='msg-left-sub'><div class='msg-desc'>" + message + "</div> <small></small></div></li>");
                            
                            console.log('data save')
                        }
                    } else {
                        // doc.data() will be undefined in this case
                        db.collection("Chats").doc(ids).set({
                            "message": [{
                                "createdAt": 22,
                                "message": message,
                                "userID": loginId,
                                "reciverID": reciver_id,
                                "userName": "test",
                            }]
                        });
                    }

                }).catch((error) => {
                    console.log("Error getting document:", error);
                });

            } catch (err) {
                console.log("ccccc", err);
            }
        }
        // save in database



        return false;
    }
</script>