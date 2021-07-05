@csrf
<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="control-label" for="title">{{ __('lang.title') }} <span class="required">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $data->title ?? '') }}" placeholder="{{ __('lang.enter') }} {{ __('lang.title') }}" class="form-control" />
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
                    <a href="{{ route('dashboard.interests') }}" class="btn default">{{ __('lang.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>

