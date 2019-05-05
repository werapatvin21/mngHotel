<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- DOB -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <!-- icon -->
    <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>HotelCloud - Add New Staff & Schedule Management</title>
  </head>
  <body>

    <!--================ Nav Bar =================-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">HotelCloud</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../dashboard/dashboard.blade.php">Dashboard</a>
          </li>
          <li class="nav-item dropdown active">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Management<span class="sr-only">(current)</span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../reservation/reservation.blade.php">Reservations</a>
                <a class="dropdown-item" href="../services/services.blade.php">Services</a>
                <a class="dropdown-item" href="../guests/guests.blade.php">Guest</a>
                <a class="dropdown-item" href="../stock/stock.blade.php">Stock</a>
                <a class="dropdown-item" href="staff.blade.php">Staff</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../report/report.blade.php">Bookings Report</a>
              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Setting
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../setting/setting.blade.php">Rooms & Services</a>
              </div>
            </li>
        </ul>

          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Hello, Kanyarush
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="../account.blade.php">My Account</a>
              </div>
            </li>
          </ul>

          <!-- Button to Open the "Logout" Modal -->
          <form class="form-inline my-2 my-lg-0">
            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#signIn">Log Out</button>
          </form>
      </div>
    </nav>
    <!--================ End Nav Bar =================-->

      <div class="container">

          <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
            <h2>Staff</h2>
            <div class="input-group">
              <!-- Button to "Search Staff" -->
              <div class="btn-group mr-2" role="group" aria-label="First group">
              <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search Staff" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
              </form>
              </div>

              <!-- Button to Open the "Add Staff" Modal -->
              <div class="btn-group mr-2" role="group" aria-label="Second group">
              <form class="form-inline my-2 my-lg-0">
                  <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newStaff"><ion-icon name="add-circle-outline"></ion-icon>New Staff</button>
              </form>
              </div>

              <!-- Button to Open the "New Schedule" Modal -->
              <div class="btn-group mr-2" role="group" aria-label="Second group">
                <form class="form-inline my-2 my-lg-0">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newSchedule"><ion-icon name="add-circle-outline"></ion-icon>New Schedule</button>
                </form>
              </div>
            </div>
          </div>

          <br><p>The .table-hover class enables a hover state (grey background on mouse over) on table rows:</p>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Fullname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Role</th>
                <th>Edit / Read More</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>012-345-6789</td>
                <td>Reception</td>
                <td>Reception</td>
                <td align="center">
                  <ion-icon name="create" data-toggle="modal" data-target="#editStaff"></ion-icon>
                  <ion-icon name="document" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                </td>
              </tr>
              <tr>
                <td>Mary Moe</td>
                <td>mary@example.com</td>
                <td>012-345-6789</td>
                <td>Housekeeping</td>
                <td>Housekeeping</td>
                <td align="center">
                  <ion-icon name="create" data-toggle="modal" data-target="#editStaff"></ion-icon>
                  <ion-icon name="document" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                </td>
              </tr>
              <tr>
                <td>July Dooley</td>
                <td>july@example.com</td>
                <td>012-345-6789</td>
                <td>Manager</td>
                <td>Manager</td>
                <td align="center">
                  <ion-icon name="create" data-toggle="modal" data-target="#editStaff"></ion-icon>
                  <ion-icon name="document" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

    <!--================ The "Add New Staff" Modal =================-->
    <div class="modal" id="newStaff">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Create New Staff Account</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action=""> <!-- action here -->

                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                            <label for="staff_name" class="col-sm-4 col-form-label">Full Name</label>
                            <div class="col-sm-8"><input type="text" class="form-control" id="staff_name"></div>
                          </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                              <label for="staff_id" class="col-sm-4 col-form-label">Staff ID</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="staff_id"></div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="staff_uname" class="col-sm-4 col-form-label">Username</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_uname"></div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_pwd" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8"><input type="password" class="form-control" id="staff_pwd"></div>
                              </div>
                          </div>
                        </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_id" class="col-sm-4 col-form-label">Date of Birth</label>
                                <div class="col-sm-8"><input id="staff_datepicker" width="235" /></div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_weigth" class="col-sm-4 col-form-label">Age</label>
                                <div class="col-sm-8">
                                  <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                  <div class="input-group">
                                    <input type="number" class="form-control" id="staff_age">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">years</div>
                                    </div>
                                  </div><!--calculate age automatic-->
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_height" class="col-sm-4 col-form-label">Height</label>
                                  <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="staff_height">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">cm.</div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_weight" class="col-sm-4 col-form-label">Weight</label>
                                  <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="staff_weight">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">kg.</div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                              <label for="staff_role" class="col-sm-4 col-form-label">Department</label>
                              <div class="col-sm-8">
                                <select class="form-control" id="staff_role">
                                  <option>-- Select --</option>
                                  <option>Reception</option>
                                  <option>Housekeeping</option>
                                  <option>Food and Beverage</option>
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                              <label for="staff_pos" class="col-sm-4 col-form-label">Position</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_pos"></div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="inputAddress" class="col-sm-4 col-form-label">Address</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress" placeholder="1234 Main St"></div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group row">
                                <label for="inputAddress2" class="col-sm-4 col-form-label">Address 2</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress2" placeholder="Apartment, studio, or floor"></div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                  <label for="inputAddress3" class="col-sm-4 col-form-label">Address 3</label>
                                  <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress3" placeholder="City"></div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                  <label for="staff_province" class="col-sm-4 col-form-label">Province</label>
                                  <div class="col-sm-8">
                                    <select id="staff_province" class="form-control">
                                      <option selected>-- Select --</option>
                                      <option>Bangkok</option>
                                    </select>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="staff_email" class="col-sm-4 col-form-label">Email</label>
                              <div class="col-sm-8"><input type="email" class="form-control" id="staff_email" placeholder="abc@def.com"></div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8"><input type="number" class="form-control" id="staff_phone" placeholder="012-345-6789"></div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                  <select class="form-control" id="staff_status">
                                    <option>-- Select --</option>
                                    <option>Working</option>
                                    <option>Fired</option>
                                    <option>Resigned</option>
                                    <option>Retired</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_preJob" class="col-sm-4 col-form-label">Previous Job</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_preJob"></div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_status" class="col-sm-4 col-form-label">Picture</label>
                                <div class="col-sm-8">
                                  <input type="file" class="form-control-file" id="staff_pic">
                                </div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                  <label for="staff_status" class="col-sm-4 col-form-label">File</label>
                                  <div class="col-sm-8">
                                    <input type="file" class="form-control-file" id="staff_citizen">
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="staff_note">Note: </label>
                          <textarea class="form-control" id="staff_note" rows="3"></textarea>
                      </div>

                </form> <!-- end action here -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button align="center" type="button" class="btn btn-success">Save</button>
              </div>

            </div>
          </div>
        </div>
        <!--================ End "Add New Staff" Modal =================-->

    <!--================ The "Edit Staff" Modal =================-->
    <div class="modal" id="editStaff">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Staff Account</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action=""> <!-- action here -->

                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                            <label for="staff_name" class="col-sm-4 col-form-label">Full Name</label>
                            <div class="col-sm-8"><input type="text" class="form-control" id="staff_name"></div>
                          </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                              <label for="staff_id" class="col-sm-4 col-form-label">Staff ID</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="staff_id"></div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="staff_uname" class="col-sm-4 col-form-label">Username</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_uname"></div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_pwd" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8"><input type="password" class="form-control" id="staff_pwd"></div>
                              </div>
                          </div>
                        </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_id" class="col-sm-4 col-form-label">Date of Birth</label>
                                <div class="col-sm-8"><input id="staff_datepickerEdit" width="235" /></div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_weigth" class="col-sm-4 col-form-label">Age</label>
                                <div class="col-sm-8">
                                  <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                  <div class="input-group">
                                    <input type="number" class="form-control" id="staff_age">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">years</div>
                                    </div>
                                  </div><!--calculate age automatic-->
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_height" class="col-sm-4 col-form-label">Height</label>
                                  <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="staff_height">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">cm.</div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_weight" class="col-sm-4 col-form-label">Weight</label>
                                  <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="staff_weight">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">kg.</div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                              <label for="staff_role" class="col-sm-4 col-form-label">Department</label>
                              <div class="col-sm-8">
                                <select class="form-control" id="staff_role">
                                  <option>-- Select --</option>
                                  <option>Reception</option>
                                  <option>Housekeeping</option>
                                  <option>Food and Beverage</option>
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                              <label for="staff_pos" class="col-sm-4 col-form-label">Position</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_pos"></div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="inputAddress" class="col-sm-4 col-form-label">Address</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress" placeholder="1234 Main St"></div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group row">
                                <label for="inputAddress2" class="col-sm-4 col-form-label">Address 2</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress2" placeholder="Apartment, studio, or floor"></div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                  <label for="inputAddress3" class="col-sm-4 col-form-label">Address 3</label>
                                  <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress3" placeholder="City"></div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                  <label for="staff_province" class="col-sm-4 col-form-label">Province</label>
                                  <div class="col-sm-8">
                                    <select id="staff_province" class="form-control">
                                      <option selected>-- Select --</option>
                                      <option>Bangkok</option>
                                    </select>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="staff_email" class="col-sm-4 col-form-label">Email</label>
                              <div class="col-sm-8"><input type="email" class="form-control" id="staff_email" placeholder="abc@def.com"></div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8"><input type="number" class="form-control" id="staff_phone" placeholder="012-345-6789"></div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8">
                                  <select class="form-control" id="staff_status">
                                    <option>-- Select --</option>
                                    <option>Working</option>
                                    <option>Fired</option>
                                    <option>Resigned</option>
                                    <option>Retired</option>
                                  </select>
                                </div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_preJob" class="col-sm-4 col-form-label">Previous Job</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_preJob"></div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_status" class="col-sm-4 col-form-label">Picture</label>
                                <div class="col-sm-8">
                                  <input type="file" class="form-control-file" id="staff_pic">
                                </div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                  <label for="staff_status" class="col-sm-4 col-form-label">File</label>
                                  <div class="col-sm-8">
                                    <input type="file" class="form-control-file" id="staff_citizen">
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="staff_note">Note: </label>
                          <textarea class="form-control" id="staff_note" rows="3"></textarea>
                      </div>

                </form> <!-- end action here -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
              <button align="center" type="button" class="btn btn-success">Save</button>
            </div>

            </div>
          </div>
        </div>
        <!--================ End "Edit Staff" Modal =================-->

    <!--================ The "Staff Detail" Modal =================-->
    <div class="modal" id="staffDetail">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Staff Datail</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action=""> <!-- action here -->

                  <div class="row">
                      <div class="col">
                        <div class="form-group row">
                            <label for="staff_pic" class="col-sm-4 col-form-label">Picture</label>
                            <div class="col-sm-8"><input type="file" class="form-control" id="staff_pic" placeholder="แสดงรูปพนักงาน" disabled></div>
                        </div>
                      </div>
                  </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                            <label for="staff_name" class="col-sm-4 col-form-label">Full Name</label>
                            <div class="col-sm-8"><input type="text" class="form-control" id="staff_name" disabled></div>
                          </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                              <label for="staff_id" class="col-sm-4 col-form-label">Staff ID</label>
                              <div class="col-sm-8"><input type="number" class="form-control" id="staff_id" disabled></div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="staff_uname" class="col-sm-4 col-form-label">Username</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_uname" disabled></div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_pwd" class="col-sm-4 col-form-label">Password</label>
                                <div class="col-sm-8"><input type="password" class="form-control" id="staff_pwd" disabled></div>
                              </div>
                          </div>
                        </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_dob" class="col-sm-4 col-form-label">Date of Birth</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_dob" disabled></div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_weigth" class="col-sm-4 col-form-label">Age</label>
                                <div class="col-sm-8">
                                  <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                  <div class="input-group">
                                    <input type="number" class="form-control" id="staff_age" disabled>
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">years</div>
                                    </div>
                                  </div><!--calculate age automatic-->
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_height" class="col-sm-4 col-form-label">Height</label>
                                  <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="staff_height" disabled>
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">cm.</div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_weight" class="col-sm-4 col-form-label">Weight</label>
                                  <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                      <input type="number" class="form-control" id="staff_weight" disabled>
                                      <div class="input-group-prepend">
                                          <div class="input-group-text">kg.</div>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          <div class="form-group row">
                              <label for="staff_role" class="col-sm-4 col-form-label">Department</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_role" disabled></div>
                          </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                              <label for="staff_pos" class="col-sm-4 col-form-label">Position</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_pos" disabled></div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="inputAddress" class="col-sm-4 col-form-label">Address</label>
                              <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress" placeholder="1234 Main St"  disabled></div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group row">
                                <label for="inputAddress2" class="col-sm-4 col-form-label">Address 2</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress2" placeholder="Apartment, studio, or floor" disabled></div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                  <label for="inputAddress3" class="col-sm-4 col-form-label">Address 3</label>
                                  <div class="col-sm-8"><input type="text" class="form-control" id="staff_inputAddress3" placeholder="City" disabled></div>
                              </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                  <label for="staff_province" class="col-sm-4 col-form-label">Province</label>
                                  <div class="col-sm-8"><input type="text" class="form-control" id="staff_province" placeholder="Bangkok" disabled></div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                              <label for="staff_email" class="col-sm-4 col-form-label">Email</label>
                              <div class="col-sm-8"><input type="email" class="form-control" id="staff_email" placeholder="abc@def.com" disabled></div>
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_phone" class="col-sm-4 col-form-label">Phone</label>
                                <div class="col-sm-8"><input type="number" class="form-control" id="staff_phone" placeholder="012-345-6789" disabled></div>
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                            <div class="form-group row">
                                <label for="staff_status" class="col-sm-4 col-form-label">Status</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_status" placeholder="Resigned" disabled></div>
                            </div>
                          </div>
                          <div class="col">
                              <div class="form-group row">
                                <label for="staff_preJob" class="col-sm-4 col-form-label">Previous Job</label>
                                <div class="col-sm-8"><input type="text" class="form-control" id="staff_preJob" disabled></div>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col">
                              <div class="form-group row">
                                  <label for="staff_file" class="col-sm-4 col-form-label">File</label>
                                  <div class="col-sm-8"><input type="file" class="form-control" id="staff_citizen" placeholder="แสดงรูปบัตรปชช." disabled></div>
                              </div>
                          </div>
                      </div>

                      <div class="form-group">
                          <label for="staff_note">Note: </label>
                          <textarea class="form-control" id="staff_note" rows="3" disabled></textarea>
                      </div>

                </form> <!-- end action here -->
            </div>

          </div>
        </div>
        <!--================ End "Staff Detail" Modal =================-->

    <!-- Optional JavaScript -->

    <!-- DOB JavaScript -->
    <script>
        $('#staff_datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#staff_datepickerEdit').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
