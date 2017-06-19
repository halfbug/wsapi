@extends('layouts.backend')

@section('title')
Start Processing
@endsection

@section('css')

@endsection

@section('heading')
Start Processing<small></small>
@endsection

@section('content')
<div class="jumbotron" style="padding-left:20px">
  <h1>Downloading...<h1>
  <p>Your requested file "{{$file->name}}" is being downloaded.</p>
  <p>If downloading has not started yet, please <a href="{{ url('file/download/'.$file->id) }}">click here</a> to download.</p>
</div>
@endsection

@section('script')
<script type="text/javascript">
	window.location.href="{{ url('file/download/'.$file->id) }}";
</script>
@endsection