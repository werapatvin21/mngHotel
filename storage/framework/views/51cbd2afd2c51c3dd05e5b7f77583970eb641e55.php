<?php $__env->startSection('content'); ?>
    <style>
        .table-scroll {
            position:relative;
            max-width:1200px;
            margin:auto;
            overflow:hidden;
            /*border:1px solid #000;*/
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
            /*border:1px solid #000;*/
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
            /*border:1px solid #000;*/
            visibility:visible;
            background: white;
        }
        .clone thead, .clone tfoot{background:transparent;}

        .td-event {
            cursor: pointer;
        }
    </style>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
<?php $__env->stopSection(); ?>
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

    <title>HotelCloud -  Event Staff Calendar Management</title>
</head>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<?php $permission = Auth::user() ?>
<?php if($permission->staff_role === 'admin'): ?>
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
    <?php else: ?>
        <div class="m-portlet m-portlet--full-height m-portlet--tabs" style="margin-top: -50px;">
<?php endif; ?>

    <div class="m-portlet__head"  style="margin-top: 20px;">
        <div class="m-portlet__head-tools">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="title">
                        Event Staff Calendar
                    </h3>
                </div>
            </div>
        </div>
    </div>
    
        
            

            
            
            
        
    

    <div class="m-portlet__body" id="eventTable">
                    
                        
                            
                                
                                    
                                    <div class="table-responsive">
                                        <div id="table-scroll" class="table-scroll">
                                            <div class="table-wrap">
                                                <?php if($max_end_at && $max_end_at->end_at): ?>
                                                    <table class="table table-sm table-bordered main-table">
                                                        <thead>
                                                        <tr>
                                                            <th class="fixed-side" scope="col">All Staffs&nbsp;</th>
                                                            <?php
                                                            date_default_timezone_set('UTC');
                                                            $date = date('d-m-Y');
                                                            ?>
                                                            <?php while(strtotime($date) <= strtotime($max_end_at->end_at)): ?>
                                                                <th scope="col"><?php echo e($date); ?></th>
                                                                <?php $date = date('d-m-Y', strtotime("+1 day", strtotime($date))); ?>
                                                            <?php endwhile; ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $staff_id = []; ?>
                                                        <?php $__currentLoopData = $staff_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                            date_default_timezone_set('UTC');
                                                            $date_tr = date('Y-m-d');
                                                            $date_td = date('Y-m-d');
                                                            ?>

                                                            <?php if(!in_array($data->staff_id, $staff_id)): ?>
                                                                <?php array_push($staff_id, $data->staff_id);?>
                                                                <tr id="<?php echo e($data->staff_id); ?>">
                                                                    <th class="fixed-side"><?php echo e($data->staff_name); ?></th>
                                                                    <?php while(strtotime($date_td) <= strtotime($max_end_at->end_at)): ?>
                                                                        <?php if($data->start_at <= $date_td && $data->end_at >= $date_td): ?>
                                                                            <td id="<?php echo e($date_td); ?>" style="background: <?php echo e($colors[$key]); ?>; color: #ffffff;">
                                                                                <div class="td-event">
                                                                                    <input type="hidden" value="<?php echo e($data->id); ?>"/>
                                                                                    <?php echo e($data->event_name); ?>

                                                                                </div>
                                                                            </td>

                                                                        <?php else: ?>
                                                                            <td  id="<?php echo e($date_td); ?>"></td>
                                                                        <?php endif; ?>
                                                                        <?php $date_td = date('Y-m-d', strtotime("+1 day", strtotime($date_td))); ?>
                                                                    <?php endwhile; ?>
                                                                </tr>
                                                            <?php else: ?>
                                                                <?php while(strtotime($date_tr) < strtotime($max_end_at->end_at)): ?>
                                                                    <?php if($data->start_at <= $date_tr && $data->end_at >= $date_tr): ?>
                                                                        <?php $__env->startPush('scripts'); ?>
                                                                            <script>
                                                                                $(document).ready(function () {
                                                                                    $('#<?php echo $data->staff_id; ?> > #<?php echo $date_tr; ?>').append(`

                                                                                    <div class="td-event">
                                                                                        <input type="hidden" value="<?php echo e($data->id); ?>"/>
                                                                                        <?php echo e($data->event_name); ?>

                                                                                        </div>

`);
                                                                                    $('#<?php echo $data->staff_id; ?> > #<?php echo $date_tr; ?>').css({
                                                                                        background: '<?php echo e($colors[$key]); ?>',
                                                                                        color: '#ffffff'
                                                                                    });
                                                                                });
                                                                            </script>
                                                                        <?php $__env->stopPush(); ?>
                                                                    <?php endif; ?>
                                                                    <?php $date_tr = date('Y-m-d', strtotime("+1 day", strtotime($date_tr))); ?>
                                                                <?php endwhile; ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                <?php else: ?>
                                                  <center>ไม่พบข้อมูลตารางเวร</center>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                
                            
                        
                    
    </div>
 </div>

<div class="card-event" style="display: none;
                                padding: 7px;
                                width: 300px;
                                position:absolute;
                                z-index: 999;"></div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('scripts'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
        
        
            
                
            
            
                
            
            
                
            
        
                <script>
                    $(document).ready(function () {

                        $('.td-event').mouseover(function (e) {
                            var event_id = e.target.children[0].defaultValue;

                            var url = '<?php echo route("staff_event.getevent"); ?>?event_id='+event_id;

                            if(event_id) {
                                setTimeout(function () {
                                    $.getJSON(url, function (res) {
                                        $('.card-event').empty().append(`
                                    <div class="card">
                                        <div class="card-body">
                                            <p><label style="color: #043ca1;">Event ID :</label> <b>${res.id}</b></p>
                                            <p><label style="color: #043ca1;">Event Name :</label>  <b>${res.event_name}</b></p>
                                            <p><label style="color: #043ca1;">Staff Name :</label>  <b>${res.staff_name}</b></p>
                                            <p><label style="color: #043ca1;">Start At :</label>  <b>${res.start_at}</b></p>
                                            <p><label style="color: #043ca1;">End At :</label>  <b>${res.end_at}</b></p>
                                            <a class="btn btn-sm btn-warning" href="/staff_event/${res.id}?detail=0">
                                                Edit<ion-icon name="create" data-toggle="modal" data-target="#editStaffEvent"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                    `);

                                        $('.card-event').show();
                                        $('.card-event').css({
                                            left: (e.pageX - 250) + "px",
                                            top: (e.pageY - 290) + "px",
                                        });
                                    });
                                }, 500);
                            }
                        });

                        $('.td-event').mouseout(function () {
                            $('.card-event').hide();
                            $('.card-event').mouseover(function () {
                                $('.card-event').show();
                            }).mouseout(function () {
                                $('.card-event').hide();
                            })
                        })


                        // $('.card-event').delay(1000).fadeOut();
                        //         $('#card-event').toggle();
                        // $.each(staff_events, function (k, v) {
                        //     $('.'+v.event_name+v.id).hover(function () {
                        //         $('#'+v.event_name+v.id).appendTo('.card-event');
                        //         $('#card-event').toggle();
                        //     });
                        //
                        // })
                        // $('#card-event').empty();
                    });
                </script>
                <script>
                    // requires jquery library
                    jQuery(document).ready(function() {
                        jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
                    });
                </script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\aommy\hotel\resources\views/staff/calendar.blade.php ENDPATH**/ ?>