@extends('dashboard.layouts.master')
@section('title')
    Countries
@stop
@section('content')
    <div class="page-content-wrapper admins">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Countries</h1>
                </div>
                @permission('create-country')
                    <a class="add_admins" title="Add Currency" href="{{ route('dashboard.country.create') }}"><i class="icon-plus"></i></a>
                @endpermission
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">Countries</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-content">
                        <form action="{{ route('dashboard.country') }}" method="get" id="searchForm">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="username"><small>Title</small></label>
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
                            @permission('delete-country')
                                <form action="{{ route('dashboard.country.deletes') }}" method="post" id="deletesData">
                                    @csrf
                            @endpermission
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">Currency</span>
                                            </div>
                                            @permission('delete-country')
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
                                                                    <th> {{ __('lang.title') }} </th>
                                                                    <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($data as $get)
                                                                    <tr>
                                                                        <td><input type="checkbox" class="checkbox-style DataCheckBox" value="{{ $get->id }}" name="data[]"></td>
                                                                        <td>{{ $get->title }}</td>
                                                                        <td>
                                                                            <a href="{{ route('dashboard.governorate',$get->id)}}" title="Governorates" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                                                            @permission('update-country')
                                                                                <a href="{{ route('dashboard.country.edit', $get->id) }}" title="{{ __('lang.edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                                            @endpermission
                                                                            @permission('delete-country')
                                                                                <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.country.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
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
                            @permission('delete-country')
                                </form>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @permission('delete-country')
        <form id="delete-form" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop
