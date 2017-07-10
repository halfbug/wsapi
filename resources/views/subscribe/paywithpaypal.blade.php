@extends('layouts.frontend')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    @if ($message = Session::get('success'))
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php Session::forget('success');?>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="custom-alerts alert alert-danger fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            {!! $message !!}
                        </div>
                        <?php Session::forget('error');?>
                    @endif
                    <div class="panel-heading">Paywith Paypal</div>
                    <div class="panel-body">
                        <h2 class="">{{ ucfirst($package->name) }}</h2>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>{{ $package->files_count }}</strong> Files Upload</li>
                            <li class="list-group-item"><strong>${{ $package->price }}</strong> Price</li>
                            @if($package->duration_count)
                                <li class="list-group-item"><strong>{{ $package->duration_count .' / '. $package->duration}}</strong></li>
                            @else
                                <li class="list-group-item"><strong>Unlimited Months</strong></li>
                            @endif
                            <li class="list-group-item"><strong>{{ $package->getDuration().' package' }}</strong></li>
                        </ul>

                        <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('subscribe.paypal') !!}" >
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                {{--<label for="amount" class="col-md-4 control-label">Amount</label>--}}
                                <div class="col-md-6">
                                    <input id="amount" type="hidden" class="form-control" name="amount" value="{{ $package->price }}" autofocus>
                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Paywith Paypal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection