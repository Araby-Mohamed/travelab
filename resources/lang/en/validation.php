<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => 'The :attribute must be a date after :date.',
    'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
    'alpha' => 'The :attribute may only contain letters.',
    'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
    'alpha_num' => 'The :attribute may only contain letters and numbers.',
    'array' => 'The :attribute must be an array.',
    'before' => 'The :attribute must be a date before :date.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'date' => 'The :attribute is not a valid date.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'The :attribute does not match the format :format.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => 'The :attribute field has a duplicate value.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'en.desc'                   => 'Small Description',
        'en.short_description'      => 'Short Description',
        'link'                      => 'Link',
        'translatable.site_name.en.value' => 'site name in english',
        'translatable.site_name.ar.value' => 'site name in arabic',
        'translatable.sm_description.en.value' => 'short description in english',
        'translatable.sm_description.ar.value' => 'short description in arabic',
        'en.title' => 'title in english',
        'ar.title' => 'title in arabic',
        'en.description' => 'description in english',
        'ar.description' => 'description in arabic',
        'en.keywords' => 'keywords in english',
        'ar.keywords' => 'keywords in arabic',
        'en.sm_title' => 'small title in english',
        'ar.sm_title' => 'small title in arabic',


        'en.company_name' => 'Company Name in english',
        'en.company_address' => 'Company Address in english',
        'en.company_about' => 'Company About in english',
        'en.meta_keywords' => 'Meta Keywords in english',
        'en.meta_description' => 'Meta Description in english',

        'ar.company_name' => 'Company Name in arabic',
        'ar.company_address' => 'Company Address in arabic',
        'ar.company_about' => 'Company About in arabic',
        'ar.meta_keywords' => 'Meta Keywords in arabic',
        'ar.meta_description' => 'Meta Description in arabic',

        'discount_ratio' => 'Discount Ratio',
        'company_email' => 'Company Email',
        'permissions' => 'Permissions',

        'text' => 'Text',
        'color' => 'Color',
        'font_size' => 'Font Size',
        'text_here' => 'Text Here',
        'name_setting' => 'Name Setting',
        'date_setting' => 'Date Setting',
        'number_setting' => 'Membership Number Setting',
        'image_membership_setting' => 'Membership Image Setting',
        'per_month' => 'Per Month',
        'duration' => 'Duration',
        'membership_cost' => 'Membership cost',
        'numbers_members' => 'Numbers of Members',
        'limited' => 'Limited',
        'unlimited' => 'Unlimited',
        'limit_type' => 'Limit Type',
        'name_setting.text' => 'Name Setting Text',
        'name_setting.size' => 'Name Setting Font Size',
        'name_setting.color' => 'Name Setting Color',

        'number_setting.size' => 'Number Setting Font Size',
        'number_setting.color' => 'Number Setting Color',

        'date_setting.size' => 'Date Setting Font Size',
        'date_setting.color' => 'Date Setting Color',
        'confirmation_code' => 'Confirmation Code',
        'code' => 'Membership Code',
        'verification_code' => 'Verification Code',
        'role' => 'Role',
        'copyright' => 'Copyright',
        'copyright_link_text' => 'Copyright Link Text',
        'copyright_link' => 'Copyright Link',
        'site_name' => 'Site Name',
        'sm_description' => 'Small Description',
        'phone_2' => 'Phone 2',
        'email_1' => 'Email 1',
        'email_2' => 'Email 2',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
        'snapchat' => 'Snapchat',
        'logo' => 'Logo',
        'logo_white' => 'White Logo',
        'favicon' => 'Favicon',


    ],

];
