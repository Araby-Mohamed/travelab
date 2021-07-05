@extends('dashboard.layouts.master')
@section('title')
    Activities
@stop
@section('content')
    <div class="page-content-wrapper users">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Activities</h1>
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
                    <span class="active">Activities</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    {{-- Include Messages Flash --}}
                    @include('dashboard.includes.flash_msg')
                    <div class="row">
                        <div class="col-md-12">
                            @permission('delete-packages')
                                <form action="{{ route('dashboard.activities.deletes') }}" method="post" id="deletesData">
                                    @csrf
                            @endpermission
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">Activities</span>
                                            </div>
                                            @permission('delete-packages')
                                                <button type="submit" class="btn btn-danger pull-right btnDeleteAll">{{ __('lang.delete_selected') }}</button>
                                            @endpermission
                                        </div>
                                        <div class="portlet-body form">
                                            <div style="padding: 0;" class="form-body form_add form_product">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="table-responsive">
                                                            <table style="margin-top: 10px;" class="table table-bordered table-striped table-condensed flip-content">
                                                                <thead class="flip-content">
                                                                <tr>
                                                                    <th style="width: 50px;"><input type="checkbox" class="checkbox-style" id="DataSelect"></th>
                                                                    <th> Title </th>
                                                                    <th> Estimated Time </th>
                                                                    <th> Cost </th>
                                                                    <th> Location </th>
                                                                    <th> Package </th>
                                                                    <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($data as $get)
                                                                    <tr>
                                                                        <td><input type="checkbox" class="checkbox-style DataCheckBox" value="{{ $get->id }}" name="data[]"></td>
                                                                        <td>{{ $get->title }}</td>
                                                                        <td>{{ $get->estimated_time }}</td>
                                                                        <td>{{ $get->cost }}</td>
                                                                        <td><a href="https://www.google.com/maps/search/?api=1&query={{ $get->location }}" title="Location" target="_blank" class="btn btn-info"><i class="fa fa-map-marker"></i></a></td>
                                                                        <td>{{ $get->package->title }}</td>
                                                                        <td>
                                                                            <a href="{{ route('dashboard.activities.show', $get->id) }}" title="{{ __('lang.show') }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                                                            @permission('read-links')
                                                                                <a href="{{ route('dashboard.links',$get->id) }}" title="Links" class="btn btn-success"><i class="fa fa-link"></i></a>
                                                                            @endpermission
                                                                            @permission('delete-packages')
                                                                                <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.activities.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
                                                                            @endpermission
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        {{ $data->appends(request()->query())->render() }}
                                                    </div>
                                                    @if(!count($data))
                                                        <div class="text-center"><p>{{ __('lang.no_data') }}</p></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @permission('delete-packages')
                                </form>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @permission('delete-packages')
        <form id="delete-form" style="display:none;" method="post">@csrf</form>
        <form id="statusForm" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop
