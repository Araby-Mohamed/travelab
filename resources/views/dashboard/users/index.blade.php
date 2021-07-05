@extends('dashboard.layouts.master')
@section('title')
    {{ __('lang.users') }}
@stop
@section('content')
    <div class="page-content-wrapper users">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>{{ __('lang.users') }}</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <a href="{{ route('dashboard') }}">{{ __('lang.dashboard') }}</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span class="active">{{ __('lang.users') }}</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <div class="search-content">
                        <form action="{{ route('dashboard.users') }}" method="get" id="searchForm">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="username"><small>{{ __('lang.username') }}</small></label>
                                            <input type="text" id="username" name="username" value="{{ old('username', request()->username ?? '') }}" class="form-control" placeholder="{{ __('lang.enter') }} {{ __('lang.username') }}">
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
                            @permission('delete-users')
                                <form action="{{ route('dashboard.users.deletes') }}" method="post" id="deletesData">
                                    @csrf
                            @endpermission
                                    <div class="portlet light bordered">
                                        <div class="portlet-title tabbable-line">
                                            <div class="caption caption-md">
                                                <i class="icon-globe theme-font hide"></i>
                                                <span class="caption-subject font-blue-madison bold uppercase">{{ __('lang.users') }}</span>
                                            </div>
                                            @permission('delete-users')
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
                                                                    <th> {{ __('lang.phone') }} </th>
                                                                    <th> Date Of Birth </th>
                                                                    <th> {{ __('lang.image') }} </th>
                                                                    <th> {{ __('lang.currency') }} </th>
                                                                    @permission('read-packages')
                                                                    <td>Packages</td>
                                                                    @endpermission
                                                                    @permission('read-packages')
                                                                        <td>Ratings</td>
                                                                    @endpermission
                                                                    <th style="width: 150px;"> {{ __('lang.control') }} </th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($data as $get)
                                                                    <tr>
                                                                        <td><input type="checkbox" class="checkbox-style DataCheckBox" value="{{ $get->id }}" name="data[]"></td>
                                                                        <td>{{ $get->username }}</td>
                                                                        <td>{{ $get->phone }}</td>
                                                                        <td>{{ $get->date_of_birth }}</td>
                                                                        <td><img src="{{ ($get->image != null ? url($get->image) : url('images/user.png') ) }}" class="thumbnail" width="50" style="margin: auto;display: block"></td>
                                                                        <td>{{ ($get->currency_id != null ? $get->currency->title : '' ) }}</td>
                                                                        @permission('read-packages')
                                                                            <td>
                                                                                <a href="{{ route('dashboard.packages' , 'type='.$get->id ) }}" title="Packages" data-id="{{ route('dashboard.users.delete', $get->id) }}" class="btn btn-primary"><i class="fa fa-archive"></i></a>
                                                                            </td>
                                                                        @endpermission
                                                                        @permission('read-rating')
                                                                            <td>
                                                                                <a href="{{ route('dashboard.ratings', 'user='.$get->id ) }}" title="Ratings" class="btn btn-dark" style="background-color: orange; color: #fff;"><i class="fa fa-star" aria-hidden="true"></i></a>
                                                                            </td>
                                                                        @endpermission
                                                                        <td>
                                                                            <a href="{{ route('dashboard.users.show', $get->id) }}" title="{{ __('lang.show') }}" class="btn btn-warning"><i class="fa fa-eye"></i></a>
                                                                            @permission('delete-users')
                                                                                <a href="javascript:;" title="{{ __('lang.delete') }}" data-id="{{ route('dashboard.users.delete', $get->id) }}" class="btn btn-danger confirmDeleteItem"><i class="fa fa-trash"></i></a>
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
                            @permission('delete-users')
                                </form>
                            @endpermission
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @permission('delete-users')
        <form id="delete-form" style="display:none;" method="post">@csrf</form>
    @endpermission
@stop
