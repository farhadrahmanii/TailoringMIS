<?php

return [
    'otp_code' => 'شپږ رقمی کوډ',

    'mail' => [
        'subject' => 'شپږ رقمی کوډ',
        'greeting' => 'سلام علیکم!',
        'line1' => 'ستاسی شپږ رقمی کود دی: :code',
        'line2' => 'د دغه کود د اعتبار موده :seconds seconds.',
        'line3' => 'که چیری تاسی د کوډ غوښتنه نه وی کړی، نو دغه صفحه نه تیر شی.',
        'salutation' => 'په ډیر احترام, :app_name',
    ],

    'view' => [
        'time_left' => 'باقی وخت په ثانیو باندی',
        'resend_code' => 'بیا کوډ غوښتنه',
        'verify' => 'وارد کړی',
        'go_back' => 'شاته تګ',
    ],

    'notifications' => [
        'title' => 'شپږ رقمی کود ولیږل شوو',
        'body' => 'شپږ رقمی کوډ ستاسی ایمیل ته ولیږل شوو. د اعتبار موده یی :seconds seconds.',
    ],

    'validation' => [
        'invalid_code' => 'کوم کوډ چی تاسی د ننه کړی دی غلط دی.',
        'expired_code' => 'یاد کوډ وخت ختم شوی دی.',
    ],
];
