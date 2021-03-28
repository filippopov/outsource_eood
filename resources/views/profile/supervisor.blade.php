@extends ('layouts.app')

@section ('content')

@if ($data)
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>lastname</th>
            <th>email</th>
        </tr>
        @foreach ($data as $supervisor)
            <tr>
                <td>{{$supervisor->id}}</td>
                <td>{{$supervisor->name}}</td>
                <td>{{$supervisor->lastname}}</td>
                <td>{{$supervisor->email}}</td>
            </tr>
        @endforeach
    </table>
@endif

@endsection

