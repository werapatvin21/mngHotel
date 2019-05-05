// jQuery(document).ready(function($) {
//     $(".clickable-row").click(function() {
//         window.location = $(this).data("href");
//     });
// });

function getList(page) {
    var size = $('#size_page').val();
    if (page == null) page = 1;
    var module = $('#sortable').data("module");
    $.ajax({
            type: 'GET',
            url: '/api/'+module+'?size=' + size + '&page=' + page,
            dataType: 'json',
            success: function (data) {
                listTable(data);
                paginate(data);
            }
        }
    );
}

$('#search').keyup(function () {
    var size = $('#size_page').val();
    var text = $('#search').val();
    var module = $('#sortable').data("module");
    $.ajax({
            type: 'GET',
            url: '/api/'+module+'?search=' + text + '&size=' + size,
            dataType: 'json',
            success: function (data) {

                listTable(data);
                paginate(data);
            }
        }
    );
})

function paginate(data) {
    var size = $('#size_page').val();
    if(data.total < size){
        $('#show_list').text("แสดง " + data.total + " รายการ จากทั้งหมด " + data.total + " รายการ");
    }else{
        $('#show_list').text("แสดง " + data.per_page + " รายการ จากทั้งหมด " + data.total + " รายการ");
    }
    if (Math.ceil(data.total / data.per_page) + 1 > 5) {
        if (data.current_page < 4) {
            $('#listPage').find('li').remove().end();
            if (data.current_page === 1) {
                $('#listPage').append('<li class="page-item disabled"><a class="page-link" tabindex="-1">ก่อนหน้า</a> </li>')
            } else {
                $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + (data.current_page - 1) + ')">ก่อนหน้า</a></li>')
            }
            for (var i = 1; i < 6; i++) {
                if (data.current_page !== i) {
                    $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + i + ')">' + i + '</a></li>')
                } else {
                    $('#listPage').append('<li class="page-item active"><a class="page-link"  tabindex="-1">' + i + '</a></li>')
                }
            }
            $('#listPage').append('<li class="page-item disabled"><a class="page-link"  tabindex="-1" onclick="">...</a></li>');
            $('#listPage').append('<li class="page-item"><a class="page-link" tabindex="-1" onclick="getList(' + (data.current_page + 1) + ')">ถัดไป</a></li>');
        }
        if (data.current_page > 3 && data.current_page < data.last_page - 3) {
            $('#listPage').find('li').remove().end();
            $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + (data.current_page - 1) + ')">ก่อนหน้า</a></li>');
            $('#listPage').append('<li class="page-item disabled"><a class="page-link"  tabindex="-1" onclick="">...</a></li>');
            for (var i = data.current_page - 2; i < data.current_page + 1; i++) {
                if (data.current_page !== i) {
                    $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + i + ')">' + i + '</a></li>')
                } else {
                    $('#listPage').append('<li class="page-item active"><a class="page-link"  tabindex="-1">' + i + '</a></li>')
                }
            }
            for (var i = data.current_page + 1; i < data.current_page + 3; i++) {
                if (data.current_page !== i) {
                    $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + i + ')">' + i + '</a></li>')
                } else {
                    $('#listPage').append('<li class="page-item disabled"><a class="page-link"  tabindex="-1">' + i + '</a></li>')
                }
            }
            $('#listPage').append('<li class="page-item disabled"><a class="page-link"  tabindex="-1" onclick="">...</a></li>');
            $('#listPage').append('<li class="page-item"><a class="page-link" tabindex="-1" onclick="getList(' + (data.current_page + 1) + ')">ถัดไป</a></li>');
        }
        if (data.current_page >= data.last_page - 3) {
            $('#listPage').find('li').remove().end();
            $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + (data.current_page - 1) + ')">ก่อนหน้า</a></li>');
            $('#listPage').append('<li class="page-item disabled"><a class="page-link"  tabindex="-1" onclick="">...</a></li>');
            for (var i = data.last_page - 4; i < data.last_page + 1; i++) {
                if (data.current_page !== i) {
                    $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + i + ')">' + i + '</a></li>');
                } else {
                    $('#listPage').append('<li class="page-item active"><a class="page-link"  tabindex="-1" onclick="getList(' + i + ')">' + i + '</a></li>');
                }
            }
            if (data.current_page === data.last_page) {
                $('#listPage').append('<li class="page-item disabled "><a class="page-link" tabindex="-1">ถัดไป</a></li>');
            } else {
                $('#listPage').append('<li class="page-item"><a class="page-link" tabindex="-1" onclick="getList(' + (data.current_page + 1) + ')">ถัดไป</a></li>');
            }
        }
    } else {
        $('#listPage').find('li').remove().end();
        if (data.current_page === 1) {
            $('#listPage').append('<li class="page-item disabled"><a class="page-link" tabindex="-1">ก่อนหน้า</a> </li>');
        } else {
            $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + (data.current_page - 1) + ')">ก่อนหน้า</a></li>');
        }
        for (var i = 1; i < data.last_page + 1; i++) {
            if (data.current_page !== i) {
                $('#listPage').append('<li class="page-item "><a class="page-link"  tabindex="-1" onclick="getList(' + i + ')">' + i + '</a></li>');
            } else {
                $('#listPage').append('<li class="page-item active"><a class="page-link"  tabindex="-1">' + i + '</a></li>');
            }
        }
        if (data.current_page === data.last_page) {
            $('#listPage').append('<li class="page-item disabled "><a class="page-link" tabindex="-1">ถัดไป</a></li>');
        } else {
            $('#listPage').append('<li class="page-item"><a class="page-link" tabindex="-1" onclick="getList(' + (data.current_page + 1) + ')">ถัดไป</a></li>');
        }
    }
}

function listTable(data) {
    $('#sortable').find('tr').remove().end()
    console.log();
    var module = $('#sortable').data("module");
    for (var i in data.data) {
        if(data.data[i].phone == null) data.data[i].phone ="-";
        if(data.data[i].first_name == null) data.data[i].first_name = "-";
        if(data.data[i].last_name == null) data.data[i].last_name = "-";

        $('#sortable').append(
            '<tr>' +
            '<td>' + data.data[i].id + '</td>' +
            '<td>' + data.data[i].first_name + '</td>' +
            '<td>' + data.data[i].last_name + '</td>' +
            '<td>' + data.data[i].email + '</td>' +
            '<td>' + data.data[i].phone + '</td>' +
            '<td style="color: #269A21;">' + data.data[i].role + '</td>' +
            '<td>-</td>' +
            '<td>' +
            '<a href="/'+ module +'/' + data.data[i].id + '/edit"><i class="fas fa-pencil-alt" style="color: #479aff"></i></a>' +
            '&nbsp;&nbsp;' +
            '<a href="#" onclick="fuc_delete('+ data.data[i].id +',\''+module+'\');">' +
            '<i class="fas fa-trash" style="color: red"></i>' +
            '</a>' +
            '</td>' +
            '</tr>');

    }
}

function fuc_delete(id,module) {
    var size = $('#size_page').val();
    if (confirm('Are you sure?')){
        $.ajax({
            type: 'DELETE',
            url: '/api/'+module+'/'+id+'?size='+size,
            dataType: 'json',
            success: function (data) {
                listTable(data,module);
                paginate(data);
            }
        })
    }
}

function search(string) {
    console.log(string);
}
