@extends('layouts.app')

@section('content')
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Batch</th>
                <th scope="col">Test</th>
                <th scope="col">Feedback</th>
            </tr>
            </thead>
            <tbody>
            @foreach($feedbacks as $index=>$feedback)
            <tr>
                <th scope="row">{{($index+1)}}</th>
                <td>{{$feedback->user->batch}}</td>
                <td>{{$feedback->topic->title}}</td>
                <td>{{$feedback->feedback}}</td>
            </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
