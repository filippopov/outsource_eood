@extends ('layouts.app')

@section ('content')

@if ($data)
    <form method="GET">
        <input type="text" placeholder="name" name='name'>
        <input type="text" placeholder="email" name='email'>
        <input type="submit">
    </form>

    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>lastname</th>
            <th>email</th>
        </tr>
        @foreach ($data as $employee)
            <tr>
                <td>{{$employee->id}}</td>
                <td>{{$employee->name}}</td>
                <td>{{$employee->lastname}}</td>
                <td>{{$employee->email}}</td>
            </tr>
        @endforeach
    </table>
@endif

@endsection
