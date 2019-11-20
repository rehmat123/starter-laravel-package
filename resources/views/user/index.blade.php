@extends('layouts.app')
@section('content')
        <!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{$title}}</title>

</head>
<body>

<!-- Content Errors (Page header) -->


<div>
    <div class="row">
        <div class="col-md-12">

                {{Form::model($data,['route'=>$action,'id',$id])}}
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('Name')}}
                        {{Form::text('name',null,['class'=>'form-control'])}}
                        {{Form::hidden('id')}}
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        {{Form::label('Password')}}
                        {{Form::text('password','',['class'=>'form-control'])}}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('Email')}}
                        {{Form::text('email',null,['class'=>'form-control'])}}
                    </div>

                    <!-- /.form-group -->
                    <div class="form-group">
                        {{Form::label('Confirm Password')}}
                        {{Form::text('password_confirmation','',['class'=>'form-control'])}}
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('Role')}}
                        {{Form::select('roleId',$roles,$default,['class'=>'form-control',"placeholder"=>'Please Select Role'])}}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-small btn-primary">Submit</button>
                    </div>
                </div>
                <!-- /.col -->
                {{Form::close()}}

        </div>

    </div>
</div>

<!-- /.row -->
<!-- /.content -->




</body>
<script type="text/javascript">

    $("#add-new-form").hide();
    $(".add-new-btn").click(function(){
       $("#add-new-form").slideDown();
        $(".add-new-btn").hide();
    });

</script>
</html>

@stop
