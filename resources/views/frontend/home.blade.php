@extends('layouts.frontend')
@section('title')
Welcome
@endsection
@section('css')

@endsection

@section('heading')
Settings
@endsection
@section('content')
<!-- settings Tabs -->

<div class="row">
    <!-- Sidebar Column -->
    <div class="col-md-3">
        <div class="list-group">
            <a href="index.html" class="list-group-item">Meta data</a>
            <a href="about.html" class="list-group-item">Uploaded Files</a>
            <a href="services.html" class="list-group-item">Proceed Files</a>
            <a href="contact.html" class="list-group-item">Downloaded Files</a>

        </div>
    </div>
    <!-- Content Column -->
    <div class="col-md-9">
        <h2>Welcome!!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, et temporibus, facere perferendis veniam beatae non debitis, numquam blanditiis necessitatibus vel mollitia dolorum laudantium, voluptate dolores iure maxime ducimus fugit.</p>
    </div>
</div>
<!-- /.row -->

@endsection  

@section('css')
@parent

<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>


@endsection