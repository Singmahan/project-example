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
            <div class="h4">Edit Employees</div>
            <div>
                <a href="{{ route('employee.index') }}" class="btn btn-primary btn-sm">back</a>
            </div>
        </div>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card boder-0 shadow-lg">
                <div class="card-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" placeholder="Enter Name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $employee->name) }}">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" placeholder="Enter email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $employee->email) }}">
                        @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" cols="30" rows="4" class="form-control" placeholder="Enter Address">{{ old('address', $employee->address) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label"></label>
                        <input type="file" name="image" class="@error('image') is-invalid @enderror">
                        @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror

                        <div class="pt-3">
                            @if ($employee->image != '' && file_exists(public_path() . '/uploads/employees/' . $employee->image))
                                ;
                                <img src="{{ url('uploads/employees/' . $employee->image) }}" alt=""
                                    width="200px" height="150px">
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <button class="btn btn-primary my-3">Update Employee</button>
        </form>

    </div>
</body>

</html>
