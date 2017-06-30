@extends('layouts.frontend')
@section('title')
Welcome
@endsection
@section('css')

@endsection

@section('heading')
API Documentation
@endsection
@section('content')
<div class="row">
    <!-- Sidebar Column -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="#intro" class="list-group-item">Introduction</a>

        </div>
    </div>
    <!-- Content Column -->
    <div class="col-md-9">
        <h2 id="intro">Introduction</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.


            Soluta, et temporibus, facere perferendis veniam beatae non debitis, numquam blanditiis necessitatibus vel mollitia dolorum laudantium, voluptate dolores iure maxime ducimus fugit.</p>
        <example> </example>
        
        <div id="app">
        </div>
    </div>
</div>
<!-- /.row -->
@endsection  

@section('script')
@parent




@endsection