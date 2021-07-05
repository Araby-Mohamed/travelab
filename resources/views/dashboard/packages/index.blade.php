@extends('dashboard.layouts.master')
@section('title')
    Packages
@stop
@section('content')
    <div class="page-content-wrapper users">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Packages</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Packages</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-content">
                        <form action="{{ route('dashboard.packages') }}" method="get" id="searchForm">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="title"><small>{{ __('lang.title') }}</small></label>
                                            <input type="text" id="title" name="title" value="{{ old('title', request()->title ?? '') }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.title') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" id="submit" class="btn btn-block btn_search green">{{ __('lang.search_now') }}</button>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{-- Include Messages Flash --}}
                    @include('dashboard.includes.flash_msg')
                    <div class="row">
                        <div class="col-md-12">
                            @permission('delete-packages')
                                <form action="{{ route('dashboard.packages.deletes') }}" method="post" id="deletesData">
                                    @csrf
                            @endpermission
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">Packages</span>
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
                                                                    @permission('read-rating')
                                                                        <th> Rating </th>
                                                                    @endpermission
                                                                    <th> User </th>
                                                                    @permission('approve-packages')
                                                                        <th>Status</th>
                                                                    @endpermission
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
                                                                        @permission('read-rating')
                                                                            <td>
                                                                                <a href="{{ route('dashboard.ratings', 'type='.$get->id ) }}" title="Ratings" class="btn btn-dark" style="background-color: orange; color: #fff;"><i class="fa fa-star" aria-hidden="true"></i></a>
                                                                            </td>
                                                                        @endpermission
                                                                        <td>{{ $get->user->username }}</td>
                                                                        @permission('approve-packages')
                                                                            <td> <a href="javascript:;" data-id="{{ route('dashboard.packages.status',$get->id) }}" style="{{ $get->status == 1 ? 'background-color: #27ae60 !important;' : 'background-color: #c0392b !important;' }} " title="{{ $get->status == 0 ? 'قبول' : 'رفض' }}" class="btn btn-default btn-new BtnStatus"><i style="color: #fff !important;" class="fa {{ $get->status == 0 ? 'fa-eye-slash' : 'fa-eye' }}"></i></a> </td>
                                                                        @endpermission
                                                                        <td>
                                                                            <a href="{{ route('dashboard.packages.show', $get->id) }}" title="{{ __('lang.show') }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>

                                                                            <a href="{{ route('dashboard.activities', $get->id ) }}" title="Activity" class="btn btn-primary"><i class="fa fa-pie-chart" aria-hidden="true"></i></a>
                                                                            @permission('delete-packages')
                                                                                <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.packages.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
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
    @endpermission
    @permission('approve-packages')
        <form id="statusForm" style="display:none;" method="post">@csrf</form>
    @endpermission

@stop
