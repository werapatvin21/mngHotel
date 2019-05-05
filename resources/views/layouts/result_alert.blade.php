@if(session()->has('success'))
    @php $success = session()->pull('success') @endphp
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            text: '{{session()->pull('message',$success?'ทำรายการสำเร็จ' || 'อัพโหลดข้อมูลใบเสร็จ':'ทำรายการไม่สำเร็จ')}}',
            timer: 2000,
            icon: '{{$success?'success':'error'}}',
            showConfirmButton: false,
            button: false
            // animation: false,
            // customClass: 'animated fadeIn'
        })
    </script>
@endif
