<?php $__env->startSection('content'); ?>
    <style>


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
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <title>HotelCloud - Room Management</title>
    </head>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col  d-flex flex-row-reverse">
                <div class="btn-group" role="group" aria-label="Basic example" style="">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#newType"><ion-icon name="add-circle-outline"></ion-icon>New Room Type</button>
                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#spePrice"><ion-icon name="checkmark-circle-outline"></ion-icon>Special Prices</button>
                    <div class="col-3">
                        <a  class="btn btn--custom" href="<?php echo e(route('room.index')); ?>"
                            style="background-color: #0a6aa1;color:#fff;border-radius: 5px;float: right;"
                            role="button">
                            <i class="fas fa-back"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="m-form m-form--fit " enctype="multipart/form-data"
          
          action="<?php echo e(route('room_type.store')); ?>"
          method="POST">
    <?php echo csrf_field(); ?>
    <?php if($data && $data->id): ?>
            <input type="hidden" name="room_id" value="<?php echo e($data->id); ?>">
        
    <?php endif; ?>


    <!--================ End Room Setting =================-->

    <!--================ Modal New Room Type =================-->
    <div class="modal fade" id="newType" tabindex="-1" role="dialog" aria-labelledby="addNewRoomType" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewRoomType">Add New Room Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ส่วนนี้จริงๆ ต้องดึงข้อมูลมาจาก DB ส่วน "Room Type" มาแสดง -->
                    <?php $__currentLoopData = $room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col">
                                <?php echo e($room_type->name); ?>

                            </div>
                            <div class="col">
                                <a href="<?php echo e(url('/room_types/'.$room_type->id.'/destroy')); ?>">
                                    <ion-icon name="trash"></ion-icon> <!-- อันนี้ต้องเขียนแบบว่า room ไหนมีกาารใช้ type นั้นอยู่ ก็จะกดลบไม่ได้ด้วยปะ-->
                                </a>


                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">New Room Type
                                 <span class="help-block" style="color: #ff4d4d">
                                    <strong>*</strong>
                                </span>
                                : </span>
                        </div>
                        <input type="text" required class="form-control" name="name_room_types" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="roomType">
                        <!-- ส่วนนี้ จะรับข้อมูลแล้วเอาไปแสดงด้านบน -->
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>

            </div>
        </div>
    </div>
    </form>

    <!--================ End Modal New Room Type =================-->

    <form class="m-form m-form--fit " enctype="multipart/form-data"
          action="<?php echo e($special_price->id ? route('special_price.update', ['id' => $special_price->id]) : route('special_price.store')); ?>"
          method="POST">
    <?php echo csrf_field(); ?>
    <?php if($special_price && $special_price->id): ?>
        <input type="hidden" name="room_id" value="<?php echo e($data->id); ?>">
        <?php echo method_field('PUT'); ?>

    <?php endif; ?>

    <!--================ Modal Special Prices =================-->
    <div class="modal fade" id="spePrice" tabindex="-1" role="dialog" aria-labelledby="spePriceSet" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="spePriceSet">Special Price Setting</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <b>Select the days when your room have different price such as Friday, Saturday, Sunday</b> <br><br>
                    <div class="row">
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->monday != 0): ?> checked <?php endif; ?> name="monday">Monday
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->tuesday != 0): ?>  checked <?php endif; ?> name="tuesday" >Tuesday
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->wednesday != 0): ?>  checked <?php endif; ?>  name="wednesday"
                                    >Wednesday
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->thursday != 0): ?>  checked <?php endif; ?>  name="thursday"
                                    >Thursday
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->friday != 0): ?> checked <?php endif; ?> name="friday"
                                    >Friday
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->saturday != 0): ?>  checked <?php endif; ?>  name="saturday"
                                    >Saturday
                                </label>
                            </div>
                            <div class="form-check-inline disabled">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input"
                                           <?php if($special_price->sunday != 0): ?>  checked <?php endif; ?>  name="sunday"
                                    >Sunday
                                </label>
                            </div>
                        </div>
                    </div>

                    <br><br> <b>Select the days when your room have different price for High Season </b><br><br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="HignSeasonStart" class="col-sm-4 col-form-label">
                                            High Season Start
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="datepicker_HignSeasonStart"
                                                   value="<?php echo e($special_price->season_start); ?>"
                                                   name="season_start"
                                                   required
                                                   width="235" /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="HignSeasonEnd" class="col-sm-4 col-form-label">
                                            High Season End
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="datepicker_HignSeasonEnd" width="235"
                                                   name="season_end"
                                                   required
                                                   value="<?php echo e($special_price->season_end); ?>"
                                            /></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Modal Special Prices =================-->
    </form>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head" style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            <?php if(!$detail): ?>
                                <?php if($data && $data->id): ?>
                                    Edit
                                    <?php else: ?>
                                    Add New

                                <?php endif; ?>

                                <?php else: ?>
                                Detail
                                <?php endif; ?>
                                Room
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

        <form class="m-form m-form--fit " enctype="multipart/form-data"
              action="<?php echo e($data->id ? route('room.update', ['id' => $data->id]) : route('room.store')); ?>"
              method="POST">
            <?php echo csrf_field(); ?>
            <?php if($data && $data->id): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
        <div class="m-portlet__body" id="eventTable">
            <div class="container">
                <form action="">
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="room_name" class="col-sm-4 col-form-label">Room
                                    <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"
                                           <?php if($detail != 0): ?>
                                           readonly="<?php echo e($detail); ?>"
                                           <?php endif; ?>
                                           value="<?php echo e($data->name); ?>" id="room_name" name="name" required>
                                    <small class="form-text text-muted">Fill the Room's Name or Room's Number</small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="room_type" class="col-sm-4 col-form-label" required>Room Type</label>
                                <div class="col-sm-8">
                                    <?php $room_type_old = old('room_type',$data->room_type); ?>
                                    <select class="form-control" id="roomType"
                                            <?php if($detail != 0): ?>
                                            readonly="<?php echo e($detail); ?>"
                                            disabled
                                            <?php endif; ?>
                                            name="room_type"> <!-- ส่วนนี้ต้องดึงข้อมูลจาก room type ที่ผู้ใช้ตั้งค่า มาแสดง-->
                                        <option value="">-- Select --</option>
                                        <?php $__currentLoopData = $room_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php echo e($room_type->id === $room_type_old ?'selected':''); ?> value="<?php echo e($room_type->id); ?>"> <?php echo e($room_type->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="room_price" class="col-sm-4 col-form-label">Normal Price
                                    <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                </label>
                                <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                        <input type="number"  value="<?php echo e($data->price); ?>"
                                               <?php if($detail != 0): ?>
                                               readonly="<?php echo e($detail); ?>"
                                               <?php endif; ?>
                                               required class="form-control" id="room_price" name="room_price">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">฿</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="room_specialPrice" class="col-sm-4 col-form-label">Special Price</label>
                                <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control"
                                               <?php if($detail != 0): ?>
                                               readonly="<?php echo e($detail); ?>"
                                               <?php endif; ?>
                                               value="<?php echo e($data->room_special_price); ?>" id="room_specialPrice" name="room_specialPrice">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">฿</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="room_seasonPrice" class="col-sm-4 col-form-label">High Season Price</label>
                                <div class="col-sm-8 my-1">
                                    <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control"
                                               <?php if($detail != 0): ?>
                                               readonly="<?php echo e($detail); ?>"
                                               <?php endif; ?>
                                               value="<?php echo e($data->room_season_price); ?>" id="room_seasonPrice" name="room_seasonPrice">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">฿</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="room_status" class="col-sm-4 col-form-label">Room Status
                                    <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="room_status" name="room_status"
                                            <?php if($detail != 0): ?>
                                            readonly="<?php echo e($detail); ?>"
                                            disabled
                                            <?php endif; ?>
                                            required>
                                        <option value="">-- Select --</option>
                                        <option value="<?php echo e('available'); ?>" <?php if($data->status === 'available'): ?> selected <?php endif; ?>>Available</option>
                                        <option value="<?php echo e('maintenance'); ?>" <?php if($data->status === 'maintenance'): ?> selected <?php endif; ?>>Maintenance</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <?php if($detail != 1): ?>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                            Save
                        </button>
                    </div>
                <?php endif; ?>

            </div>
        </div>
        </form>
    </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('scripts'); ?>
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
        <script>
            <?php $RoomType = session()->pull('RoomType') ?>
            let RoomType =  '<?php echo e($RoomType?:0); ?>'
            if(RoomType && RoomType === '1'){
                $('#newType').modal('show');
            }else {
                RoomType = 0
            }
            $('#staff_birth').datepicker({
                // uiLibrary: 'bootstrap4'
            });
        </script>
        <script>
            $('#datepicker_HignSeasonStart').datepicker({
                // uiLibrary: 'bootstrap4'
            });
            $('#datepicker_HignSeasonEnd').datepicker({
                // uiLibrary: 'bootstrap4'
            });
            $('#promo_datepickerStart').datepicker({
                // uiLibrary: 'bootstrap4'
            });
            $('#promo_datepickerEnd').datepicker({
                // uiLibrary: 'bootstrap4'
            });
            $('#editPromo_datepickerStart').datepicker({
                // uiLibrary: 'bootstrap4'
            });
            $('#editPromo_datepickerEnd').datepicker({
                // uiLibrary: 'bootstrap4'
            });
        </script>
   <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/room/add.blade.php ENDPATH**/ ?>