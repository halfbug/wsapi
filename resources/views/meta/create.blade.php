@php 
if(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
else
    $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
Meta data
@endsection

@section('css')
@endsection

@section('script')
<!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     -->
    <script>
        $(function() {
            setTimeout(function() {
                $("#successMessage").fadeOut(2000);
            }, 1000);
        });
    </script>
@endsection

@section('heading')
Meta Data <small>settings</small>
@endsection
@section('content')
       
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Meta Data</div>
                    <div class="panel-body">
                        <form  method="POST" action="{{ url('/file/meta/create') }}" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                @if ($errors->has('success'))
                                <div class="form-group " id="successMessage">
                                    <span class="help-block text-center alert-success">
                                        <strong>{{ $errors->first('success') }}</strong>
                                    </span>
                                </div>
                                @endif
                                @if ($errors->has('failure'))
                                <div class="form-group " id="successMessage">
                                    <span class="help-block text-center alert-danger">
                                        <strong>{{ $errors->first('failure') }}</strong>
                                    </span>
                                </div>
                                @endif
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label"></label>
                                    <div class="col-sm-2 text-center">
                                        <strong><u>NAME</u></strong>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <strong><u>VALUES</u></strong>
                                    </div>
                                @if($view == 'backend')
                                    <div class="col-sm-4 text-center">
                                        <strong><u>REQUIRED</u></strong>
                                    </div>
                                @endif
                                </div>
                                <div class="form-group ">
                                    <label for="field1 " class="col-sm-3 control-label">Field 1</label>
                                    <div class="col-sm-2">
                                        Deletion Period (hours)
                                    </div>
                                    <div class="col-sm-4">
                                        @if($view == 'backend')

                                         <input type="number" id="deletion_period" name="deletion_period" value="{{($deletionPeriod->isEmpty())?24:$deletionPeriod[0]->value}}" min="1" max="128000" class="form-control">
                                        @elseif($view == 'dashboard')
                                            {{$deletionPeriod[0]->value}}
                                        @endif
                                    </div>
                                @if($view == 'backend')
                                    <div class="col-sm-3">
                                        <input type="checkbox" checked disabled>
                                    </div>
                                @endif
                                </div>
                                <div class="form-group">
                                   <label class="col-sm-6 control-label"><u>Text Fields</u></label>
                                </div>
                                @php
                                    $field_number = 1;
                                @endphp
                                @foreach($adminmeta as $key => $meta)
                                @if(!$meta->is_numeric)
                                @php
                                    $field_number++;
                                @endphp
                                    @if($view == 'dashboard')
                                    <div class="form-group">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            {{$meta->name}}
                                        </div>
                                        <div class="col-sm-4">
                                            {{$meta->value}}
                                        </div>                                        
                                    </div>
                                    @elseif($view == 'backend')
                                    <div class="form-group{{ $errors->has('field'.$field_number) ? ' has-error' : '' }}">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            @if ($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{old('name.'.$field_number)}}" placeholder="Name">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{$meta->name}}" placeholder="Name">
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            @if($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{old('values.'.$field_number)}}" placeholder="Comma separated values">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{$meta->value}}" placeholder="Comma separated values">
                                            @endif
                                            @if ($errors->has('field'.$field_number))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field'.$field_number) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            <input id="fixed[{{$field_number}}]" name="fixed[{{$field_number}}]" checked type="checkbox" >
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                @endforeach

                                @foreach($usermeta as $meta)
                                @if(!$meta->is_numeric)
                                @php
                                    $field_number++;
                                @endphp
                                    <div class="form-group{{ $errors->has('field'.$field_number) ? ' has-error' : '' }}">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            @if ($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{old('name.'.$field_number)}}" placeholder="Name">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{$meta->name}}" placeholder="Name">
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            @if($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{old('values.'.$field_number)}}" placeholder="Comma separated values">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{$meta->value}}" placeholder="Comma separated values">
                                            @endif
                                            @if ($errors->has('field'.$field_number))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field'.$field_number) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                        <div class="col-sm-3">
                                            <input id="fixed[{{$field_number}}]" name="fixed[{{$field_number}}]" type="checkbox" >
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                @endforeach

                                @while ($field_number < 10)
                                    @php
                                        $field_number++;
                                    @endphp
                                    <div class="form-group{{ $errors->has('field'.$field_number) ? ' has-error' : '' }}">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{old('name.'.$field_number)}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{old('values.'.$field_number)}}" placeholder="Comma separated values">
                                            @if ($errors->has('field'.$field_number))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field'.$field_number) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                        <div class="col-sm-3">
                                            <input id="fixed[{{$field_number}}]" name="fixed[{{$field_number}}]" type="checkbox" >
                                        </div>
                                        @endif
                                    </div>
                                @endwhile
                                
                                <div class="form-group">
                                   <label class="col-sm-6 control-label"><u>Numeric Fields</u></label>
                                </div>
                                @foreach($adminmeta as $key => $meta)
                                @if($meta->is_numeric)
                                @php
                                    $field_number++;
                                @endphp
                                    @if($view == 'dashboard')
                                    <div class="form-group">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            {{$meta->name}}
                                        </div>
                                        <div class="col-sm-4">
                                            {{$meta->value}}
                                        </div>                                        
                                    </div>
                                    @elseif($view == 'backend')
                                    <div class="form-group{{ $errors->has('field'.$field_number) ? ' has-error' : '' }}">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            @if ($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{old('name.'.$field_number)}}" placeholder="Name">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{$meta->name}}" placeholder="Name">
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            @if($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{old('values.'.$field_number)}}" placeholder="Comma separated values">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{$meta->value}}" placeholder="Comma separated values">
                                            @endif
                                            @if ($errors->has('field'.$field_number))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field'.$field_number) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-sm-3">
                                            <input id="fixed[{{$field_number}}]" name="fixed[{{$field_number}}]" checked type="checkbox" >
                                        </div>
                                    </div>
                                    @endif
                                @endif
                                @endforeach

                                @foreach($usermeta as $meta)
                                @if($meta->is_numeric)
                                @php
                                    $field_number++;
                                @endphp
                                    <div class="form-group{{ $errors->has('field'.$field_number) ? ' has-error' : '' }}">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            @if ($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{old('name.'.$field_number)}}" placeholder="Name">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{$meta->name}}" placeholder="Name">
                                            @endif
                                        </div>
                                        <div class="col-sm-4">
                                            @if($errors->has('show_old'))
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{old('values.'.$field_number)}}" placeholder="Comma separated values">
                                            @else
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{$meta->value}}" placeholder="Comma separated values">
                                            @endif
                                            @if ($errors->has('field'.$field_number))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field'.$field_number) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                        <div class="col-sm-3">
                                            <input id="fixed[{{$field_number}}]" name="fixed[{{$field_number}}]" type="checkbox" >
                                        </div>
                                        @endif
                                    </div>
                                @endif
                                @endforeach

                                @while ($field_number < 15)
                                    @php
                                        $field_number++;
                                    @endphp
                                    <div class="form-group{{ $errors->has('field'.$field_number) ? ' has-error' : '' }}">
                                        <label for="field{{$field_number}}"  class="col-sm-3 control-label">Field {{$field_number}}</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control alpha_numeric" id="name[{{$field_number}}]" name="name[{{$field_number}}]" value="{{old('name.'.$field_number)}}" placeholder="Name">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control alpha_numeric" id="values[{{$field_number}}]" name="values[{{$field_number}}]" value="{{old('values.'.$field_number)}}" placeholder="Comma separated values">
                                            @if ($errors->has('field'.$field_number))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('field'.$field_number) }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($view == 'backend')
                                        <div class="col-sm-3">
                                            <input id="fixed[{{$field_number}}]" name="fixed[{{$field_number}}]" type="checkbox" >
                                        </div>
                                        @endif
                                    </div>
                                @endwhile
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
@endsection