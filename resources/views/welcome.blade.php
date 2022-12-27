<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Mazaady Task</h1>
                <p class="lead">This is a demo!</p>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Form</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employees.index') }}" method="GET">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-muted">Level of Heighest Salary</label>
                                <input type="number" min="5" max="50" name="highest" value="{{ request()->highest }}" class="form-control">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


            <div class="col-12">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Departments</th>
                            <th scope="col">Heighest Salary</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $key => $employee)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $employee->name }}</td>

                                {{-- @dd($employee->getDepartmentsOrderedByAmount()) --}}
                                <td>
                                    @foreach ($employee->getDepartmentsOrderedByAmount() as $department)
                                        {{-- show department and his salary --}}
                                        {{-- <p>{{ $department->name }} : {{ $department->salary->amount }}</p> --}}
                                        <table class="table table-secondary table-striped-columns">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Department</th>
                                                    <th class="text-center">Salary</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $department->name }}</td>
                                                    <td class="text-center">{{ $department->salary->amount }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach

                                </td>
                                <td>{{ $employee->getHighestSalary() }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
            </script>
</body>

</html>
