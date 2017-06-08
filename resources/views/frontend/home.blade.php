@extends('layouts.frontend')
@section('title')
Welcome
@endsection
@section('css')

@endsection

@section('heading')
Dashboard
@endsection
@section('content')
<!-- settings Tabs -->

<div class="row">
    <!--       include side bar file here-->
        @include('frontend.sidebar')
    
    <!-- Content Column -->
    <div class="col-md-9">
        <h2>Welcome!!</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, et temporibus, facere perferendis veniam beatae non debitis, numquam blanditiis necessitatibus vel mollitia dolorum laudantium, voluptate dolores iure maxime ducimus fugit.</p>
    </div>
</div>
<!-- /.row -->

@endsection  

@section('script')
@parent

<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>


@endsection