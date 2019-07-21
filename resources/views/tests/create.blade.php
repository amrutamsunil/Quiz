@extends('layouts.app')

@section('content')
    <h3 class="page-title"><b>{{$topic->title}}</b></h3>
    <h3><div style="padding-left: 80%;color:indianred" id="countdown"></div></h3>
    {!! Form::open(['method' => 'POST', 'route' => ['tests.store'],"id"=>"quiz_form"]) !!}
        <input type="hidden" name="topic_id" value="{{$topic->id}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.quiz')
        </div>
        <?php //dd($questions) ?>
    @if(count($questions) > 0)
        <div class="panel-body">
            <?php
                $i=0;
            if(@$_GET['page']!=""){
                $i=($_GET['page']-1)*4;
            }
            ?>        @foreach($questions as $index=>$question)
            @if ($i > 1) <hr /> @endif

                <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="form-group">
                        <strong>Question {{ ($i+$index+1) }}.<br />{!! nl2br($question->question_text) !!}</strong>

                        @if ($question->code_snippet != '')
                            <div class="code_snippet">{!! $question->code_snippet !!}</div>
                        @endif

                        <input
                            type="hidden"
                            name="questions[{{ ($i+$index+1) }}]"
                            value="{{ $question->id }}">
                    @foreach($question->options as $option)
                        <br>
                        <label class="radio-inline">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $option->id }}">
                            {{ $option->option }}
                        </label>
                    @endforeach
                    </div>
                </div>
            </div>
        @endforeach
        </div>
            <?php echo $questions->render(); ?>
    @endif
    </div>

    {!! Form::submit(trans('quickadmin.submit_quiz'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="{{ url('quickadmin/js') }}/timepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script>
        $('.datetime').datetimepicker({
            autoclose: true,
            dateFormat: "{{ config('app.date_format_js') }}",
            timeFormat: "hh:mm:ss"
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            timer(5400); //5400 for 90 min
        });
        //function that submits the quiz
        function quiz_submit(){
            $('#quiz_form').submit();
        }
        //function that keeps the counter going
        function timer(secs){
            var flag=false;
            var ele = document.getElementById("countdown");
            ele.innerHTML = "Your Time Starts Now";
            var mins_rem = parseInt(secs/60);
            var secs_rem = secs%60;

            if(mins_rem<10 && secs_rem>=10)
                ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":"+secs_rem;
            else if(secs_rem<10 && mins_rem>=10)
                ele.innerHTML = "Time Remaining: "+mins_rem+":0"+secs_rem;
            else if(secs_rem<10 && mins_rem<10)
                ele.innerHTML = "Time Remaining: "+"0"+mins_rem+":0"+secs_rem;
            else
                ele.innerHTML = "Time Remaining: "+mins_rem+":"+secs_rem;
            if(mins_rem=="00" && secs_rem < 1){
                quiz_submit();
                flag=true;
            }
            if(!flag){
            secs--;}
            //to animate the timer otherwise it'd just stay at the number entered
            //calling timer() again after 1 sec
            var time_again = setTimeout('timer('+secs+')',1000);
        }
        //wwarning confirmation that appears on closing/refreshing the quiz window/tab
        function disableF5(e) { if ((e.which || e.keyCode) == 116) {e.preventDefault()};
            if ((e.which || e.keyCode) == 122) {e.preventDefault();}
            if((e.which||e.keyCode)==27) {e.preventDefault()};
        };
        $(document).on("keydown", disableF5);
    </script>

@stop
