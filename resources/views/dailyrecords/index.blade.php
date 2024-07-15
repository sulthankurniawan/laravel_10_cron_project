<!-- resources/views/dailyrecords/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Daily Records</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Date</th>
            <th>Male Count</th>
            <th>Female Count</th>
            <th>Male Avg Age</th>
            <th>Female Avg Age</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->date }}</td>
                <td>{{ $record->male_count }}</td>
                <td>{{ $record->female_count }}</td>
                <td>{{ $record->male_avg_age }}</td>
                <td>{{ $record->female_avg_age }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
