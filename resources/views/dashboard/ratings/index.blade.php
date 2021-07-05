@extends('dashboard.layouts.master')
@section('title')
    Ratings
@stop
@section('content')
    <div class="page-content-wrapper users">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Ratings</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Ratings</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-content">
                        <form action="{{ route('dashboard.ratings') }}" method="get" id="searchForm">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="nema"><small>Name</small></label>
                                            <input type="text" id="name" name="name" value="{{ old('name', request()->name ?? '') }}" class="form-control" placeholder="{{ __('lang.name') }}">
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
                            @permission('delete-rating')
                                <form action="{{ route('dashboard.ratings.deletes') }}" method="post" id="deletesData">
                                    @csrf
                            @endpermission
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">Ratings</span>
                                            </div>
                                            @permission('delete-rating')
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
                                                                    <th> Name </th>
                                                                    <th> Rate </th>
                                                                    <th> Status </th>
                                                                    @permission('read-packages')
                                                                    <th> Package </th>
                                                                    @endpermission
                                                                    <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($data as $get)
                                                                    <tr>
                                                                        <td><input type="checkbox" class="checkbox-style DataCheckBox" value="{{ $get->id }}" name="data[]"></td>
                                                                        <td>{{ $get->users->username }}</td>
                                                                        <td>
                                                                            @for($i=1;$i <= 5; $i++)
                                                                                <span class="fa fa-star {{ $get->rate >= $i ? 'checked' : '' }}"></span>
                                                                            @endfor
                                                                        </td>
                                                                        @permission('approve-rating')
                                                                             <td> <a href="javascript:;" data-id="{{ route('dashboard.ratings.status',$get->id) }}" style="{{ $get->status == 1 ? 'background-color: #27ae60 !important;' : 'background-color: #c0392b !important;' }} " title="{{ $get->status == 0 ? 'قبول' : 'رفض' }}" class="btn btn-default btn-new BtnStatus"><i style="color: #fff !important;" class="fa {{ $get->status == 0 ? 'fa-eye-slash' : 'fa-eye' }}"></i></a> </td>
                                                                        @endpermission
                                                                        @permission('read-packages')
                                                                            <td><a href="{{ route('dashboard.packages.show',$get->package->id) }}">{{ $get->package->title }}</a> </td>
                                                                        @endpermission
                                                                        <td>
                                                                            <a href="{{ route('dashboard.ratings.show', $get->id) }}" title="{{ __('lang.show') }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                                                            @permission('delete-rating')
                                                                                <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.ratings.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
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
                            @permission('delete-rating')
                                </form>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @permission('delete-rating')
        <form id="delete-form" style="display:none;" method="post">@csrf</form>
    @endpermission
    @permission('approve-rating')
        <form id="statusForm" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop
