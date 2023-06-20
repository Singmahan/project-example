<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Employee</title>
</head>

<body>
    <div class="bg-dark py-3">
        <div class="container">
            <div class="h4 text-white">Laravel 9 CRUD Image</div>
        </div>
    </div>
    <div class="container py-3">
        <div class="d-flex justify-content-between">
            <div class="h4">Employees</div>
            <div>
                <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">create</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card boder-0 shadow-lg">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr align="center">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($employees->isNotEmpty())
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>
                                        @if ($employee->image != '' && file_exists(public_path() . '/uploads/employees/' . $employee->image))
                                            <img src="{{ url('uploads/employees/' . $employee->image) }}" alt=""
                                                width="150px" height="100px">
                                        @else
                                            <img src="{{ url('uploads/employees/no-image.png') }}" alt=""
                                                width="150px" height="100px">
                                        @endif
                                    </td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td align="center">
                                        <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="#" onclick="deleteEmployee({{ $employee->id }})" class="btn btn-danger btn-sm">Delete</a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                        id="employee-edit-action-{{ $employee->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">Record Not Found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            {{ $employees->links('pagination::bootstrap-5') }}
        </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function deleteEmployee(id){
        if(confirm("Are you sure you want to delete ?")){
            document.getElementById('employee-edit-action-' + id).submit();
        }
    }
</script>
