@csrf
<div class="form-body form_add">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#General" data-toggle="tab"> {{ __('lang.general') }} </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="General">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">Role <span class="required">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $data->name ?? '') }}" class="form-control" placeholder="Enter Role">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group permissions_card {{ $errors->has('permissions') ? 'has-error' : '' }}">
                            <div class="permissions_header">
                                <h4 class="pull-left"><strong>{{ __('lang.permissions') }}</strong></h4>
                                <div class="selected_permissions pull-right">
                                    <label for="select_permissions">{{ __('lang.select_all') }}</label>
                                    <input type="checkbox" id="select_permissions">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row permission_section">
                                @foreach($permissions as $key => $get)
                                    <div class="sm_section_permission">
                                        <div class="panel-group accordion">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <span class="accordion-toggle"> <label>{{ __('lang.' . $key) }} <input type="checkbox" class="selectBoxPermission"></label></span>
                                                    </h4>
                                                </div>
                                                <div class="panel-collapse in">
                                                    <div class="panel-body">
                                                        @foreach($get as $permission)
                                                            <div class="permission_box">
                                                                @php $old = old('permissions'); @endphp
                                                                <label for="permission_{{ $permission->name }}">{{ app()->getLocale() == 'ar' ? $permission->description : $permission->display_name }}</label>
                                                                <input type="checkbox" class="checked_permission" name="permissions[]" {{ isset($old) ?  (in_array($permission->id, old('permissions')) ? 'checked' : '') : '' }} {{ isset($rolePermissions) ? (in_array($permission->id, $rolePermissions) ? 'checked' : '') : '' }} id="permission_{{ $permission->name }}" value="{{ $permission->id }}">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
            <a href="{{ route('dashboard.roles') }}" class="btn default">{{ __('lang.cancel') }}</a>
        </div>
    </div>
</div>

@section('js')
    <script src="{{ asset('admin/assets/js/masonry.min.js') }}"></script>

    <script>
        $('.permission_section').masonry({
            itemSelector: '.sm_section_permission',
            isOriginLeft: false
        });
    </script>
@stop
