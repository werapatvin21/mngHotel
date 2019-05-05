<?php $permission = Auth::user() ?>
<?php if($permission->staff_role === 'admin'): ?>
    
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

        <title>HotelCloud - Add New Room & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col justify-content-end">


               <button style="float: right; margin-left: 2px" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newServiceType"><ion-icon name="add-circle-outline"></ion-icon>New Type</button>

                <?php if($permission->staff_role === 'admin'): ?>
                    <a  class="btn btn--custom" href="<?php echo e(url('services/create')); ?>"
                        style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"
                        role="button">
                        Add Services  <i class="fas fa-plus-circle"></i>
                    </a>
                <?php endif; ?>

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
                        <div id="data-service-types">
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
                                </div><br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="serviceType">New Service Type
                                     <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>: </span>
                            </div>
                            <input required type="text" class="form-control" aria-label="Small" aria-describedby="serviceType" id="serviceTypeName" name="name">
                            <span id="message" style="color: red"></span>
                            <!-- ส่วนนี้ จะรับข้อมูลแล้วเอาไปแสดงด้านบน -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="service-type-submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>
        <!--================ End Modal New Service Type =================-->
    </form>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
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
                <?php if($permission->staff_role === 'admin'): ?>
                    <div class="tab-pane fade show active" id="room-list" role="tabpanel" aria-labelledby="room-list-tab">
                        <table class="table table-hover table-responsive" id="room-table">
                            <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Service Type</th>
                                <th>Price</th>
                                
                                <th>Status</th>
                                <th>Edit / Read More</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        $('#service-type-submit').click(function (event) {
            var service_type = $('#serviceTypeName').val();
            if (service_type != "") {
                console.log(service_type);
                $.ajax({
                    type: 'post',
                    data: {"name": service_type, "_token": "<?php echo e(csrf_token()); ?>"},
                    url: '<?php echo route('servicesType.store'); ?>',
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        var html = `<div class="row">
                                        <div class="col">
                                        ${data.name}
                                        </div>
                                        <div class="col">
                                            <a href="/services_type/${data.id}/destroy">
                                                <ion-icon name="trash"></ion-icon>
                                            </a>
                                        </div>
                                    </div>`;

                        $('#data-service-types').append(html);
                    },
                    error: function (res) {
                        alert('error' + res)
                    }
                });
                $('#message').empty();
            } else {
                $('#message').append(' Please fill the field');
            }

            event.preventDefault();
        });
    </script>
    <script>
        var room = $('#room-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            autoWidth: false,
            ajax: {
                url: '<?php echo route('getServices'); ?>',
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
                    'targets': [4]
                },
                {
                    'className': 'text-right',
                    // 'targets': [5]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                {data: 'name', width: '30%'},
                {data: 'services_type_name', width: '20%'},
                { data: 'price',  width: '10%'},
                // { data: 'cost',  width: '10%'},
                { data: 'status', render: function (status) {
                    if(status === 'Available'){
                        return '<span style="color: green"> Available </span>'
                    }else {
                        return '<span  style="color: red"> Not Available</span>'
                    }

                    },  width: '20%'},
                { data: 'id', render: function (id) {
                        <?php if($permission->staff_role === 'admin'): ?>
                            return `<a href="/services/${id}?detail=0">
                                <ion-icon name="create" data-toggle="modal" data-target="#editRomm"></ion-icon>
                            </a>
                            <a href="/services/${id}?detail=1">
                                <ion-icon name="document" data-toggle="modal" data-target="#staffRomm"></ion-icon>
                            </a>

                            <a href="/services/${id}/destroy">
                                     <ion-icon name="trash" data-toggle="modal" data-target="#staffRomm"></ion-icon>
                             </a>

                                `;
                        <?php else: ?>
                            return '-'
                        <?php endif; ?>


                    },  width: '20%'}
            ]
        });
       /* <a href="/services/${id}/destroy">
            <ion-icon name="trash" data-toggle="modal" data-target="#staffRomm"></ion-icon>
            </a>*/

        $('#data-search').on( 'keyup', function () {
            room.search( this.value ).draw();
        });

        $('#data-search').change(function () {
            room.ajax.reload()
        });


        function maxpage(maxpage) {
            room.page.len(maxpage).draw();
        }
    </script>

<?php $__env->stopPush(); ?>
<?php else: ?>
<?php endif; ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/services/list.blade.php ENDPATH**/ ?>