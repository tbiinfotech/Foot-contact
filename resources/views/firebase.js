
    // Your web app's Firebase configuration
    const  firebaseConfig = {
        apiKey: "AIzaSyD_lTxcuE6PAU_A-lNvOesjuWFDqHmB3GM",
        authDomain: "footcontact-bf34f.firebaseapp.com",
        projectId: "footcontact-bf34f",
        storageBucket: "footcontact-bf34f.appspot.com",
        messagingSenderId: "474595135988",
        appId: "1:474595135988:web:4005da2622fb16500c69a1",
        measurementId: "G-WGN3NNPCSZ"
    };
    console.log(firebase.apps)
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

   var db=firebase.firestore();
db.settings({
    timestampsInSnapshots:true
})