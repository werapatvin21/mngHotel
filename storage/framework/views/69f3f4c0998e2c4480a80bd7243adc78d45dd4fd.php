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
        <title>HotelCloud - Add New guest & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
                
            </div>
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-2">
                <a class="btn btn--custom" href="<?php echo e(route('guest.index')); ?>"
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
                            <?php if(!$detail): ?>
                                <?php if($data && $data->id): ?>
                                    Edit
                                <?php else: ?>
                                    Add

                                <?php endif; ?>

                            <?php else: ?>
                                Detail
                            <?php endif; ?>
                            Guest
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
              action="<?php echo e($data->id ? route('guest.update', ['id' => $data->id]) : route('guest.store')); ?>"
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
                                <label for="guest_name" class="col-sm-4 col-form-label">First
                                    Name
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           class="form-control"
                                           name="first_name"
                                           value="<?php echo e($data->first_name); ?>"

                                           <?php if($detail != 0): ?>
                                           readonly="<?php echo e($detail?:1); ?>"
                                           <?php endif; ?>
                                           required

                                           id="first_name"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_lastname" class="col-sm-4 col-form-label">Last
                                    Name
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8"><input type="text"
                                                             class="form-control"
                                                             value="<?php echo e($data->last_name); ?>"
                                                             <?php if($detail != 0): ?>
                                                             readonly="<?php echo e($detail?:1); ?>"
                                                             <?php endif; ?>
                                                             required
                                                             name="last_name" id="last_name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_nationalID"
                                       class="col-sm-4 col-form-label">National ID</label>
                                <div class="col-sm-8"><input type="text"
                                                             class="form-control"
                                                             value="<?php echo e($data->card_id); ?>"
                                                             <?php if($detail != 0): ?>
                                                             readonly="<?php echo e($detail?:1); ?>"
                                                             <?php endif; ?>
                                                             id="card_id" name="card_id">
                                    <?php if($errors->has('card_id')): ?>
                                        <span class="help-block" style="color: #ff4d4d">
                                        <strong>The national ID has already been taken.</strong>
                                    </span>
                                    <?php endif; ?>
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
                                                             value="<?php echo e($data->passport_id); ?>"
                                                             <?php if($detail != 0): ?>
                                                             readonly="<?php echo e($detail?:1); ?>"
                                                             <?php endif; ?>
                                                             name="passport_id">
                                    <?php if($errors->has('passport_id')): ?>
                                        <span class="help-block" style="color: #ff4d4d">
                                        <strong>The passport ID has already been taken.</strong>
                                    </span>
                                    <?php endif; ?></div>
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
                                                             class="form-control" id="email"
                                                             placeholder="abc@def.com"
                                                             value="<?php echo e($data->email); ?>"
                                                             <?php if($detail != 0): ?>
                                                             readonly="<?php echo e($detail?:1); ?>"
                                                             <?php endif; ?>
                                                             required
                                                             name="email">
                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block" style="color: #ff4d4d">
                                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                                        </span>
                                    <?php endif; ?>
                                </div>
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
                                                             value="<?php echo e($data->phone); ?>"
                                                             <?php if($detail != 0): ?>
                                                             readonly="<?php echo e($detail?:1); ?>"
                                                             <?php endif; ?>
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
                                    </span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="country"
                                            <?php if($detail != 0): ?>
                                            disabled
                                            <?php endif; ?>
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
                                                                <textarea rows="2" type="text" class="form-control"
                                                                          id="address" name="address"
                                                                          <?php if($detail != 0): ?>
                                                                          readonly="<?php echo e($detail?:1); ?>"
                                                                        <?php endif; ?>
                                                                >
                                                                   <?php echo e($data->address); ?>


                                                                </textarea>
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
                                            <?php if($detail != 0): ?>
                                            disabled
                                            <?php endif; ?>
                                            name="file_type">
                                        <option value="<?php echo e('national_id'); ?>"
                                                <?php if($data->file_type === 'national_id'): ?> selected <?php endif; ?>>National ID
                                        </option>
                                        <option value="<?php echo e('passport_id'); ?>"
                                                <?php if($data->file_type === 'passport_id'): ?> selected <?php endif; ?>>Passport ID
                                        </option>
                                        <option value="<?php echo e('other'); ?>"
                                                <?php if($data->file_type === 'other'): ?> selected <?php endif; ?>>Other
                                        </option>
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
                                    <?php if($detail != 1): ?>
                                        <input type="file" class="form-control-file" id="file"
                                               <?php if($detail != 0): ?>
                                               readonly="<?php echo e($detail?:1); ?>"
                                               <?php endif; ?>
                                               <?php if(!$data->file): ?>
                                               <?php endif; ?>
                                               required
                                               name="file">
                                    <?php endif; ?>
                                    <?php if($data->file): ?>
                                        <a href="<?php echo e(url($data->file ?: '')); ?>" target="_blank">View:file</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guest_note">Note: </label>
                        <textarea class="form-control" id="note" rows="2"
                                  <?php if($detail != 0): ?>
                                  readonly="<?php echo e($detail?:1); ?>"
                                  <?php endif; ?>
                                  name="note"><?php echo e($data->note); ?></textarea>
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

    <script>
        $('#js-example-basic-hide-search-multi').select2(
            {
                theme: "bootstrap4",
                placeholder: "-- Countries --",
            }
        );

        $('#staff_birth').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/guests/add.blade.php ENDPATH**/ ?>