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
            <div class="col-3">
            </div>
            <div class="col-3">
            </div>
            <div class="col-3">
            </div>
            <div class="col-3">
                <a  class="btn btn--custom" href="<?php echo e(route('services.index')); ?>"
                    style="background-color: #0a6aa1;color:#fff;border-radius: 5px;float: right;"
                    role="button">
                    <i class="fas fa-back"></i> Back
                </a>
            </div>
        </div>
    </div>

    <form class="m-form m-form--fit " enctype="multipart/form-data"
          
          action="<?php echo e(route('servicesType.store')); ?>"
          method="POST">
        <?php echo csrf_field(); ?>
        <?php if($data && $data->id): ?>
            <input type="hidden" name="services_id" value="<?php echo e($data->id); ?>">
            
        <?php endif; ?>
    <!--================ Modal New Service Type =================-->
    <div class="modal fade" id="newServiceType" tabindex="-1" role="dialog" aria-labelledby="addNewServiceType" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewServiceType">Add New Service Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"> <!-- ส่วนนี้จริงๆ ต้องดึงข้อมูลมาจาก DB ส่วน "Service Type" มาแสดง -->
                    <?php $__currentLoopData = $services_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $services_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col">
                                <?php echo e($services_type->name); ?>

                            </div>
                            <div class="col">
                                <a href="<?php echo e(url('/services_type/'.$services_type->id.'/destroy')); ?>">
                                    <ion-icon name="trash"></ion-icon> <!-- อันนี้ต้องเขียนแบบว่า room ไหนมีกาารใช้ type นั้นอยู่ ก็จะกดลบไม่ได้ด้วยปะ-->
                                </a>


                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <br>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="serviceType">New Service Type: </span>
                        </div>
                        <input required type="text" class="form-control" aria-label="Small" aria-describedby="serviceType" id="serviceType" name="name">
                        <!-- ส่วนนี้ จะรับข้อมูลแล้วเอาไปแสดงด้านบน -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Modal New Service Type =================-->
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
                                Services
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
              action="<?php echo e($data->id ? route('services.update', ['id' => $data->id]) : route('services.store')); ?>"
              method="POST">
            <?php echo csrf_field(); ?>
            <?php if($data && $data->id): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
        <div class="m-portlet__body" id="eventTable">
            <div class="container">

                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="service_name" class="col-sm-4 col-form-label">Service Name
                                <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                            <div class="col-sm-8">
                                <input type="text"
                                       required
                                       value="<?php echo e($data->name); ?>"
                                       <?php if($detail != 0): ?>
                                       disabled
                                       <?php endif; ?>
                                       class="form-control" id="service_name"
                                       name="name"></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="service_type" class="col-sm-4 col-form-label">Service Type
                                <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                            <div class="col-sm-8">
                                <?php $services_types_old = old('service_type',$data->service_type); ?>
                                <select class="form-control"
                                        required
                                        <?php if($detail != 0): ?>
                                        disabled
                                        <?php endif; ?>
                                        id="service_type" name="service_type">
                                    <option value="">-- Select --</option>
                                    <?php $__currentLoopData = $services_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $services_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php echo e($services_type->id === $services_types_old ?'selected':''); ?> value="<?php echo e($services_type->id); ?>"> <?php echo e($services_type->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label for="service_price" class="col-sm-4 col-form-label">Price
                                <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                            <div class="col-sm-8 my-1">
                                <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                <div class="input-group">
                                    <input type="number" class="form-control"
                                           required
                                           <?php if($detail != 0): ?>
                                           disabled
                                           <?php endif; ?>
                                           name="price"
                                           value="<?php echo e($data->price ?:''); ?>"
                                           min="0"
                                           id="service_price">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">฿</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="service_status" class="col-sm-4 col-form-label">Status
                                <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                            <div class="col-sm-8">
                                <select class="form-control"
                                    required
                                    <?php if($detail != 0): ?>
                                    disabled
                                    <?php endif; ?>
                                    name="status"
                                    id="service_status">
                                    <option value="">-- Select --</option>
                                    <option value="<?php echo e('Available'); ?>" <?php if($data->status === 'Available'): ?> selected <?php endif; ?>>Available</option>
                                    <option value="<?php echo e('Not Available'); ?>" <?php if($data->status === 'Not Available'): ?> selected <?php endif; ?>>Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                        
                            
                            
                                
                                
                                    
                                           
                                           
                                           
                                           
                                           
                                           
                                           
                                           
                                    
                                        
                                    
                                
                            
                        
                    
                </div>
            
                
                    
                        
                        
                            
                                    
                                    
                                    
                                    
                                    
                                    
                                
                                
                                
                            
                        
                    
                
            
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
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>


        <script>
            $('#service_price').change(function () {
                if(parseFloat($('#service_price').val()) < parseFloat($('#service_cost').val())) {
                    $('#service_price').val('');
                }
            });

            $('#service_cost').change(function () {
                if(parseFloat($('#service_cost').val()) > parseFloat($('#service_price').val())) {
                    $('#service_cost').val('');
                }
            });
        </script>
        <script>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/services/add.blade.php ENDPATH**/ ?>