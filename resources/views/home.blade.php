



@extends('layouts.admin')
@section('content')
  <style>
    .table th {
      padding: 1.2em !important;
      vertical-align: top;
      border-top: 1px solid #f4f5f8;
    }

    .table td {
      padding: 1.5em !important;
      vertical-align: top;
      border-top: 1px solid #f4f5f8;
    }

    .table th {
      background-color: rgba(232, 234, 244, 0.6);
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background: none;
    }

    .table-striped tbody tr:nth-of-type(2n) {
      background-color: rgba(232, 234, 244, 0.3)
    }

    table.dataTable.no-footer {
      border-bottom: unset !important;
    }

    .dataTables_filter {
      display: none;
    }

    body {
      margin: 0;
      padding: 0;
    }

    .title {
      /* บีคอนส์ */
      font-style: normal;
      font-weight: 500;
      line-height: normal;
      font-size: 20px;
      color: #2F353A;
    }

    .marker {
      top: -0.9em !important;
    }

    .m-checkbox.m-checkbox--brand.m-checkbox--solid > input:checked ~ span {
      background: #0097A7 !important;
    }

    .dataTables_wrapper .pagination .page-item:hover > .page-link {
      background: #0097A7 !important;
    }

    #removeChechBox {
      cursor: pointer;
    }

    .check_beacon {
      pointer-events: none
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
      border: 1px solid transparent !important;
      border-radius: 18px !important;
      background: #0097A7 !important;
      color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      background-color: #0097A7 !important;
      color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      color: white !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
      box-sizing: border-box;
      display: inline-block;
      min-width: 1.5em;
      padding: 0.5em 1em;
      margin-left: 2px;
      text-align: center;
      text-decoration: none !important;
      cursor: pointer;
      border: 1px solid transparent !important;
      border-radius: 18px !important;
      color: #fff !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      box-sizing: border-box;
      display: inline-block;
      min-width: 1.5em;
      padding: 0.5em 1em;
      margin-left: 2px;
      text-align: center;
      text-decoration: none !important;
      cursor: pointer;
      border: 1px solid transparent !important;
      border-radius: 18px !important;
      color: #fff !important;
      background-color: #0097A7 !important;
      background: -webkit-linear-gradient(top, #0097A7 0%, #0097A7 100%) !important;
    }

    #eventTable .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
      color: white !important;
    }

    #eventTable .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
      color: #fff !important;
    }

    #filter_bar {
      padding: 20px;
      height: auto;
    }

    @media (min-width: 426px) {
      #filter_bar {
        position: fixed;
        top: 107px;
        left: 0;
        right: 0;
        z-index: 10;
      }

      #main-content {
        padding-top: 90px;
      }
    }

    @media (min-width: 1025px) {
      #filter_bar {
        left: 255px;
        top: 70px;
      }
    }

    #search_text {
      width: 150px;
    }

    .dataTables_wrapper .dataTable td .m-checkbox, .dataTables_wrapper .dataTable th .m-checkbox {
      left: 7px;
    }

  </style>


  {{--<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- main css -->
    <link rel="stylesheet" href="../css/style.css">

    <title>Manage Hotel in Cloud</title>
  </head>
  <body>

  <!--================ Nav Bar =================-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="home.blade.php">HotelCloud</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto"></ul>

      <!-- Button to Open the "Sign In" Modal -->
      <form class="form-inline my-2 my-lg-0">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#signIn">Sign In</button>
      </form>
    </div>
  </nav>
  <!--================ End Nav Bar =================-->

  <!--================ Home Banner Area =================-->
  <div class="wrapper">
    <div class="message">

      <section>
        <div class="container">

          <div class="text-center">
            <h1>HotelCloud</h1>
            <h3>better management, better business</h3>
            <p>“ Chilling out on the bed in your hotel room watching television, <br>while wearing your own pajamas, is sometimes the best part of a vacation. ” <br>- Laura Marano -</p>
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#signUp">Get Started</a>
          </div>
        </div>
      </section>

    </div>
  </div>
  <!--================ End Home Banner Area =================-->

  <!--================ The "Sign In" Modal =================-->
  <div class="modal" id="signIn">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Sign In</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form action=""> <!-- action here -->
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" class="form-control" id="signIn_username" placeholder="Your Username">
            </div>
            <div class="form-group">
              <label for="pwd">Password:</label>
              <input type="password" class="form-control" id="signIn_pwd" placeholder="Your Password">
            </div>
            <div class="form-group form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="signIn_remember"> Remember me<br><br>
                <a href="forgotPwd.blade.php">Forgot password?</a>
              </label>
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success">LOGIN</button>
        </div>

      </div>
    </div>
  </div>
  <!--================ End The "Sign In" Modal =================-->

  <!--================ The "Sign Up" Modal =================-->
  <div class="modal" id="signUp">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Register to HotelCloud</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form action="/action_page.php">
            <div class="form-group">
              <input type="text" class="form-control" id="owner_name" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="owner_email" placeholder="Your Email">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" id="owner_tel" placeholder="Phone Number">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="owner_hName" placeholder="Hotel Name">
            </div>
            <div class="form-group">
              <input type="number" class="form-control" id="owner_rooms" placeholder="Number of Rooms">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="owner_uName" placeholder="Create Username">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="owner_pwd" placeholder="Create Password">
            </div>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-success">Let's Manage</button>
        </div>

      </div>
    </div>
  </div>
  <!--================ End The "Sign Up" Modal =================-->

  <style>
    html, body{
      height: 100%;
    }
    body {
      background-image: url(../img/home.jpg) ;
      background-position: center center;
      background-repeat:  no-repeat;
      background-attachment: fixed;
      background-size:  cover;
      background-color: #999;
    }

    div, body{
      margin: 0;
      padding: 0;
      font-family: exo, sans-serif;

    }
    .wrapper {
      height: 100%;
      width: 100%;
    }

    .message {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      width: 100%;
      height:45%;
      bottom: 0;
      display: block;
      position: absolute;
      background-color: rgba(0,0,0,0.6);
      color: #fff;
      padding: 0.5em;
    }
  </style>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  </body>

  </html>

--}}
@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@push('scripts')

@endpush





