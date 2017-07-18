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
    Settings<small></small> <a href="/setting/create" class="btn btn-primary">Add New</a>
@endsection
@section('content')
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Value</th>
                <th>Status</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($settings as $post)
                <tr>
                    <td>{{$post['id']}}</td>
                    <td>{{$post['name']}}</td>
                    <td>{{$post['value']}}</td>
                    <td>{{$post['status']}}</td>
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
    </div>
@endsection