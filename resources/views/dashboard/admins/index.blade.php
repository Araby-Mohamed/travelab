@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.admins') }}
@stop
@section('content')
    <div class="page-content-wrapper admins">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.admins') }}</h1>
                </div>
                @permission('create-admins')
                    <a class="add_admins" title="{{ __('lang.add_admin') }}" href="{{ route('dashboard.admins.create') }}"><i class="icon-plus"></i></a>
                @endpermission
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.admins') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-content">
                        <form action="{{ route('dashboard.admins') }}" method="get" id="searchForm">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="role">{{ __('lang.role') }}</label>
                                                <select id="role" data-title="{{ __('lang.choose') }} {{ __('lang.role') }}" name="role" class="form-control bs-select">
                                                    @foreach($roles as $get)
                                                        <option {{ old('role', request()->role ?? '') == $get->slug ? 'selected' : '' }} value="{{ $get->slug }}">{{ $get->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username"><small>{{ __('lang.username') }}</small></label>
                                                <input type="text" id="username" name="username" value="{{ old('username', request()->username ?? '') }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.username') }}">
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
                            @permission('delete-admins')
                                <form action="{{ route('dashboard.admins.deletes') }}" method="post" id="deletesData">
                                    @csrf
                            @endpermission
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.admins') }}</span>
                                            </div>
                                            @permission('delete-admins')
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
                                                                    <th> {{ __('lang.username') }} </th>
                                                                    <th> {{ __('lang.email') }} </th>
                                                                    <th> {{ __('lang.phone') }} </th>
                                                                    <th> {{ __('lang.role') }} </th>
                                                                    <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($data as $get)
                                                                    <tr>
                                                                        <td><input type="checkbox" class="checkbox-style {{ (auth('admin')->user()->id != $get->id) && ($get->roles->first()->id != 1) ? 'DataCheckBox' : '' }}" {{ (auth('admin')->user()->id == $get->id) || ($get->roles->first()->id == 1) ? 'disabled' : '' }} value="{{ $get->id }}" name="data[]"></td>
                                                                        <td>{{ $get->username }}</td>
                                                                        <td>{{ $get->email }}</td>
                                                                        <td class="ltr">{{ $get->phone }}</td>
                                                                        <td><a href="{{ route('dashboard.admins') }}?role={{ $get->roles->first()->slug }}" class="main_color">{{ $get->roles->first()->name }}</a></td>
                                                                        <td>
                                                                            @permission('update-admins')
                                                                                <a href="{{ route('dashboard.admins.edit', $get->id) }}" title="{{ __('lang.edit') }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                                            @endpermission
                                                                            @permission('delete-admins')
                                                                                @if((auth('admin')->user()->id != $get->id) && ($get->roles->first()->id != 1))
                                                                                    <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.admins.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
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
                            @permission('delete-admins')
                                </form>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @permission('delete-admins')
        <form id="delete-form" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop
