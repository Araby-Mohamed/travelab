@php $titlePage = __('lang.roles'); @endphp
@extends('dashboard.layouts.master')
@section('title')
    {{ $titlePage }}
@stop
@section('content')
    <div class="page-content-wrapper roles">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ $titlePage }}</h1>
                </div>
                @permission('delete-roles')
                    <a class="add_roles" title="{{ __('lang.add_role') }}" href="{{ route('dashboard.roles.create') }}"><i class="icon-plus"></i></a>
                @endpermission
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.roles') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-content">
                        <form action="{{ route('dashboard.roles') }}" method="get" id="searchForm">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="role"><small>{{ __('lang.role') }}</small></label>
                                                <input type="text" id="role" name="role" value="{{ old('role', request()->role ?? '') }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.role') }}">
                                            </div>
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
                            @permission('delete-roles')
                            <form action="{{ route('dashboard.roles.deletes') }}" method="post" id="deletesData">
                                @csrf
                            @endpermission
                                <div class="portlet light bordered">
                                    <div class="portlet-title tabbable-line">
                                        <div class="caption caption-md">
                                            <i class="icon-globe theme-font hide"></i>
                                            <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.roles') }}</span>
                                        </div>
                                        @permission('delete-roles')
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
                                                                <th> {{ __('lang.role') }} </th>
                                                                <th style="width: 250px;"> {{ __('lang.control') }} </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($data as $get)
                                                                <tr>
                                                                    <td><input type="checkbox" class="checkbox-style {{ ($get->id != 1) && (!$get->users_count) ? 'DataCheckBox' : '' }}" {{ ($get->id == 1) || ($get->users_count) ? 'disabled' : '' }} value="{{ $get->id }}" name="data[]"></td>
                                                                    <td>{{ $get->name }}</td>
                                                                    <td>
                                                                        @permission('read-admins')
                                                                        <a href="{{ route('dashboard.admins') }}?role={{ $get->slug }}" title="{{ __('lang.details') }}" class="btn btn-warning relative">
                                                                            <i class="fa fa-users"></i>
                                                                            @if($get->users_count) <span class="count_requests">{{ $get->users_count }}</span> @endif
                                                                        </a>
                                                                        @endpermission

                                                                        @permission('update-roles')
                                                                            <a href="{{ route('dashboard.roles.edit', $get->id) }}" title="{{ __('lang.edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                                        @endpermission
                                                                        @permission('delete-roles')
                                                                            @if(($get->id != 1) && (!$get->users_count))
                                                                                <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.roles.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
                                                                            @endif
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
                            @permission('delete-roles')
                            </form>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @permission('delete-roles')
    <form id="delete-form" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop



