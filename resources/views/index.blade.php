<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel 10 Ajax</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onclick="add()" href="javascript:void(0)">Create Employee</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{$message}}</p>
    </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="employee-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="employeeForm">
                        <div class="mb-3">
                            <label for="employeeId" class="form-label">ID</label>
                            <input type="text" class="form-control" id="employeeId" name="id" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="employeeName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="employeeEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="employeeAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="employeeAddress" name="address" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function add() {
        var myModal = new bootstrap.Modal(document.getElementById('employee-model'), {
            keyboard: false
        });
        myModal.show();
        $('#employeeForm').trigger("reset"); // Fixed line: Ensure the form is reset
        $('#employeeId').val(''); // Fixed line: Clear the employee ID field
    }

    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#employeeForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ route('store') }}", 
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $('#employee-model').modal('hide'); // Fixed line: Hide the modal on success
                    $('#btn-save').html('Submit');
                    $("#btn-save").attr("disabled", false); // Fixed line: Enable the save button
                    $('body').append('<div class="alert alert-success"><p>Employee created successfully!</p></div>');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
    </script>
</body>
</html>
