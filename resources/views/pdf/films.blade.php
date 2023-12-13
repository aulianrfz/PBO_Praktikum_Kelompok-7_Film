<!-- resources/views/pdf/films.blade.php -->

<h1>Films List</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach($data as $film)
            <tr>
                <td>{{ $film->id }}</td>
                <td>{{ $film->title }}</td>
                <!-- Add more columns as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
