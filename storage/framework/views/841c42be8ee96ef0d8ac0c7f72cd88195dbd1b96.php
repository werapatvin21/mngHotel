<?php $__env->startSection('content'); ?>
    <style>
        .table-scroll {
            position:relative;
            max-width:1200px;
            margin:auto;
            overflow:hidden;
            border:1px solid #000;
        }
        .table-wrap {
            width:100%;
            overflow:auto;
        }
        .table-scroll table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll th, .table-scroll td {
            padding:5px 10px;
            border:1px solid #000;
            white-space:nowrap;
            vertical-align:top;
        }
        .clone {
            position:absolute;
            top:0;
            left:0;
            pointer-events:none;
        }
        .clone th, .clone td {
            visibility:hidden
        }
        .clone td, .clone th {
            border-color:transparent
        }
        .clone tbody th {
            visibility:visible;
        }
        .clone .fixed-side {
            border:1px solid #000;
            visibility:visible;
            background: white;
        }
        .clone thead, .clone tfoot{background:transparent;}

    </style>
    <style>

        body {
            margin: 0;
            padding: 0;
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
    </style>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- DOB -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
        <!-- icon -->
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">

        <title>HotelCloud - Reservation Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
                
            </div>
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-2">

                <a class="btn btn--custom" href="<?php echo e(route('reservation.index')); ?>"
                   style="background-color: #0a6aa1;color:#fff;border-radius: 5px;float: right;"
                   role="button">
                    <i class="fas fa-back"></i> Back
                </a>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head" style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            Reservation
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body" id="eventTable">
            <div class="tab-content">
                <div class="tab-pane active" id="m_user_profile_tab_1">

                </div>
                <div class="tab-pane " id="m_user_profile_tab_2"></div>
                <div class="tab-pane " id="m_user_profile_tab_3"></div>
            </div>
        </div>

        <div class="m-portlet__body" id="eventTable">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <!--================ Add Booking =================-->
                        <div class="col-sm-12">
                            <div class="container">
                                <?php if($data && $data->id): ?>
                                    <div class="pb-2 mt-4 mb-2 border-bottom"><h4>Edit Booking</h4></div>
                                <?php else: ?>
                                    <div class="pb-2 mt-4 mb-2 border-bottom"><h4>New Booking</h4></div>
                                <?php endif; ?>
                                <form class="m-form m-form--fit " enctype="multipart/form-data"
                                      action="<?php echo e($data->id ? route('reservation.update', ['id' => $data->id]) : route('reservation.store')); ?>"
                                      method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php if($data && $data->id): ?>
                                        <?php echo method_field('PUT'); ?>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="datenewbooking" class="col-sm-4 col-form-label">Check
                                                    In
                                                    <span class="help-block" style="color: #ff4d4d">
                                                        <strong>*</strong>
                                                    </span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <?php
                                                    $time = strtotime($data->check_in);
                                                    $check_in = date('Y-m-d',$time);
                                                    ?>
                                                    <input id="check_in" name="check_in"
                                                           value="<?php echo e($check_in >= date('Y-m-d') ? $check_in : ''); ?>"
                                                           class="form-control" placeholder="yyyy-mm-dd" width="213" required/>
                                                    <span class="help-block">
                                                        <strong id="message"></strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="nights" class="col-sm-4 col-form-label">
                                                    Nights
                                                    <span class="help-block" style="color: #ff4d4d">
                                                        <strong>*</strong>
                                                    </span>
                                                </label>
                                                <div class="col-sm-8">
                                                    <input type="number" onchange="clearStorage()" min="1" name="total_night" class="form-control"
                                                           id="total_night" value="<?php echo e($data->total_night?: 1); ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
                                        
                                        
                                        
                                            
                                            
                                                
                                                        
                                                            
                                                                
                                                            
                                                                
                                                            
                                                        
                                                
                                                    
                                                    
                                                        
                                                    
                                                        
                                                    
                                                        
                                                            
                                                        
                                                            
                                                        
                                                    

                                                
                                            
                                        
                                            
                                        
                                    

                                    <div class="row">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="nights" class="col-sm-2 col-form-label">
                                                Room
                                                <span class="help-block" style="color: #ff4d4d">
                                                        <strong>*</strong>
                                                    </span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-control" onchange="clearStorage()" name="room_id" id="room_id" required>
                                                    <option id="not-selected" value="">-- Room Name --</option>
                                                    <!-- ต้องดึงข้อมูลที่ผู้ใช้สร้าง ขึ้นมาแสดง -->
                                                    <?php if(isset($rooms)&& count($rooms) != 0): ?>
                                                        <?php $room_id = old('room_id',$data->room_id); ?>
                                                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option id="<?php echo e($room->id.'room'); ?>" <?php echo e($room->id === $room_id ?'selected':''); ?> value="<?php echo e($room->id); ?>">
                                                                <?php echo e($room->name); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option value="">No Room</option>
                                                    <?php endif; ?>
                                                </select><br>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                    

                                        

                                        
                                    

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="nights" class="col-sm-2 col-form-label">
                                                    Guest
                                                    <span class="help-block" style="color: #ff4d4d">
                                                        <strong>*</strong>
                                                    </span>
                                                </label>
                                                <div class="col-sm-10">
                                                    <div class="input-group">
                                                        <select style="width: 60%" class="form-control" name="id_guest"
                                                                id="js-example-basic-hide-search-multi" required>
                                                            <option value="">-- Guest Name --</option>
                                                            <?php if(isset($guests)&& count($guests) != 0): ?>
                                                                <?php $id_guest = old('room_id',$data->id_guest); ?>
                                                                <?php $__currentLoopData = $guests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $guest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option <?php echo e($guest->id === $id_guest ?'selected':''); ?> value="<?php echo e($guest->id); ?>"><?php echo e($guest->first_name); ?>   <?php echo e($guest->last_name); ?> </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php else: ?>
                                                                <option value="">No Guest</option>
                                                            <?php endif; ?>
                                                        </select>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary" type="button" data-toggle="modal"
                                                                    data-target="#newGuest">
                                                                <ion-icon name="person-add"></ion-icon>
                                                                New Guest
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="input-group mb-1">

                                    </div><br>

                                 



                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="price" class="col-sm-4 col-form-label">Price Room</label>
                                                <div class="col-sm-8"><input type="text" value="<?php echo e($data->price?:0); ?>"
                                                                             required name="price"  id="price" class="form-control"
                                                                             id="price" placeholder="แสดงราคาอัตโนมัติ"
                                                                             readonly></div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="promo_code" class="col-sm-4 col-form-label">Promotion
                                                    Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="search_promotion_code">
                                                    <span style="color:red;" id="data_promotion_not_found"> Data promotion not found. </span>

                                                </div>
                                                
                                                    
                                                
                                                        
                                                    

                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                
                                                <label for="discount" class="col-sm-4 col-form-label">
                                                    Discount</label>
                                                <div class="col-sm-8">
                                                    <input type="text"  id="promotion_code" readonly name="promotion_code" value="<?php echo e($data->promotion_code); ?>"  class="form-control">
                                                </div>
                                                
                                                    
                                                
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="id_gent" class="col-sm-4 col-form-label">
                                                    Agent
                                                    <span class="help-block" style="color: #ff4d4d">
                                                        <strong>*</strong>
                                                    </span>
                                                </label>
                                                <div class="col-sm-8">

                                                    <select style="width: 60%" class="form-control" name="id_gent"
                                                            id="id_gent"
                                                            required>
                                                        <option value="">Select Agent </option>
                                                    <?php $id_gent = old('id_gent',$data->id_gent); ?>
                                                    <?php if(isset($agents)&& count($agents) != 0): ?>
                                                        <?php $__currentLoopData = $agents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php echo e($agent->id === $id_gent ?'selected':''); ?> value="<?php echo e($agent->id); ?>"><?php echo e($agent->name); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option value="">No Agent</option>
                                                    <?php endif; ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="discount" class="col-sm-4 col-form-label">
                                                    Special Request</label>
                                                <div class="col-sm-8" style="">
                                                <select for="req" class="form-control" id="special_request"
                                                        name="special_request">

                                                    <option value="no">None </option>
                                                    <option <?php if($data->special_request): ?> selected <?php endif; ?>   value="yes">
                                                        Special Request
                                                    </option>
                                                </select>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="col">
                                                <div class="form-group row">
                                                    <label for="discount" class="col-sm-4 col-form-label">
                                                        <b>Total</b></label>
                                                    <div class="col-sm-7" style="">
                                                        <input type="text"  style="text-align:right;" width="50px" id="total_price" readonly name="total_price" value="<?php echo e($data->total_price?: 0); ?>"  class="form-control">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <b>฿</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <textarea name=special_request_note" id="special_request_note"
                                                          class="form-control" id="" rows="3" required
                                                          placeholder="Typing Special Request Here"> <?php echo e($data->special_request); ?></textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-1">Service</div>

                                        <div class="col-1">
                                            <button type="button" id="plus" class="btn btn-warning btn-circle">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <br>
                                            <input type="hidden" id="numServ" name="numServ" value="0"/>
                                        </div>
                                    </div>
                                    <br>
                                    <?php $total_reservServ = 0; ?>
                                    <?php if(isset($reservation_services) &&  count($reservation_services) > 0): ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Service Name</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Price</th>
                                                        <th scope="col">Created</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $total_reservServ = 0?>
                                                    <?php $__currentLoopData = $reservation_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $Serv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <tr>
                                                            <td scope="row"><?php echo e($index+1); ?></td>
                                                            <td> <?php echo e($Serv->name); ?></td>
                                                            <td>1</td>
                                                            <?php $total_reservServ+= $Serv->price ?>
                                                            <td><?php echo e($Serv->price); ?> ฿</td>
                                                            <td><?php echo e($Serv->created_at); ?></td>
                                                            <td>
                                                                <a href="<?php echo e(url('reservation').'/'.$data->id.'?reservServ='.$Serv->id); ?>">
                                                                    <button type="button" onclick="deleteService(<?php echo e($Serv->id_services); ?>)" class="btn btn-danger btn-circle">
                                                                        <i class="fa fa-times"></i>
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                        
                                                        
                                                            
                                                        
                                                    


                                                    </tbody>
                                                </table>

                                                <table>


                                                </table>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <br>
                                    <div class="services"></div>
                                    <br>


                                    <div class="modal-footer">
                                        <button type="submit" onclick="clearStorage()" id="save-btn" class="btn btn--custom"><i class="fas fa-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </form>

                            </div>


                        </div>
                        <!--================ End Add Booking =================-->

                        <!--================ The "Add New Guest" Modal =================-->
                        <form class="m-form m-form--fit " enctype="multipart/form-data"
                              action="<?php echo e(route('guest.store')); ?>"
                              method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="modal" id="newGuest">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title">New guests</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <form action=""> <!-- action here -->

                                                <input name="add_guests_for_reservations" type="hidden" value="yes">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_first_name" class="col-sm-4 col-form-label">First
                                                                Name
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8"><input type="text"
                                                                                         required
                                                                                         class="form-control"
                                                                                         name="first_name"
                                                                                         id="first_name"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_last_name" class="col-sm-4 col-form-label">Last
                                                                Name
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8"><input type="text"
                                                                                         required
                                                                                         class="form-control"
                                                                                         id="last_name" name="last_name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_nationalID"
                                                                   class="col-sm-4 col-form-label">National ID</label>
                                                            <div class="col-sm-8"><input type="number"
                                                                                         class="form-control"
                                                                                         id="card_id" name="card_id"
                                                                                         maxlength="13"
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_passportID"
                                                                   class="col-sm-4 col-form-label">Passport ID</label>
                                                            <div class="col-sm-8"><input type="text"
                                                                                         class="form-control"
                                                                                         id="passport_id"
                                                                                         name="passport_id"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_email" class="col-sm-4 col-form-label">
                                                                Email
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8"><input type="email"
                                                                                         required
                                                                                         class="form-control" id="email"
                                                                                         placeholder="abc@def.com"
                                                                                         name="email"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_phone" class="col-sm-4 col-form-label">
                                                                Phone
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8"><input type="text"
                                                                                         class="form-control" id="phone"
                                                                                         name="phone"
                                                                                         required
                                                                                         placeholder="012-345-6789">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group row">
                                                            <label for="guest_lastname" class="col-sm-4 col-form-label">
                                                                Country
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8">

                                                                <select class="form-control" name="country"
                                                                        id="js-example-basic-hide-search-multi" required>
                                                                    <option value="">-- Countries --</option>
                                                                    <?php $__currentLoopData = config('country'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option <?php echo e($data->guest_country == $country ?'selected':''); ?> value="<?php echo e($country); ?>"><?php echo e($country); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_address" class="col-sm-4 col-form-label">Address</label>
                                                            <div class="col-sm-12">
                                                                <textarea rows="3"  type="text" class="form-control"
                                                                          id="address" name="address"> </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_fileType" class="col-sm-4 col-form-label">File
                                                                Type
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <select class="form-control" id="file_type"
                                                                        required
                                                                        name="file_type">
                                                                    <option value="national_id">National ID</option>
                                                                    <option value="passport_id">Passport ID</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group row">
                                                            <label for="guest_file" class="col-sm-4 col-form-label">Add
                                                                File
                                                                <span class="help-block" style="color: #ff4d4d">
                                                                    <strong>*</strong>
                                                                </span>
                                                            </label>
                                                            <div class="col-sm-8">
                                                                <input type="file" required class="form-control-file" id="file"
                                                                       name="file">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="guest_note">Note: </label>
                                                    <textarea class="form-control" id="note" rows="2"
                                                              name="note"></textarea>
                                                </div>

                                            </form>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                                                Add New Guest
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--================ End "Add New Guest" Modal =================-->

                        <!--================ Check Room Available =================-->

                    </div><!--row-->


                </div>
            </div>
        </div>

        </div>

        <?php $__env->stopSection(); ?>
        <?php $__env->startPush('scripts'); ?>

            <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>
            
            <script>
                // $('#save-btn').click(function () {
                //     $('#total_price').click();
                // });
                $('#js-example-basic-hide-search-multi').select2(
                    {
                        theme: "bootstrap4",
                        placeholder: "-- Countries --",
                    }
                );

                $('#id_gent').select2(
                    {
                        theme: "bootstrap4",
                        // placeholder: "-- Agent --",
                    }
                );

                var data_edit = <?php echo $data; ?>

                var index = 0;
                if (data_edit) {
                    index = <?php echo count($reservServ->toArray()); ?>

                    $('#numServ').val(index);
                }

                $('#plus').click(function () {
                    $('.services').append(
                                    `<div class="row service${index}">
                                        <div class="col-6">
                                            <select class="form-control" name="service${index}" onchange='addServicePrice("service${index}")' id="service${index}" required>
                                                <option value="">-- Service Name --</option>
                                                    <?php if(isset($services)&& count($services) != 0): ?>
                                                        <?php $service_id = old('services',$data->id_services); ?>
                                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option id="<?php echo e($service->id); ?>" <?php echo e($service->id === $service_id ?'selected':''); ?> value="<?php echo e($service->id); ?>">
                                                                            <?php echo e($service->name); ?>   :<?php echo e($service->price); ?> ฿
                                                        </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                    <option value="">No Service</option>
                                                    <?php endif; ?>
                                             </select><br>
                                        </div>
                                        <div class="col-1">
                                             <button type="button" onclick='deleteSelect(${index},"service${index}")' class="btn btn-danger btn-circle">
                                                 <i class="fa fa-times"></i>
                                             </button>
                                         </div>
                                    </div> `);
                    index++;
                    $('#numServ').val(index);
                });

                function deleteService(service_id) {
                    $.ajax({
                        type: 'post',
                        data: {'serviceId': service_id, "_token": "<?php echo e(csrf_token()); ?>"},
                        url: '<?php echo route('get_price_service'); ?>',
                        dataType: 'json',
                        success: function (res) {
                            var total = parseFloat($("#total_price").val())-res.data.price;
                            $("#total_price").val(total);
                        },
                        error: function (res) {
                            alert('error' + res)
                        }
                    });
                }

                function deleteSelect(index, serviceId) {
                    var id = $('#'+serviceId).val();

                    $.ajax({
                        type: 'post',
                        data: {'serviceId': id, "_token": "<?php echo e(csrf_token()); ?>"},
                        url: '<?php echo route('get_price_service'); ?>',
                        dataType: 'json',
                        success: function (res) {
                            var total = parseFloat($("#total_price").val())-res.data.price;
                            $("#total_price").val(total);
                        },
                        error: function (res) {
                            alert('error' + res)
                        }
                    });
                    $(`.service${index}`).remove();
                }

                function addServicePrice(serviceId) {

                    var id = $('#'+serviceId).val();

                    $.ajax({
                        type: 'post',
                        data: {'serviceId': id, "_token": "<?php echo e(csrf_token()); ?>"},
                        url: '<?php echo route('get_price_service'); ?>',
                        dataType: 'json',
                        success: function (res) {
                            if (sessionStorage.getItem(serviceId) && sessionStorage.getItem(serviceId) == serviceId) {
                                var total = parseFloat($("#total_price").val())-parseFloat(sessionStorage.getItem("price"+serviceId));
                                $("#total_price").val(total);
                            }
                            sessionStorage.setItem(serviceId, serviceId);
                            sessionStorage.setItem("price"+serviceId, res.data.price);
                            addServiceToTotalPrice(parseFloat(sessionStorage.getItem("price"+serviceId)));

                        },
                        error: function (res) {
                            alert('error' + res)
                        }
                    });

                }

                window.onbeforeunload = function(e) {
                    sessionStorage.clear();
                    $('#check_in').val("")
                };

                var total_services_storage = 0;
                function clearStorage() {
                    // console.log('ddd',sessionStorage.length);
                    // sessionStorage.clear();
                }

                // function clearStorageByRoomChange() {
                //     sessionStorage.clear();
                //     $('.services').empty();
                // }

                function addServiceToTotalPrice(service_price) {
                    var total = parseFloat($("#total_price").val())+service_price;
                    $("#total_price").val(total);
                }

            </script>
            <script>
                var reservation = JSON.parse('<?php echo json_encode($reservations); ?>');
                var rooms = JSON.parse('<?php echo json_encode($rooms); ?>');
                var data = JSON.parse('<?php echo json_encode($data) ?: 0; ?>');
                var data_id = <?php echo $data->id?:null ?: 0; ?>

                $(function () {
                    if (data && data_id) {
                        $('#room_id').prop('disabled', true);
                    } else {
                        checkNoDate();
                    }
                });
                function checkNoDate() {
                    if ($('#check_in').val() == "") {
                        $('#room_id').prop('disabled', true);
                    } else {
                        $('#room_id').prop('disabled', false);
                    }
                }
                // console.log(reservation);
                $('#check_in, #total_night').change(function () {
                    // console.log($('#check_in').val());
                    checkNoDate();

                    var time = new Date().toLocaleTimeString();
                    var select_date = $('#check_in').val() +' '+ time;

                    // var check_in = new Date(date);
                    var night = parseInt($('#total_night').val());
                    // console.log('night', night);
                    $.each(reservation, function (key, value) {
                        // console.log(key, value);
                        var array_check_in = [];
                        for (var i=0; i < value.length; i++) {
                            array_check_in[i] = [value[i].check_in, value[i].total_night, value[i].room_id];
                        }

                        // console.log(select_date);

                        ifFunc(array_check_in, select_date, night, 0);

                    });
                    if (data && data_id) {
                        $('#'+data.room_id+'room').removeProp('disabled');
                    }

                    $.each(rooms, function (key, value) {
                        if (value.status === 'maintenance') {
                            $('#'+value.id+'room').prop('disabled', true);
                            $('#'+value.id+'room > span').remove();
                            $('#'+value.id+'room').append(`<span> (Maintaining)</span>`);
                        }
                    });
                });

                $('#total_night').change(function () {
                    var total_service = '<?php echo $total_reservServ; ?>';
                    if($("#total_night").val() && $("#price").val()){
                        Calculated($('#price').val(),$('#total_night').val())
                    }
                    if($("#total_night").val() && $("#price").val() && $("#promotion_code").val()){
                        Calculated($('#price').val(),$('#total_night').val(),$("#promotion_code").val())
                    }

                    var s_total = parseFloat($("#total_price").val());
                    for (var i=0; i<sessionStorage.length/2;i++) {
                        if ($('#service'+i).val()) {
                            s_total += parseFloat(sessionStorage.getItem('priceservice'+i));
                        }
                    }
                    $("#total_price").val(s_total);

                    // console.log(total_service);
                    if (total_service) {
                        var total = parseFloat($("#total_price").val());
                        var total_service = parseFloat(total_service);
                        $("#total_price").val(total+total_service);
                    }
                    if(!$("#total_night").val()){
                        Calculated($('#price').val(),$('#total_night').val())
                    }
                });

                Date.prototype.addDays = function(days) {
                    var date = new Date(this.valueOf());
                    date.setDate(date.getDate() + days);
                    return date;
                };

                function ifFunc(array_check_in, select_date, night, i) {
                    var selected_date = new Date(select_date.substr(0, 10) + ' 12:00:01');
                    // console.log('selected_dat' , new Date(select_date.substr(0, 10) + ' 12:00:01'))
                    var sel_check_out = new Date(select_date.substr(0, 10) + ' 12:00:00');

                    var new_check_out = sel_check_out.addDays(night);
                    // console.log('new' , new_check_out)
                    var now = new Date();

                    var old_check_in = new Date(array_check_in[i][0].substr(0, 10) + ' 12:00:01');
                    // console.log('old', old_check_in);

                    var date = new Date(array_check_in[i][0].substr(0, 10) + ' 12:00:00');
                    var old_check_out = date.addDays(array_check_in[i][1]);
                    // console.log(old_check_out);
                    $('#'+array_check_in[i][2]+'room > span').remove();

                    if (((new_check_out < old_check_in && selected_date < old_check_in)
                        || (new_check_out > old_check_out && selected_date > old_check_out))

                        && ((selected_date < old_check_in || old_check_out < selected_date)
                        || (selected_date < old_check_in && old_check_out > selected_date)
                        || (selected_date > old_check_in && old_check_out < selected_date))) {
                        $('#'+array_check_in[i][2]+'room').removeAttr('disabled');
                        if (i < array_check_in.length-1) {
                            ifFunc(array_check_in, select_date, night, ++i);
                        }
                        // $('#'+array_check_in[i][2]+'room > span').remove();
                        // $('#'+array_check_in[i][2]+'room').append('<span> ว่าง</span>');
                    }
                    else {
                        $('#'+array_check_in[i][2]+'room').prop('disabled', true);
                        $('#'+array_check_in[i][2]+'room').append('<span> (ไม่ว่าง)</span>');
                        $('#not-selected').prop('selected', true);
                        if (data && data_id && data.room_id === array_check_in[i][2]) {
                            // console.log(reservation)
                            // for (var i=0;i<reservation;i++) {
                            //     var edit_check_in = new Date(array_check_in[i][0].substr(0, 10) + ' 12:00:01');
                            //     var date1 = new Date(edit_check_in.substr(0, 10) + ' 12:00:00');
                            //     var edit_check_out = date1.addDays(array_check_in[i][1]);
                            //     for (var j=0;j<reservation;j++) {
                            //         if (array_check_in[i][2] == reservation[i][j].room_id) {
                            //
                            //             var old_in = new Date(reservation[i][j].check_in.substr(0, 10) + ' 12:00:01');
                            //             var date2 = new Date(old_in.substr(0, 10) + ' 12:00:00');
                            //             var old_out = date2.addDays(reservation[i][j].total_night);
                            //             if ((edit_check_in == old_in && edit_check_out == old_out)
                            //             || (edit_check_in == old_in && edit_check_out == old_out)) {
                                            $('#'+array_check_in[i][2]+'room').removeAttr('disabled');
                                            $('#'+array_check_in[i][2]+'room > span').text('(ใช้งานอยู่)');
                            //             } else {
                            //             }
                            //         } else {
                            //             break;
                            //         }
                            //     }
                            // }
                        }
                    }

                }


            </script>

            <script>
                $("#data_promotion_not_found").hide()
                var date = new Date();
                date.setDate(date.getDate());
                $('#check_in').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd',
                    startDate: date,
                });

                $('#js-example-basic-hide-search-multi').select2(
                    {
                        theme: "bootstrap4",

                        placeholder: "-- Guest Name --",
// width: '100%',
// dropdownAutoWidth: true,
// allowClear: true
// { dropdownParent: "#modal-container" }
                    }
                );

                // $('#check_in').datetimepicker({
                //     // uiLibrary: 'bootstrap4',
                //     dateFormat: "yy-mm-dd",
                //     timeFormat:  "hh:mm:ss"
                // });
                // $('#check_in_room').datetimepicker({
                //     // uiLibrary: 'bootstrap4',
                //     dateFormat: "yy-mm-dd",
                //     timeFormat:  "hh:mm:ss"
                // });
                // $('#check_out').datetimepicker({
                //     // uiLibrary: 'bootstrap4'
                // });

                function Calculated(price,nights,discount) {
                    var  price = price;
                    var  nights = nights;
                    var total = 0;
                    if(!nights){
                        alert('กรุณากรอกจำนวนคืนที่เข้าพัก')
                        $("#total_price").val(parseInt(total*1))
                        return false;
                    }
                    if(!price){
                        alert('ราคาห้องพักไม่ถูกต้อง')
                        $('#total_night').val(1);
                        return false;
                    }

                    var discount = discount;
                    var total_nights  = (price*nights);

                    if(discount){
                        var total_discoun = (total_nights*discount)/100
                        total = (total_nights - total_discoun)
                    }else {
                        total = total_nights
                    }
                    $("#total_price").val(total)

                }

                function CalculatedBaht(price,nights,discount) {
                    var  price = price;
                    var  nights = nights;
                    var total = 0;
                    if(!nights){
                        alert('กรุณากรอกจำนวนคืนที่เข้าพัก')
                        return false;
                    }
                    if(!price){
                        alert('ราคาห้องพักไม่ถูกต้อง')
                        return false;
                    }

                    var discount = discount;
                    var total_nights  = (price*nights);

                    if(discount){
                        var total_discoun = (total_nights-discount)
                        total = total_discoun
                    }else {
                        total = total_nights
                    }
                    $("#total_price").val(total)

                }

                $(document).ready(function () {
                    $('#special_request_note').hide();
                    $('#special_request').change(function () {

                        $("#special_request").val()
// console.log( $("#special_request").val())
                        if ($("#special_request").val() === 'yes') {
                            $('#special_request_note').show();
                        } else {
                            $('#special_request_note').hide();
                        }
                    });

                    $('#room_id').change(function () {
                        var id = $("#room_id").val()
// console.log( $("#room_id").val())
                        $.ajax({
                            type: 'post',
                            data: {'id': id, "_token": "<?php echo e(csrf_token()); ?>"},
                            url: '<?php echo route('get_price_room'); ?>',
                            dataType: 'json',
                            success: function (res) {
                                Calculated(res.data.price,$("#total_night").val(),0)
                                $("#price").val(res.data.price)
                                // $("#total_price").val(res.data.price)
                                // $("#promotion_code").val(res.data.promotion_code)

                                var total_service = '<?php echo $total_reservServ; ?>';
                                $('#total_night').val($('#total_night').val());

                                if($("#total_night").val() && $("#price").val()){
                                    Calculated($('#price').val(),$('#total_night').val())
                                }
                                if($("#total_night").val() && $("#price").val() && $("#promotion_code").val()){
                                    Calculated($('#price').val(),$('#total_night').val(),$("#promotion_code").val())
                                }

                                var s_total = parseFloat($("#total_price").val());
                                for (var i=0; i<sessionStorage.length/2;i++) {
                                    if ($('#service'+i).val()) {
                                        s_total += parseFloat(sessionStorage.getItem('priceservice'+i));
                                    }
                                }
                                $("#total_price").val(s_total);


                                if (total_service) {
                                    var total = parseFloat($("#total_price").val());
                                    var total_service = parseFloat(total_service);
                                    $("#total_price").val(total+total_service);
                                }
                                if(!$("#total_night").val()){
                                    Calculated($('#price').val(),$('#total_night').val())
                                }
                            },
                            error: function (res) {
                                alert('error' + res)
                            }
                        });

                    });

                    // Nights
                    if($("#total_night").val() && $("#total_night").val() > 0){

                    }

                    $("#promotion_code").val(0)
                    $('#search_promotion_code').keyup(function () {
                        var promotion_code = $("#search_promotion_code").val()
// console.log( $("#room_id").val())
                        var  length = promotion_code.length

                        if(length >= 2){
                            $.ajax({
                                type: 'post',
                                data: {'code': promotion_code, "_token": "<?php echo e(csrf_token()); ?>"},
                                url: '<?php echo route('get_promotion'); ?>',
                                dataType: 'json',
                                success: function (res) {
                                    if(res.data && res.data.discount &&  res.data.status === 'active'){
                                        console.log("promotion_code"+res.data.discount)
                                        $("#promotion_code").val(res.data.discount)
                                        if($("#total_night").val() && $("#price").val(),res.data.discount){
                                            if(res.data.unit === 'Baht'){
                                                CalculatedBaht($("#price").val(),$("#total_night").val(),res.data.discount)
                                            }else {
                                                Calculated($("#price").val(),$("#total_night").val(),res.data.discount)
                                            }

                                        }
                                        $("#data_promotion_not_found").hide()
                                    }else {
                                        $("#promotion_code").val(0)
                                    }
                                    if(res.data && res.data.status === 'expired'){
                                        if($("#total_night").val() && $("#price").val()){
                                            Calculated($("#price").val(),$("#total_night").val(),0)
                                        }
                                        $("#data_promotion_not_found").hide()
                                        alert("promotion code expired.");

                                    }
                                    if(res.data && res.data.status === null){
                                        if($("#total_night").val() && $("#price").val()){
                                            Calculated($("#price").val(),$("#total_night").val(),0)
                                        }
                                        $("#data_promotion_not_found").hide()
                                        alert("promotion code not ready yet.");
                                    }
                                    if(!res.data){
                                        if($("#total_night").val() && $("#price").val()){
                                            Calculated($("#price").val(),$("#total_night").val(),0)
                                        }
                                        $("#data_promotion_not_found").show()
                                    }

                                        },
                                error: function (res) {
                                    // alert('data promotion not found')
                                    $("#data_promotion_not_found").show()
                                }
                            });


                        }

                    });

                    // $('#total_night').keyup(function () {
                    //     if($("#total_night").val() && $("#price").val()){
                    //         Calculated($("#price").val(),$("#total_night").val(),0)
                    //     }
                    //     if($("#total_night").val() && $("#price").val() && $("#promotion_code").val()){
                    //         Calculated($("#price").val(),$("#total_night").val(),$("#promotion_code").val())
                    //     }
                    // });

                });

            </script>
            <script>
                // requires jquery library
                jQuery(document).ready(function() {
                    jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
                });
            </script>


    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/reservation/add.blade.php ENDPATH**/ ?>