@extends('layouts.mains')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h2>Preview</h2>
        <video id="preview" width="160" height="120" autoplay muted></video><br/><br/>
        <div class="btn-group">
            <div id="startButton" class="btn btn-success"> Start </div>
            <div id="stopButton" class="btn btn-danger"  style="display:none;"> Stop </div>
        </div>
    </div>
    <div class="col-md-6" id="recorded"  style="display:none">
        <h2>Recording</h2>
        <video id="recording" width="160" height="120" controls></video><br/><br/>
             <a id="downloadLocalButton" class="btn btn-primary" style="margin-bottom:10px;">Download</a>
             <h4>Save Video</h4>
         <input name="name" id="txtName" type="text"  class=" txtRequired" placeholder="name">
         <input name="title" id="titles" type="text"  class=" txtRequired" placeholder="title">
         <input name="duration" id="durations" type="text" class=" txtRequired" placeholder="duration">
        <a id="downloadButton" class="btn btn-primary" data-url="{{route('ajaxupload.video')}}">save</a>

    </div>
</div>

<!--end recoding-->
<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Video</h3>

            </div>
            <div class="col-auto float-right ml-auto">
                <a href="javascript:;" class="btn add-btn" onclick="showModelForm();"><i
                        class="fa fa-plus"></i> Add Video</a>

            </div>
        </div>

    </div>
</div>
<style>
.dropdown-action {
    float: right;
}
.txtRequired{
    width: 200px;
    margin-bottom:10px;
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
                            <th>Video</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Duration</th>
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
                <h5 class="modal-title">Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmData" action="{{route('quote_update')}}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <input type="hidden" name="id" id="txtID">

                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Details</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Video <span class="text-danger">*</span></label>

                                        <input  type="file" id="txtVideo" class=" form-control txtRequired" name="video">

                                      <?php  $url = asset("public/video/$dta->video");  ?>

                                                                        <video width="70" height="100" align="center">
                                                                        <source src=' {{ $url }} '>
                                                                            </video>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input name="name" id="txtName" class="form-control txtRequired" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title <span class="text-danger">*</span></label>
                                        <input name="title" id="title" class="form-control txtRequired" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Duration <span class="text-danger">*</span></label>
                                        <input name="duration" id="duration" class="form-control txtRequired" type="text">


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
                {data: 'video'},
                {data: 'name'},
                {data: 'title'},
                {data: 'duration'},
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
            $("#txtideo").val(table.row(i).data().video);
            $("#txtName").val(table.row(i).data().name);
            $("#title").val(table.row(i).data().title);
            $("#duration").val(table.row(i).data().duration);


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
       url:"{{ route('ajaxupload.action') }}",
    method:"POST",
    data:new FormData(this),
    dataType:'JSON',
    contentType: false,
    cache: false,
    processData: false,
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



<script>
    let preview = document.getElementById("preview");
    let recording = document.getElementById("recording");
    let txtname = document.getElementById("txtName");
    let titl = document.getElementById("titles");
    let duratio = document.getElementById("durations");
    let startButton = document.getElementById("startButton");
    let stopButton = document.getElementById("stopButton");
    let downloadButton = document.getElementById("downloadButton");
    let logElement = document.getElementById("log");
    let recorded = document.getElementById("recorded");
    let downloadLocalButton = document.getElementById("downloadLocalButton");

    let recordingTimeMS = 10000; //video limit 5 sec
    var localstream;

    window.log = function (msg) {
    //logElement.innerHTML += msg + "\n";
    console.log(msg);
    }

    window.wait = function (delayInMS) {
    return new Promise(resolve => setTimeout(resolve, delayInMS));
    }

    window.startRecording = function (stream, lengthInMS) {
        let recorder = new MediaRecorder(stream);
        let data = [];

        recorder.ondataavailable = event => data.push(event.data);
        recorder.start();
        log(recorder.state + " for " + (lengthInMS / 1000) + " seconds...");

        let stopped = new Promise((resolve, reject) => {
            recorder.onstop = resolve;
            recorder.onerror = event => reject(event.name);
        });

        let recorded = wait(lengthInMS).then(
            () => recorder.state == "recording" && recorder.stop()
        );

        return Promise.all([
            stopped,
            recorded
            ])
        .then(() => data);
    }

    window.stop = function (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    var formData = new FormData();
    if (startButton) {
        startButton.addEventListener("click", function () {
            startButton.innerHTML = "recording...";
            recorded.style.display = "none";
            stopButton.style.display = "inline-block";
            downloadButton.innerHTML = "rendering..";
            navigator.mediaDevices.getUserMedia({
                video: true,
                audio: true
            }).then(stream => {
                preview.srcObject = stream;
                localstream = stream;
                //downloadButton.href = stream;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;
                return new Promise(resolve => preview.onplaying = resolve);
            }).then(() => startRecording(preview.captureStream(), recordingTimeMS))
            .then(recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, {
                type: "video/webm"
                });

                  txtname = txtname.value;
                  titl = titl.value;
                  duratio = duratio.value;
                 recording.src = URL.createObjectURL(recordedBlob);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('video', recordedBlob);
                formData.append('name', txtname);
                formData.append('title', titl);
                formData.append('duration', duratio);

                downloadLocalButton.href = recording.src;
                downloadLocalButton.download = "RecordedVideo.webm";
                log("Successfully recorded " + recordedBlob.size + " bytes of " +
                recordedBlob.type + " media.");
                startButton.innerHTML = "Start";
                stopButton.style.display = "none";
                recorded.style.display = "block";
                downloadButton.innerHTML = "Save";
                localstream.getTracks()[0].stop();
            })
            .catch(log);
        }, false);
    }
    if (downloadButton) {
        downloadButton.addEventListener("click", function () {
            $.ajax({
            url: this.getAttribute('data-url'),
            method: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
             success: function(data) {
            if (data.status == "1") {
                loadData();

            } else {
                alert("Error!");
            }
            }
            });
        }, false);
    }
    if (stopButton) {
        stopButton.addEventListener("click", function () {
            stop(preview.srcObject);
            startButton.innerHTML = "Start";
            stopButton.style.display = "none";
            recorded.style.display = "block";
            downloadButton.innerHTML = "Save";
            localstream.getTracks()[0].stop();
        }, false);
    }
</script>










<!-- /content area -->
@endsection