@php 
if(\Auth::guest())
	$view = 'frontend';
elseif(\Auth::user()->hasRole('siteuser'))
    $view = "dashboard";
else
    $view = "backend";
@endphp

@extends('layouts.'.$view)

@section('title')
Download Processed File
@endsection

@section('css')

@endsection

@section('heading')
Download Processed File<small></small>
@endsection

@section('content')
<div class="jumbotron" style="padding-left:20px">
  <h1>Downloading...<h1>
  <p>Your requested processed file "{{$file->name}}" is being downloaded.</p>
  <p>If downloading has not started yet, please <a href="{{ url('file/download/'.$file->id) }}">click here</a> to download.</p>
</div>
@endsection

@section('script')
<script type="text/javascript">
	window.location.href="{{ url('file/download/'.$file->id) }}";
</script>
@endsection