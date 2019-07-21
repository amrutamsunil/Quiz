@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.laravel-quiz')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.quiz')
        </div>
        <?php //dd($questions) ?>
        @if(count($topics) > 0)
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">TOPIC</th>
                        <th scope="col">TEST</th>

                    </tr>
                    </thead>
                <?php $i = 1; ?>
                @foreach($topics as $topic)
                    @if ($i > 1) <hr /> @endif

                            <tbody>
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{$topic->title}}</td>
                                <td><a href="{{Route('tests.startQuiz',$topic->id)}}" class="btn btn-info">START QUIZ</a></td>
                                </tr>

                            </tbody>

                    <?php $i++; ?>
                @endforeach
                </table>
            </div>
        @endif
    </div>


@stop

