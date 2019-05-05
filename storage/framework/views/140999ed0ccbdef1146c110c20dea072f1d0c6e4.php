<?php if(session()->has('success')): ?>
    <?php $success = session()->pull('success') ?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            text: '<?php echo e(session()->pull('message',$success?'ทำรายการสำเร็จ' || 'อัพโหลดข้อมูลใบเสร็จ':'ทำรายการไม่สำเร็จ')); ?>',
            timer: 2000,
            icon: '<?php echo e($success?'success':'error'); ?>',
            showConfirmButton: false,
            button: false
            // animation: false,
            // customClass: 'animated fadeIn'
        })
    </script>
<?php endif; ?>
<?php /**PATH C:\Users\aommy\hotel\resources\views/layouts/result_alert.blade.php ENDPATH**/ ?>