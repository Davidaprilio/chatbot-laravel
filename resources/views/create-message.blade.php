@extends('layout')


@section('content')
<a href="{{ url('baru') }}">baru</a>
    <table>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>{{ $message->name }}</td>
                    <td>{{ $message->hook }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection