@extends('layouts.frontend')
@section('title')
Welcome
@endsection
@section('css')

@endsection

@section('heading')
Packages
@endsection
@section('content')
<!-- Content Row -->
        <div class="row">
        @foreach ($enabledpackages as $epackage)
			<div class="col-md-4">
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $epackage->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>{{ $epackage->price }}</span>
                        <span class="period">{{ $epackage->start_date }}</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{ $epackage->files_count }}</strong> Total Files</li>
                        <li class="list-group-item"><strong>{{ $epackage->price }}</strong> Price</li>
                        @if($epackage->duration_count)
							<li class="list-group-item"><strong>{{ $epackage->duration_count .' / '. $epackage->duration}}</strong></li>
						@endif
                        <li class="list-group-item"><strong>{{ $epackage->duration.' package' }}</strong></li>
                       <li class="list-group-item"><a href="#" class="btn btn-primary">Sign Up!</a>
                        </li>
                    </ul>
                </div>
			</div>
        @endforeach 


			<!-- <div class="col-md-4">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">Basic</h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>19<sup>99</sup></span>
                        <span class="period">per month</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>1</strong> User</li>
                        <li class="list-group-item"><strong>5</strong> Projects</li>
                        <li class="list-group-item"><strong>Unlimited</strong> Email Accounts</li>
                        <li class="list-group-item"><strong>10GB</strong> Disk Space</li>
                        <li class="list-group-item"><strong>100GB</strong> Monthly Bandwidth</li>
                        <li class="list-group-item"><a href="#" class="btn btn-primary">Sign Up!</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">Plus <span class="label label-success">Best Value</span></h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>39<sup>99</sup></span>
                        <span class="period">per month</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>10</strong> User</li>
                        <li class="list-group-item"><strong>500</strong> Projects</li>
                        <li class="list-group-item"><strong>Unlimited</strong> Email Accounts</li>
                        <li class="list-group-item"><strong>1000GB</strong> Disk Space</li>
                        <li class="list-group-item"><strong>10000GB</strong> Monthly Bandwidth</li>
                        <li class="list-group-item"><a href="#" class="btn btn-primary">Sign Up!</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ultra</h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>159<sup>99</sup></span>
                        <span class="period">per month</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Unlimted</strong> Users</li>
                        <li class="list-group-item"><strong>Unlimited</strong> Projects</li>
                        <li class="list-group-item"><strong>Unlimited</strong> Email Accounts</li>
                        <li class="list-group-item"><strong>10000GB</strong> Disk Space</li>
                        <li class="list-group-item"><strong>Unlimited</strong> Monthly Bandwidth</li>
                        <li class="list-group-item"><a href="#" class="btn btn-primary">Sign Up!</a>
                        </li>
                    </ul>
                </div>
            </div>-->
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