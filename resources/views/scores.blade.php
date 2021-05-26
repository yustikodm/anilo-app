<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>score List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link  href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>score List</h2>
            </div>
            <div class="row" style="padding: 15px">
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create score</a>
                </div>
                <div class="pull-right mb-2"  style="margin-left: 15px">
                    <a class="btn btn-primary" href="{{ route('students') }}">Students</a>
                </div>
                <div class="pull-right mb-2"  style="margin-left: 15px">
                    <a class="btn btn-primary" href="{{ route('subjects') }}">Subjects</a>
                </div>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card-body">
        <table class="table table-bordered" id="ajax-crud-datatable">
            <thead>
            <tr>
                <th>Id</th>
                <th>Subject</th>
                <th>Student</th>
                <th>Score</th>
                <th style="width: 150px">Action</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
<!-- boostrap score model -->
<div class="modal fade" id="score-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="scoreModal"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="scoreForm" name="scoreForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                            <label for="student_id" class="col-sm-2 control-label">Student</label>
                            <select class="form-control" name="student_id" id="student_id" style="width: 500px; margin-left: 15px">
                                @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    <div class="form-group">
                        <label for="student_id" class="col-sm-2 control-label">Subject</label>
                        <select class="form-control" name="subject_id" id="subject_id" style="width: 500px; margin-left: 15px">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Score</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="score" name="score" placeholder="Enter score" maxlength="50" required="" style="width: 300px">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- end bootstrap model -->
</body>
<script type="text/javascript">
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#ajax-crud-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('scores') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'subject.name', name: 'subject.name' },
                { data: 'student.name', name: 'student.name' },
                { data: 'score', name: 'score' },
                { data: 'action', name: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });
    });
    function add(){
        $('#scoreForm').trigger("reset");
        $('#scoreModal').html("Add score");
        $('#score-modal').modal('show');
        $('#id').val('');
    }
    function editFunc(id){
        $.ajax({
            type:"PUT",
            url: "{{ url('scores/update') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
                $('#scoreModal').html("Edit score");
                $('#score-modal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#score').val(res.score);
            }
        });
    }
    function deleteFunc(id){
        if (confirm("Delete Record?") == true) {
            var id = id;
// ajax
            $.ajax({
                type:"DELETE",
                url: "{{ url('scores/delete') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                }
            });
        }
    }
    $('#scoreForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: "{{ url('scores/store')}}",
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            success: (data) => {
                $("#score-modal").modal('hide');
                var oTable = $('#ajax-crud-datatable').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },
            error: function(data){
                console.log(data);
            }
        });
    });
</script>
</html>
