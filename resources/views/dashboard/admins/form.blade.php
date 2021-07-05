@csrf
<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('role') ? 'has-error' : '' }}">
                    <label for="role">{{ __('lang.role') }} <span class="required">*</span></label>
                    <select id="role" name="role" data-title="{{ __('lang.choose') }} {{ __('lang.role') }}" data-live-search="true" class="form-control bs-select">
                        @foreach($roles as $role)
                            <option {{ $role->id == old('role', isset($data->roles) ? $data->roles->pluck('id')->first() : '') ? 'selected' : '' }} {{ $role->id == old('role') ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                    <label class="control-label" for="username">{{ __('lang.username') }} <span class="required">*</span></label>
                    <input type="text" name="username" id="username" value="{{ old('username', $data->username ?? '') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.username') }}" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label" for="email">{{ __('lang.email') }} <span class="required">*</span></label>
                    <input type="email" name="email" id="email" value="{{ old('email', $data->email ?? '') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.email') }}" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="control-label" for="password">{{ __('lang.password') }} <span class="required">*</span></label>
                    <input type="password" name="password" id="password" autocomplete="new-password" placeholder="{{ __('lang.enter') }} {{ __('lang.password') }}" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label class="control-label" for="phone">{{ __('lang.phone') }} <span class="required">*</span></label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $data->phone ?? '') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.phone') }}" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                    <label class="display-block" for="image">{{ __('lang.choose') }} {{ __('lang.image') }} <span class="required"> {{ __('lang.best_size') }} (300 * 300)</span></label>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img style="width: 150px;" src="{{ isset($data->image) ? asset($data->image) : asset('images/user.png') }}"/>
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"> </div>
                        <div>
                            <span class="btn default btn-file">
                                <span class="fileinput-new"> {{ __('lang.choose') }} {{ __('lang.image') }}</span>
                                <span class="fileinput-exists">{{ __('lang.change') }} {{ __('lang.image') }} </span>
                                <input type="file" name="image" id="image">
                            </span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ __('lang.delete') }} {{ __('lang.image') }} </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-9">
                    <button type="submit" id="submit" class="btn green">{{ __('lang.submit') }}</button>
                    <a href="{{ route('dashboard.admins') }}" class="btn default">{{ __('lang.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script src="{{ asset('admin/assets/js/masonry.min.js') }}"></script>

    <script>
        $('.permission_section').masonry({
            itemSelector: '.sm_section_permission',
            isOriginLeft: '{{ app()->getLocale() == 'ar' ? false : true }}',
            percentPosition: true
        });
    </script>
@stop