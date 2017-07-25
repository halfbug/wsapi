@php
    if(\Auth::user()->hasRole('siteuser'))
        $view = "dashboard";
    else
        $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
@endsection

@section('css')
@endsection

@section('script')
@endsection

@section('heading')
    Settings &nbsp; <a href="/setting/create" class="btn btn-primary">Add New</a>&nbsp;<small><a href="/setting" >Back</a></small>
@endsection
@section('content')
    <div class="col-md-12">
        @if(count($settings)>0)
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Option</th>
                <th>Section</th>
                <th>Status</th>
                <th class="text-center" >Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($settings as $post)
                <tr>
                    <td>{{$post['name']}}</td>
                    <td>{{$post['value']}}</td>
                    <td>{{$post['option']}}</td>
                    <td>{{$post['section']}}</td>
                    <td><a href="{{action('SettingController@edit', $post['id'])}}" class="btn btn-warning">Edit</a></td>
                    <td>
                        <form action="{{action('SettingController@destroy', $post['id'])}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            @else
        <table class="table table-striped">
            <thead>
            <tr>
                <td>
                    <div class="col-sm-8 alert alert-warning text-center">Sorry No Record Found Please Add Setting</div>
                </td>
            </tr>
            </thead>
        </table>
            @endif
    </div>
@endsection