<!-- resources/views/users/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Users</h1>
    <form action="{{ route('users.index') }}" method="GET" class="form-inline mb-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search users">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ json_decode($user->name)->first }} {{ json_decode($user->name)->last }}</td>
                <td>{{ $user->age }}</td>
                <td>{{ ucfirst($user->gender) }}</td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <form action="{{ route('users.destroy', $user->uuid) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        <h4>Total Users: {{ $users->count() }}</h4>
    </div>
</div>
</body>
</html>
