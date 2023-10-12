<!--para que no cuente visitas  en firebase estando en localhost-->
@if(!str_contains(url('/'), 'localhost') && !str_contains(url('/'), '127.0.0.1:8000'))
<!-- The core Firebase JS SDK is always required and must be listed firstttt -->
<script src="https://www.gstatic.com/firebasejs/8.6.3/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.6.3/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyC6sWUmNwPKm476T_slrkg90d8y_DtmL2o",
    authDomain: "recitrack-a87ef.firebaseapp.com",
    projectId: "recitrack-a87ef",
    storageBucket: "recitrack-a87ef.appspot.com",
    messagingSenderId: "710116689949",
    appId: "1:710116689949:web:10c45a403938f7976f5ef4",
    measurementId: "G-TGYW0JZXRF"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
@endif

