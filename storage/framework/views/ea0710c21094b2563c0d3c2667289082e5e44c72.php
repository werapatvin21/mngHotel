<?php $permission = Auth::user() ?>
<?php if($permission->staff_role === 'admin' || $permission->staff_role === 'user'): ?>

<?php $__env->startSection('content'); ?>
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
            color: #3D438D;
        }

        .marker {
            top: -0.9em !important;
        }

        .m-checkbox.m-checkbox--brand.m-checkbox--solid > input:checked ~ span {
            background: #0D8890 !important;
        }

        .dataTables_wrapper .pagination .page-item:hover > .page-link {
            background: #0D8890 !important;
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
            background: #0D8890 !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #0D8890 !important;
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
            background-color: #0a6aa1!important;
            background: -webkit-linear-gradient(top, #0D8890 0%, #0D8890 100%) !important;
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

        .square {
            height: 75px;
            background-color: #673AB7;
            border-radius: 4px;
            width: 105px;
            /*overflow: hidden;*/
        }

    </style>
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <?php $permission = Auth::user() ?>
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            
                
            
            
            
            <div class="col justify-content-end">
                    <a  class="btn btn--custom ml-1" href="<?php echo e(route('staff_event.calendar')); ?>"
                        style="background-color: #a19100;color:#fff;border-radius: 3px;float: right;"
                        role="button">
                        Calendar  <i class="fa fa-calendar"></i>
                    </a>
                <?php if($permission->staff_role === 'admin'): ?>
                    <a  class="btn btn--custom ml-1" href="<?php echo e(url('staff_event/create')); ?>"
                        style="background-color: #10a100;color:#fff;border-radius: 3px;float: right;"
                        role="button">
                        Add Staff Event  <i class="fas fa-plus-circle"></i>
                    </a>
                    <a  class="btn btn--custom" href="<?php echo e(url('staff/create')); ?>"
                        
                        style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"
                        role="button">
                        Add Staff  <i class="fas fa-plus-circle"></i>
                    </a>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            Staff
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
            <div class="row">
                <div class="col-3">
                    <div class="row">
                        <div class="col-2"><label style="padding-top: 10px;">แสดง</label></div>
                        <div class="col-4 form-group">    <!--		Show Numbers Of Rows 		-->
                            <select class="form-control" name="state" id="maxRows" style="width: 75px;"
                                    onchange="maxpage(this.value);">
                                <option value="25" selected>25</option>
                                <option value="50">50</option>
                                <option value="50">100</option>
                            </select>
                        </div>
                        <div class="col-2"><label style="padding-top: 10px;">รายการ</label></div>
                    </div>
                </div>
                <div class="col-6"></div>
                <div class="col-3">
                    <div class="m-input-icon m-input-icon--left">
                        <input type="text" class="form-control m-input light-table-filter" id="data-search" data-table="order-table" placeholder="ค้นหา">
                        <span class="m-input-icon__icon m-input-icon__icon--left">
                            <span>
                                <i class="la la-search"></i>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">

            </div>
            <div class="tab-content" id="myTabContent">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php if($permission->staff_role === 'admin' || $permission->staff_role === 'user'): ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="staff-list-tab" data-toggle="tab" href="#staff-list" role="tab" aria-controls="staff-listv" aria-selected="true">Staff Lists</a>
                    </li>
                    <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" id="staff-event-tab" data-toggle="tab" href="#staff-event" role="tab" aria-controls="staff-event" aria-selected="true">Staff Events</a>
                        </li>
                </ul>
                <?php if($permission->staff_role === 'admin' || $permission->staff_role === 'user'): ?>
                <div class="tab-pane fade show active" id="staff-list" role="tabpanel" aria-labelledby="staff-list-tab">
                    <table class="table table-hover table-responsive" id="staff-table">
                        <thead>
                        <tr>
                            <th>Fullname</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th>File</th>
                            <th>
                                <?php if($permission->staff_role === 'admin'): ?>
                                    Edit /
                                <?php endif; ?>

                                Read More</th>
                        </tr>
                        </thead>
                    </table>
                </div>
                <?php endif; ?>
                <div class="tab-pane fade" id="staff-event" role="tabpanel" aria-labelledby="staff-event-tab">
                    <table class="table table-hover order-table" id="staff-event-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Staff ID</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Edit / Remove</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        var t = $('#staff-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            ajax: {
                url: '<?php echo route('staff.list'); ?>',
                type: 'GET',
                data: function (d) {
                    d._token = "<?php echo e(csrf_token()); ?>",
                        d.search = $('#data-search').val()
                }
            },
            'language': {
                'paginate': {
                    'first': '<<',
                    'last': '>>',
                    'next': 'ถัดไป',
                    'previous': 'ก่อนหน้า'
                },
                'info': 'แสดงทั้งหมด _START_ - _END_ จาก _TOTAL_ รายการ',
            },
            pagingType: 'full_numbers',
            pageLength: 5,
            columnDefs: [
                {
                    'searchable': false,
                    'orderable': false,
                    'targets': [7]
                },
                {
                    'className': 'text-right',
                    // 'targets': [6]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                { data: 'name',width: '20%'},
                { data: 'email',width: '20%'},
                { data: 'staff_phone',width: '10%'},
                { data: 'department',width: '15%'},
                { data: 'staff_role',width: '10%'},
                { data: 'staff_pic', render:function (staff_pic, _, row) {
                        if (staff_pic) {
                            return `<div class="square text-center" style="background-color: #e0e0e0">
                                    <a href="${row.staff_pic}" target="_blank">
                                    <img src="${row.staff_pic}"  target="_blank" class="img-fluid" style="height: 100%;"></a>
                                    </div>`;
                        } else {
                            return `<div class="square text-center" style="background-color: #e0e0e0">
                                    <img src="<?php echo e(url('/uploads')); ?>/images/no_image.png"   target="_blank" class="img-fluid" style="height: 100%;"></div>`;
                        }
                    },width: '10%'},
                { data: 'staff_file', render:function (staff_file, _, row) {
                        if (staff_file) {
                            return `<a href="${row.staff_file}"  target="_blank">Download file</a>`;
                        } else {
                            return `No file`;
                        }
                    }},
                { data: 'id', render: function (id) {


                        <?php if($permission->staff_role === 'admin'): ?>
                            return `<a href="/staff/${id}?detail=0">
                                <ion-icon name="create" data-toggle="modal" data-target="#editStaff"></ion-icon>
                            </a>

                            <a href="/staff/${id}/destroy">
                                <ion-icon name="trash" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                            </a>
                                  <a href="/staff/${id}?detail=1">
                                <ion-icon name="document" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                            </a>
                                `;
                        <?php else: ?>
                            return `
                             <a href="/staff/${id}?detail=1">
                                <ion-icon name="document" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                            </a>

                                `;
                        <?php endif; ?>



                    },width: '15%'}
            ]
        });

        $('#data-search').on( 'keyup', function () {
            t.search( this.value ).draw();
        });

        $('#data-search').change(function () {
            t.ajax.reload()
        });

        var t_event = $('#staff-event-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            ajax: {
                url: '<?php echo route('staff_event.get_event'); ?>',
                type: 'GET',
                data: function (d) {
                    d._token = "<?php echo e(csrf_token()); ?>",
                        d.search = $('#data-search').val()
                }
            },
            'language': {
                'paginate': {
                    'first': '<<',
                    'last': '>>',
                    'next': 'ถัดไป',
                    'previous': 'ก่อนหน้า'
                },
                'info': 'แสดงทั้งหมด _START_ - _END_ จาก _TOTAL_ รายการ',
            },
            pagingType: 'full_numbers',
            pageLength: 5,
            columnDefs: [
                {
                    'searchable': false,
                    'orderable': false,
                    'targets': [5]
                },
                {
                    'className': 'text-right',
                    // 'targets': [6]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                { data: 'id'},
                { data: 'event_name'},
                { data: 'staff_id'},
                { data: 'start_at'},
                { data: 'end_at'},
                { data: 'id', render: function (id) {

                        <?php if($permission->staff_role === 'admin'): ?>
                            return `<a href="/staff_event/${id}?detail=0">
                                <ion-icon name="create" data-toggle="modal" data-target="#editStaffEvent"></ion-icon>
                            </a>

                            <a href="/staff_event/${id}/destroy">
                                <ion-icon name="trash" data-toggle="modal" data-target="#staffDetailEvent"></ion-icon>
                            </a>
                                `;
                        <?php else: ?>
                            return '-'
                        <?php endif; ?>


                    }}
            ]
        });

        function maxpage(maxpage) {
            t.page.len(maxpage).draw();
            t_event.page.len(maxpage).draw();
        }

        $('#data-search').on( 'keyup', function () {
            t_event.search( this.value ).draw();
        });

        $('#data-search').change(function () {
            t_event.ajax.reload()
        });
    </script>

<?php $__env->stopPush(); ?>
<?php else: ?>
    <script>window.location = "<?php echo e(route('staff_event.calendar')); ?>";</script>
<?php endif; ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/staff/list.blade.php ENDPATH**/ ?>