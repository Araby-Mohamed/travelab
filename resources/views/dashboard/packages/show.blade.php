@php $titlePage = $data->title; @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $titlePage }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('dashboard.packages') }}">Packages</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ $titlePage }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-lg-12 col-xs-12 col-sm-12">
                    <div class="tab-pane" id="tab_2">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-equalizer font-green-haze"></i>
                                    <span class="caption-subject font-green-haze bold uppercase">{{ $titlePage }}</span>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <div class="text_view">
                                    <p><strong>{{ __('lang.title') }}: </strong> {{ $data->title }}</p>
                                </div>
                                <div class="text_view">
                                    <p><strong>{{ __('lang.description') }}: </strong> {{ $data->description }}</p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Estimated Time: </strong> {{ $data->estimated_time }}</p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Cost: </strong> {{ $data->cost . ' ' . $data->user->currency->code }}</p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Location: </strong> <a href="https://www.google.com/maps/search/?api=1&query={{ $data->location }}" title="Location" target="_blank" class="btn btn-info"><i style="color: #fff;font-size: 15px;" class="fa fa-map-marker"></i></a></p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Interests: </strong>
                                        @foreach($data->tags as $item)
                                            <span style="background: #0e7886;color: #fff;padding: 0 5px;border-radius: 4px;">{{ $item->title }}</span>
                                        @endforeach
                                    </p>
                                </div>
                                <div class="text_view">
                                    <p><strong>Status: </strong> {{ $data->status == 0 ? 'Hide' : 'Show' }}</p>
                                </div>

                                <div class="text_view">
                                    <p>
                                        <strong>Rating: </strong>
                                        @for($i=1;$i <= 5; $i++)
                                            <span class="fa fa-star {{ $rating >= $i ? 'checked' : '' }}"></span>
                                        @endfor
                                    </p>
                                </div>


                                <div class="text_view">
                                    <p><strong>Username: </strong> {{ $data->user->username }}</p>
                                </div>

                                <div class="text_view">
                                    <p><strong>Activities: </strong> <a href="{{ route('dashboard.activities', $data->id ) }}" title="Activity" class="btn btn-primary"><i style="color: #fff;font-size: 15px;" class="fa fa-pie-chart" aria-hidden="true"></i></a></p>
                                </div>


                                <div class="text_view">
                                    <strong>Image: </strong><br><br>
                                    <div class="row">
                                        @foreach($data->images as $item)
                                            <div class="col-md-4">
                                                <img src="{{ url($item->image) }}" class="thumbnail" width="100%">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


