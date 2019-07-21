@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.results.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view-result')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        @if(Auth::user()->isAdmin())
                        <tr>
                            <th>@lang('quickadmin.results.fields.user')</th>
                            <td>{{ $test->user->name or '' }} ({{ $test->user->roll_no or '' }})</td>
                        </tr>
                        @endif
                        <tr>
                            <th>Test Title</th>
                            <td>{{ $test->topic->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.results.fields.result')</th>
                            <td>{{ $test->result }}/100</td>
                        </tr>
                    </table>

            <p>&nbsp;</p>
            <form method="post" action="{{Route('tests.feedback')}}">
                  @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1"><b>FEEDBACK</b></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="feedback" rows="6" PLACEHOLDER=" ( Optional ) "></textarea>
                    <input type="hidden" name="test_id" value="{{$test->id}}">
                </div>

                <center><input type="submit" value="SUBMIT" class="btn btn-info" ></center>

            </form>
            <!--<a href=" route('tests.index') " class="btn btn-default">Take another quiz</a>-->
            <a href="{{ route('results.index') }}" class="btn btn-default">See all my results</a>
        </div>
    </div>
@stop
