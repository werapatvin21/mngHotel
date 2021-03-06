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

        <!-- icon -->
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <title>HotelCloud - Add New Staff & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
                
            </div>
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-2">
                <a  class="btn btn--custom" href="<?php echo e(route('staff.index')); ?>"
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

                            <?php if($detail === 0): ?>
                                Edit
                            <?php endif; ?>
                            <?php if(!$detail && $detail === null): ?>
                                Create New
                            <?php else: ?>
                            <?php endif; ?>
                            Staff Account
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
              action="<?php echo e($data->id ? route('staff.update', ['type_id' => $data->id]) : route('staff.store')); ?>"
              method="POST">
            <?php echo csrf_field(); ?>
            <?php if($data && $data->id): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
            <div class="m-portlet__body" id="eventTable">
                <div class="container">

                    <div  id="newStaff">
                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_name" class="col-sm-4 col-form-label">
                                            Full Name
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     value="<?php echo e(old('staff_name',$data->name)); ?>"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>
                                                                     required
                                                                     name="staff_name" id="staff_name"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_id" class="col-sm-4 col-form-label">
                                            Staff ID
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"
                                                   value="<?php echo e(old('staff_id',$data->id)); ?>"
                                                   <?php if($detail != 0): ?>
                                                   readonly="<?php echo e($detail); ?>"
                                                   <?php endif; ?>
                                                   readonly
                                                   name="staff_id" id="staff_name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_username" class="col-sm-4 col-form-label">
                                            Username
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>
                                                                      required
                                                                     value="<?php echo e(old('staff_username',$data->staff_username)); ?>"
                                                                     name="staff_username" id="staff_username"></div>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label">
                                            Password
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>

                                        <div class="col-sm-8">
                                            <?php if(!$data->id): ?>
                                                <input type="password" class="form-control"
                                                       required
                                                       name="password" id="password">

                                            <?php else: ?>
                                                   <?php if($detail != 1): ?>
                                                    <a href="<?php echo e(route('staff.change_pwd')); ?>?staff_id=<?php echo e($data->id); ?>" target="_blank">เปลี่ยนรหัสผ่าน</a>
                                                       <?php else: ?>
                                                        เปลี่ยนรหัสผ่าน
                                                        <?php endif; ?>


                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_id" class="col-sm-4 col-form-label">Date of Birth</label>
                                        <div class="col-sm-8"><input
                                                class="form-control" name="staff_birth" id="staff_birth"
                                                <?php if($detail != 0): ?>
                                                readonly="<?php echo e($detail); ?>"
                                                <?php endif; ?>
                                                value="<?php echo e(old('staff_birth',$data->staff_birth)); ?>"

                                                width="235"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_weigth" class="col-sm-4 col-form-label">Age</label>
                                        <div class="col-sm-8">
                                            <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control"  min="0" name="staff_age"



                                                       readonly
                                                       value="<?php echo e(old('staff_age',$data->staff_age)); ?>"

                                                       id="staff_age">
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
                                                <input type="number" class="form-control" min="50" name="staff_height"
                                                       <?php if($detail != 0): ?>
                                                       readonly="<?php echo e($detail); ?>"

                                                       <?php endif; ?>
                                                       value="<?php echo e(old('staff_height',$data->staff_height)); ?>"
                                                       id="staff_height">
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
                                                <input type="number" class="form-control" min="30" name="staff_weight"
                                                       <?php if($detail != 0): ?>
                                                       readonly="<?php echo e($detail); ?>"
                                                       <?php endif; ?>

                                                       value="<?php echo e(old('staff_weight',$data->staff_weight)); ?>"
                                                       id="staff_weight">
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
                                            <select class="form-control" name="department" id="department"
                                                    <?php if($detail != 0): ?>
                                                    disabled
                                                    <?php endif; ?>

                                            >
                                                <option value="">-- Select --</option>
                                                <option value="Reception" <?php echo e(old('department',$data->department) == 'Reception' ? 'selected' : ''); ?>>Reception</option>
                                                <option value="Housekeeping" <?php echo e(old('department',$data->department) == 'Housekeeping' ? 'selected' : ''); ?>>Housekeeping</option>
                                                <option value="Food and Beverage" <?php echo e(old('department',$data->department) == 'Food and Beverage' ? 'selected' : ''); ?>>Food and Beverage</option>
                                                <option value="Owner-Board" <?php echo e(old('department',$data->department) == 'Owner-Board' ? 'selected' : ''); ?>> Owner-Board</option>
                                                <option value="Housekeeping" <?php echo e(old('department',$data->department) == 'Housekeeping' ? 'selected' : ''); ?>> Housekeeping</option>
                                                <option value="Food and Beverage" <?php echo e(old('department',$data->department) == 'Food and Beverage' ? 'selected' : ''); ?>> Food and Beverage</option>
                                                <option value="Other" <?php echo e(old('department',$data->department) == 'Other' ? 'selected' : ''); ?>> Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_pos" class="col-sm-4 col-form-label">Position</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>

                                                                     value="<?php echo e(old('staff_pos',$data->staff_pos)); ?>"
                                                                     name="staff_pos" id="staff_pos"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>

                                                                     name="staff_address" id="staff_address"
                                                                     value="<?php echo e(old('staff_address',$data->staff_address)); ?>"
                                                                     placeholder="1234 Main St"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress2" class="col-sm-4 col-form-label">Address 2</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>
                                                                     value="<?php echo e(old('staff_address2'?:$data->staff_address2)); ?>"
                                                                     name="staff_address2" id="staff_address2"
                                                                     placeholder="Apartment, studio, or floor">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress3" class="col-sm-4 col-form-label">Address 3</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>
                                                                     value="<?php echo e(old('staff_address3'?:$data->staff_address3)); ?>"
                                                                     name="staff_address3" id="staff_address3"
                                                                     placeholder="City">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_province" class="col-sm-4 col-form-label">Province</label>
                                        <div class="col-sm-8">
                                            <select name="staff_province" id="staff_province" class="form-control"
                                                    <?php if($detail != 0): ?>
                                                    disabled
                                                    <?php endif; ?>

                                            >
                                                <option value="">-- Select --</option>
                                                <option value="กรุงเทพมหานคร" <?php echo e($data->staff_province == 'กรุงเทพมหานคร' ? 'selected':''); ?>>กรุงเทพมหานคร</option>
                                                <option value="กระบี่" <?php echo e($data->staff_province == 'กระบี่' ? 'selected':''); ?>>กระบี่ </option>
                                                <option value="กาญจนบุรี" <?php echo e($data->staff_province == 'กาญจนบุรี' ? 'selected':''); ?>>กาญจนบุรี </option>
                                                <option value="กาฬสินธุ์" <?php echo e($data->staff_province == 'กาฬสินธุ์' ? 'selected':''); ?>>กาฬสินธุ์ </option>
                                                <option value="กำแพงเพชร" <?php echo e($data->staff_province == 'กำแพงเพชร' ? 'selected':''); ?>>กำแพงเพชร </option>
                                                <option value="ขอนแก่น" <?php echo e($data->staff_province == 'ขอนแก่น' ? 'selected':''); ?>>ขอนแก่น</option>
                                                <option value="จันทบุรี" <?php echo e($data->staff_province == 'จันทบุรี' ? 'selected':''); ?>>จันทบุรี</option>
                                                <option value="ฉะเชิงเทรา" <?php echo e($data->staff_province == 'ฉะเชิงเทรา' ? 'selected':''); ?>>ฉะเชิงเทรา </option>
                                                <option value="ชัยนาท" <?php echo e($data->staff_province == 'ชัยนาท' ? 'selected':''); ?>>ชัยนาท </option>
                                                <option value="ชัยภูมิ" <?php echo e($data->staff_province == 'ชัยภูมิ' ? 'selected':''); ?>>ชัยภูมิ </option>
                                                <option value="ชุมพร" <?php echo e($data->staff_province == 'ชุมพร' ? 'selected':''); ?>>ชุมพร </option>
                                                <option value="ชลบุรี" <?php echo e($data->staff_province == 'ชลบุรี' ? 'selected':''); ?>>ชลบุรี </option>
                                                <option value="เชียงใหม่" <?php echo e($data->staff_province == 'เชียงใหม่' ? 'selected':''); ?>>เชียงใหม่ </option>
                                                <option value="เชียงราย" <?php echo e($data->staff_province == 'เชียงราย' ? 'selected':''); ?>>เชียงราย </option>
                                                <option value="ตรัง" <?php echo e($data->staff_province == 'ตรัง' ? 'selected':''); ?>>ตรัง </option>
                                                <option value="ตราด" <?php echo e($data->staff_province == 'ตราด' ? 'selected':''); ?>>ตราด </option>
                                                <option value="ตาก" <?php echo e($data->staff_province == 'ตาก' ? 'selected':''); ?>>ตาก </option>
                                                <option value="นครนายก" <?php echo e($data->staff_province == 'นครนายก' ? 'selected':''); ?>>นครนายก </option>
                                                <option value="นครปฐม" <?php echo e($data->staff_province == 'นครปฐม' ? 'selected':''); ?>>นครปฐม </option>
                                                <option value="นครพนม" <?php echo e($data->staff_province == 'นครพนม' ? 'selected':''); ?>>นครพนม </option>
                                                <option value="นครราชสีมา" <?php echo e($data->staff_province == 'นครราชสีมา' ? 'selected':''); ?>>นครราชสีมา </option>
                                                <option value="นครศรีธรรมราช" <?php echo e($data->staff_province == 'นครศรีธรรมราช' ? 'selected':''); ?>>นครศรีธรรมราช </option>
                                                <option value="นครสวรรค์" <?php echo e($data->staff_province == 'นครสวรรค์' ? 'selected':''); ?>>นครสวรรค์ </option>
                                                <option value="นราธิวาส" <?php echo e($data->staff_province == 'นราธิวาส' ? 'selected':''); ?>>นราธิวาส </option>
                                                <option value="น่าน" <?php echo e($data->staff_province == 'น่าน' ? 'selected':''); ?>>น่าน </option>
                                                <option value="นนทบุรี" <?php echo e($data->staff_province == 'นนทบุรี' ? 'selected':''); ?>>นนทบุรี </option>
                                                <option value="บึงกาฬ" <?php echo e($data->staff_province == 'บึงกาฬ' ? 'selected':''); ?>>บึงกาฬ</option>
                                                <option value="บุรีรัมย์" <?php echo e($data->staff_province == 'บุรีรัมย์' ? 'selected':''); ?>>บุรีรัมย์</option>
                                                <option value="ประจวบคีรีขันธ์" <?php echo e($data->staff_province == 'ประจวบคีรีขันธ์' ? 'selected':''); ?>>ประจวบคีรีขันธ์ </option>
                                                <option value="ปทุมธานี" <?php echo e($data->staff_province == 'ปทุมธานี' ? 'selected':''); ?>>ปทุมธานี </option>
                                                <option value="ปราจีนบุรี" <?php echo e($data->staff_province == 'ปราจีนบุรี' ? 'selected':''); ?>>ปราจีนบุรี </option>
                                                <option value="ปัตตานี" <?php echo e($data->staff_province == 'ปัตตานี' ? 'selected':''); ?>>ปัตตานี </option>
                                                <option value="พะเยา" <?php echo e($data->staff_province == 'พะเยา' ? 'selected':''); ?>>พะเยา </option>
                                                <option value="พระนครศรีอยุธยา" <?php echo e($data->staff_province == 'พระนครศรีอยุธยา' ? 'selected':''); ?>>พระนครศรีอยุธยา </option>
                                                <option value="พังงา" <?php echo e($data->staff_province == 'พังงา' ? 'selected':''); ?>>พังงา </option>
                                                <option value="พิจิตร" <?php echo e($data->staff_province == 'พิจิตร' ? 'selected':''); ?>>พิจิตร </option>
                                                <option value="พิษณุโลก" <?php echo e($data->staff_province == 'พิษณุโลก' ? 'selected':''); ?>>พิษณุโลก </option>
                                                <option value="เพชรบุรี" <?php echo e($data->staff_province == 'เพชรบุรี' ? 'selected':''); ?>>เพชรบุรี </option>
                                                <option value="เพชรบูรณ์" <?php echo e($data->staff_province == 'เพชรบูรณ์' ? 'selected':''); ?>>เพชรบูรณ์ </option>
                                                <option value="แพร่" <?php echo e($data->staff_province == 'แพร่' ? 'selected':''); ?>>แพร่ </option>
                                                <option value="พัทลุง" <?php echo e($data->staff_province == 'พัทลุง' ? 'selected':''); ?>>พัทลุง </option>
                                                <option value="ภูเก็ต" <?php echo e($data->staff_province == 'ภูเก็ต' ? 'selected':''); ?>>ภูเก็ต </option>
                                                <option value="มหาสารคาม" <?php echo e($data->staff_province == 'มหาสารคาม' ? 'selected':''); ?>>มหาสารคาม </option>
                                                <option value="มุกดาหาร" <?php echo e($data->staff_province == 'มุกดาหาร' ? 'selected':''); ?>>มุกดาหาร </option>
                                                <option value="แม่ฮ่องสอน" <?php echo e($data->staff_province == 'แม่ฮ่องสอน' ? 'selected':''); ?>>แม่ฮ่องสอน </option>
                                                <option value="ยโสธร" <?php echo e($data->staff_province == 'ยโสธร' ? 'selected':''); ?>>ยโสธร </option>
                                                <option value="ยะลา" <?php echo e($data->staff_province == 'ยะลา' ? 'selected':''); ?>>ยะลา </option>
                                                <option value="ร้อยเอ็ด" <?php echo e($data->staff_province == 'ร้อยเอ็ด' ? 'selected':''); ?>>ร้อยเอ็ด </option>
                                                <option value="ระนอง" <?php echo e($data->staff_province == 'ระนอง' ? 'selected':''); ?>>ระนอง </option>
                                                <option value="ระยอง" <?php echo e($data->staff_province == 'ระยอง' ? 'selected':''); ?>>ระยอง </option>
                                                <option value="ราชบุรี" <?php echo e($data->staff_province == 'ราชบุรี' ? 'selected':''); ?>>ราชบุรี</option>
                                                <option value="ลพบุรี" <?php echo e($data->staff_province == 'ลพบุรี' ? 'selected':''); ?>>ลพบุรี </option>
                                                <option value="ลำปาง" {$data->staff_province == 'ลำปาง' ? 'selected':''}}>ลำปาง </option>
                                                <option value="ลำพูน" <?php echo e($data->staff_province == 'ลำพูน' ? 'selected':''); ?>>ลำพูน </option>
                                                <option value="เลย" <?php echo e($data->staff_province == 'เลย' ? 'selected':''); ?>>เลย </option>
                                                <option value="ศรีสะเกษ" <?php echo e($data->staff_province == 'ศรีสะเกษ' ? 'selected':''); ?>>ศรีสะเกษ</option>
                                                <option value="สกลนคร" <?php echo e($data->staff_province == 'สกลนคร' ? 'selected':''); ?>>สกลนคร</option>
                                                <option value="สงขลา" <?php echo e($data->staff_province == 'สงขลา' ? 'selected':''); ?>>สงขลา </option>
                                                <option value="สมุทรสาคร" <?php echo e($data->staff_province == 'สมุทรสาคร' ? 'selected':''); ?>>สมุทรสาคร </option>
                                                <option value="สมุทรปราการ" <?php echo e($data->staff_province == 'สมุทรปราการ' ? 'selected':''); ?>>สมุทรปราการ </option>
                                                <option value="สมุทรสงคราม" <?php echo e($data->staff_province == 'สมุทรสงคราม' ? 'selected':''); ?>>สมุทรสงคราม </option>
                                                <option value="สระแก้ว" <?php echo e($data->staff_province == 'สระแก้ว' ? 'selected':''); ?>>สระแก้ว </option>
                                                <option value="สระบุรี" <?php echo e($data->staff_province == 'สระบุรี' ? 'selected':''); ?>>สระบุรี </option>
                                                <option value="สิงห์บุรี" <?php echo e($data->staff_province == 'สิงห์บุรี' ? 'selected':''); ?>>สิงห์บุรี </option>
                                                <option value="สุโขทัย" <?php echo e($data->staff_province == 'สุโขทัย' ? 'selected':''); ?>>สุโขทัย </option>
                                                <option value="สุพรรณบุรี" <?php echo e($data->staff_province == 'สุพรรณบุรี' ? 'selected':''); ?>>สุพรรณบุรี </option>
                                                <option value="สุราษฎร์ธานี" <?php echo e($data->staff_province == 'สุราษฎร์ธานี' ? 'selected':''); ?>>สุราษฎร์ธานี </option>
                                                <option value="สุรินทร์" <?php echo e($data->staff_province == 'สุรินทร์' ? 'selected':''); ?>>สุรินทร์ </option>
                                                <option value="สตูล" <?php echo e($data->staff_province == 'สตูล' ? 'selected':''); ?>>สตูล </option>
                                                <option value="หนองคาย" <?php echo e($data->staff_province == 'หนองคาย' ? 'selected':''); ?>>หนองคาย </option>
                                                <option value="หนองบัวลำภู" <?php echo e($data->staff_province == 'หนองบัวลำภู' ? 'selected':''); ?>>หนองบัวลำภู </option>
                                                <option value="อำนาจเจริญ" <?php echo e($data->staff_province == 'อำนาจเจริญ' ? 'selected':''); ?>>อำนาจเจริญ </option>
                                                <option value="อุดรธานี" <?php echo e($data->staff_province == 'อุดรธานี' ? 'selected':''); ?>>อุดรธานี </option>
                                                <option value="อุตรดิตถ์" <?php echo e($data->staff_province == 'อุตรดิตถ์' ? 'selected':''); ?>>อุตรดิตถ์ </option>
                                                <option value="อุทัยธานี" <?php echo e($data->staff_province == 'อุทัยธานี' ? 'selected':''); ?>>อุทัยธานี </option>
                                                <option value="อุบลราชธานี" <?php echo e($data->staff_province == 'อุบลราชธานี' ? 'selected':''); ?>>อุบลราชธานี</option>
                                                <option value="อ่างทอง" <?php echo e($data->staff_province == 'อ่างทอง' ? 'selected':''); ?>>อ่างทอง </option>
                                                <option value="อื่นๆ" <?php echo e($data->staff_province == 'อื่นๆ' ? 'selected':''); ?>>อื่นๆ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_email" class="col-sm-4 col-form-label">
                                            Email
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="email" class="form-control"
                                                                     value="<?php echo e($data->email); ?>"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     required
                                                                     <?php endif; ?>
                                                                     name="email" id="staff_email" placeholder="abc@def.com">

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
                                        <label for="staff_phone" class="col-sm-4 col-form-label">
                                            Phone
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="number" class="form-control"
                                                                     value="<?php echo e($data->staff_phone); ?>"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>
                                                                     required
                                                                     name="staff_phone" id="staff_phone" placeholder="012-345-6789">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_status" class="col-sm-4 col-form-label">
                                            Status
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="staff_status" id="staff_status"
                                                    <?php if($detail != 0): ?>
                                                    disabled
                                                    <?php endif; ?>
                                                    required
                                            >
                                                <option value=""></option>
                                                <option value="Working" <?php echo e($data->staff_status == 'Working' ? 'selected':''); ?>>Working</option>
                                                <option value="Fired" <?php echo e($data->staff_status == 'Fired' ? 'selected':''); ?>>Fired</option>
                                                <option value="Resigned" <?php echo e($data->staff_status == 'Resigned' ? 'selected':''); ?>>Resigned</option>
                                                <option value="Retired" <?php echo e($data->staff_status == 'Retired' ? 'selected':''); ?>>Retired</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_preJob" class="col-sm-4 col-form-label">Previous
                                            Job</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     <?php if($detail != 0): ?>
                                                                     readonly="<?php echo e($detail); ?>"
                                                                     <?php endif; ?>
                                                                     value="<?php echo e($data->staff_previous_job); ?>"
                                                                     name="staff_previous_job" id="staff_previous_job"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_pic" class="col-sm-4 col-form-label">Picture</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control"
                                                   <?php if($detail != 0): ?>
                                                   readonly="<?php echo e($detail); ?>"
                                                   <?php endif; ?>
                                                   <?php if(!$data->id): ?>

                                                   <?php endif; ?>
                                                   name="staff_pic" id="staff_pic">

                                            <?php if($data->id && $data->staff_pic): ?>
                                                <a href="<?php echo e(asset('/')); ?><?php echo e($data->staff_pic); ?>" target="_blank">
                                                    <img src="<?php echo e(asset('/')); ?><?php echo e($data->staff_pic); ?>"   target="_blank" class="img-fluid" style="width: 50%"></a>
                                             <?php else: ?>
                                                <img src="<?php echo e(url('/uploads')); ?>/images/no_image.png"   target="_blank" class="img-fluid" style="height: 100%;">
                                            <?php endif; ?>

                                            <?php if($errors->has('staff_pic')): ?>
                                                <span class="help-block" style="color: #ff4d4d">
                                                            <strong><?php echo e($errors->first('staff_pic')); ?></strong>
                                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_status" class="col-sm-4 col-form-label">File</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control"
                                                   <?php if($detail != 0): ?>
                                                   readonly="<?php echo e($detail); ?>"
                                                   <?php endif; ?>
                                                   name="staff_file" id="staff_file">

                                            <?php if($data->id && $data->staff_file): ?>
                                                <br>
                                                <a href="file/<?php echo e($data->staff_file); ?>" target="_blank">
                                                    View file
                                                </a>
                                                <?php else: ?>
                                                <br>
                                                No file
                                            <?php endif; ?>
                                            <?php if($errors->has('staff_file')): ?>
                                                <span class="help-block" style="color: #ff4d4d">
                                                            <strong><?php echo e($errors->first('staff_file')); ?></strong>
                                                        </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staff_role" class="col-sm-2 col-form-label">
                                    Staff role
                                    <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                    : </label>
                                <div class="col-sm-10 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"
                                               <?php if($detail != 0): ?>
                                               disabled
                                               <?php endif; ?>
                                               name="admin" id="checked_admin" value="admin"
                                               required
                                            <?php echo e($data->staff_role == 'admin' || $data->staff_role == 'admin, user' ? 'checked':''); ?>>
                                        <label class="form-check-label" for="admin">admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               <?php if($detail != 0): ?>
                                               disabled
                                               <?php endif; ?>
                                               type="checkbox" name="user" id="checked_user" value="user"
                                               required
                                            <?php echo e($data->staff_role == 'user' ? 'checked':''); ?>>
                                        <label class="form-check-label" for="user">staff</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="staff_note">Note: </label>
                                <textarea class="form-control" name="staff_note"
                                          <?php if($detail != 0): ?>
                                          readonly="<?php echo e($detail); ?>"
                                          <?php endif; ?>
                                          id="staff_note" rows="3"> <?php echo e($data->staff_note); ?></textarea>
                            </div>


                        </div>

                        <!-- Modal footer -->

                        <div class="modal-footer">
                            <?php if($detail != 1): ?>
                                <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                                    Save
                                </button>
                            <?php endif; ?>


                        </div>
                    </div>


                </div>
            </div>
        </form> <!-- end action here -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    staff_birth

    <script>

        $(document).ready(function(){

            $('#checked_admin').on('change', function() {
                $('#checked_user').not(this).prop('checked', false).removeAttr('required');

            });
            $('#checked_user').on('change', function() {
                $('#checked_admin').not(this).prop('checked', false).removeAttr('required');
            });

        });

        $('#staff_birth').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

        $('#staff_birth').on('change', function() {
            let  staff_birth = $('#staff_birth').val();

            if(staff_birth!= null){
                var today = new Date();
                var birthDate = new Date(staff_birth);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                $('#staff_age').val(age)

            }

        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/staff/add.blade.php ENDPATH**/ ?>