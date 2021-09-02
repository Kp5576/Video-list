@extends('layouts.main')

@section('content')
<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Quote</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Quote</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="javascript:;" class="btn add-btn" onclick="showModelForm();"><i
                        class="fa fa-plus"></i> Add Quote</a>

            </div>
        </div>

    </div>
</div>
<style>
.dropdown-action {
    float: right;
}
</style>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    @if(session()->has('success'))
    <div class="alert alert-success alert-bordered">
        <button type="button" class="close" data-dismiss="alert"><span>×</span><span
                class="sr-only">Close</span></button>
        <span class="text-semibold">Well done!</span> {{ session()->get('success') }}
    </div>
    @endif
    <div class="card mb-0" style="position: static; zoom: 1;">
        <div class="card-body" style="display: block;min-height: 400px;">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>
</div>
<!-- MODEL FOR Family-->
<div id="modalDate" class="modal fade custom-modal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quote</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmData" action="{{route('quote_update')}}">
                {{ csrf_field() }}
                    <input type="hidden" name="id" id="txtID">
                    
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input name="name" id="txtName" type="text" class="form-control txtRequired">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" id="txtEmail" class="form-control txtRequired" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input name="phone" id="txtPhone" class="form-control txtRequired" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Company <span class="text-danger">*</span></label>
                                        <input name="company" id="txtCompany" class="form-control txtRequired" type="text">
                                        
                                 
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Message <span class="text-danger">*</span></label>
                                        <input name="message" id="txtMessage" class="form-control txtRequired" type="text">
                                        
                                 
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    loadData();
});
function loadData(){
    $("#dataTable").dataTable().fnDestroy();

    $('#dataTable').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: '<?php echo url('/');?>/quote/load_data',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'company'},
                {data: 'message'},
                {data: 'action', orderable: false, searchable: false}
            ]
        });
}
$('#dataTable').on('click', '.btn-delete[data-remote]', function (e) 
    { 
        e.preventDefault();
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var url = $(this).data('remote');
        // confirm then
        if (confirm('Are you sure you want to delete this?')) {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'json',
                data: {method: '_DELETE', submit: true}
            }).always(function (data) {
                $('#dataTable').DataTable().draw(false);
            });
        }else
        alert("You have cancelled!");
    });

function editData(VL_id) {
    var table = $('#dataTable').DataTable();
    var data = table.rows().data();
    for (var i = 0, ien = data.length; i < ien; i++) {
        if (table.row(i).data().id == VL_id) {
            arrDT = table.row(i).data();
            $("#txtID").val(table.row(i).data().id);
            $("#txtName").val(table.row(i).data().name);
            $("#txtEmail").val(table.row(i).data().email);
            $("#txtPhone").val(table.row(i).data().phone);
            $("#txtCompany").val(table.row(i).data().company);
             $("#txtMessage").val(table.row(i).data().message);
           
        }
    }
    showModelForm(1);
    //alert(VL_id);
}
$("#frmData").submit(function(event) {
    VL_errorCount = 0;
    $("#frmData .txtRequired").each(function() {
        if ($(this).val() == "") {
            $(this).addClass("is-invalid");
            VL_errorCount++;
            $(this).addClass("is-invalid");
            VL_validate = 1;
        } else {
            $(this).removeClass("is-invalid");
        }
    });
    var numItems = $('.is-invalid').length;
    VL_errorCount = numItems;
    if (VL_errorCount > 0) {
        alert("Please fill the required fields.")
        return false;
    }
    $.ajax({
        url: $('#frmData').attr('action'),
        data: {
            "data": $('#frmData').serialize()
        },
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
            //ajaxProgress(1);
        },
        success: function(data) {
            if (1==1) {
                loadData();
                $('#modalDate').modal('hide');
            } else {
                alert("Error!")
            }

        }
    });
    //return 1;
    event.preventDefault();
});

function showModelForm(VL_act = 0) {
    $(".alpha-warning").removeClass("alpha-warning");
    if (VL_act == 0) {
        $("#txtID").val("0");
        $("#frmData").trigger("reset");
    }
    $('#modalDate').modal('show');
}

$('#txtHolidayDate').datetimepicker({
    format: 'YYYY-MM-DD',
    icons: {
        up: "fa fa-angle-up",
        down: "fa fa-angle-down",
        next: 'fa fa-angle-right',
        previous: 'fa fa-angle-left'
    }
});
</script>













<!-- /content area -->
@endsection