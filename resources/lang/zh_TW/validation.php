<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => '必須接受:attribute。',
    'active_url'           => ':attribute並非一個有效的網址。',
    'after'                => ':attribute必須要晚於 :date。',
    'after_or_equal'       => ':attribute必須要等於 :date 或更晚',
    'alpha'                => ':attribute只能以字母組成。',
    'alpha_dash'           => ':attribute只能以字母、數字及斜線組成。',
    'alpha_num'            => ':attribute只能以字母及數字組成。',
    'array'                => ':attribute必須為陣列。',
    'before'               => ':attribute必須要早於 :date。',
    'before_or_equal'      => ':attribute必須要等於 :date 或更早。',
    'between'              => [
        'numeric' => ':attribute必須介於 :min 至 :max 之間。',
        'file'    => ':attribute必須介於 :min 至 :max KB 之間。 ',
        'string'  => ':attribute必須介於 :min 至 :max 個字元之間。',
        'array'   => ':attribute:必須有 :min - :max 個元素。',
    ],
    'boolean'              => ':attribute必須為布林值。',
    'confirmed'            => '與:attribute確認欄位的輸入不一致。',
    'current_password'     => '當前密碼不正確。',
    'date'                 => ':attribute並非一個有效的日期。',
    'date_format'          => ':attribute不符合 :format 的格式。',
    'different'            => ':attribute與 :other 必須不同。',
    'digits'               => ':attribute必須是 :digits 位數字。',
    'digits_between'       => ':attribute必須介於 :min 至 :max 位數字。',
    'dimensions'           => ':attribute圖片尺寸不正確。',
    'distinct'             => ':attribute已經存在。',
    'email'                => ':attribute必須是有效的電子郵件位址。',
    'exists'               => '所選擇的:attribute選項無效。',
    'file'                 => ':attribute必須是一個檔案。',
    'filled'               => ':attribute不能留空。',
    'gt'                   => [
        'numeric' => ':attribute必須大於 :value。',
        'file'    => ':attribute必須大於 :value KB。',
        'string'  => ':attribute必須多於 :value 個字元。',
        'array'   => ':attribute必須多於 :value 個元素。',
    ],
    'gte'                  => [
        'numeric' => ':attribute必須大於或等於 :value。',
        'file'    => ':attribute必須大於或等於 :value KB。',
        'string'  => ':attribute必須多於或等於 :value 個字元。',
        'array'   => ':attribute必須多於或等於 :value 個元素。',
    ],
    'image'                => ':attribute必須是一張圖片。',
    'in'                   => '所選擇的:attribute 選項無效。',
    'in_array'             => ':attribute沒有在 :other 中。',
    'integer'              => ':attribute必須是一個整數。',
    'ip'                   => ':attribute必須是一個有效的 IP 位址。',
    'ipv4'                 => ':attribute必須是一個有效的 IPv4 位址。',
    'ipv6'                 => ':attribute必須是一個有效的 IPv6 位址。',
    'json'                 => ':attribute必須是正確的 JSON 字串。',
    'lt'                   => [
        'numeric' => ':attribute必須小於 :value。',
        'file'    => ':attribute必須小於 :value KB。',
        'string'  => ':attribute必須少於 :value 個字元。',
        'array'   => ':attribute必須少於 :value 個元素。',
    ],
    'lte'                  => [
        'numeric' => ':attribute必須小於或等於 :value。',
        'file'    => ':attribute必須小於或等於 :value KB。',
        'string'  => ':attribute必須少於或等於 :value 個字元。',
        'array'   => ':attribute必須少於或等於 :value 個元素。',
    ],
    'max'                  => [
        'numeric' => ':attribute不能大於 :max。',
        'file'    => ':attribute不能大於 :max KB。',
        'string'  => ':attribute不能多於 :max 個字元。',
        'array'   => ':attribute最多有 :max 個元素。',
    ],
    'mimes'                => ':attribute必須為 :values 的檔案。',
    'mimetypes'            => ':attribute必須為 :values 的檔案。',
    'min'                  => [
        'numeric' => ':attribute不能小於 :min。',
        'file'    => ':attribute不能小於 :min KB。',
        'string'  => ':attribute不能小於 :min 個字元。',
        'array'   => ':attribute至少有 :min 個元素。',
    ],
    'not_in'               => '所選擇的:attribute 選項無效。',
    'not_regex'            => ':attribute的格式錯誤。',
    'numeric'              => ':attribute必須為一個數字。',
    'present'              => ':attribute必須存在。',
    'regex'                => ':attribute的格式錯誤。',
    'required'             => ':attribute不能留空。',
    'required_if'          => '當:other是:value時:attribute不能留空。',
    'required_unless'      => '當:other不是:value時:attribute 不能留空。',
    'required_with'        => '當:values出現時:attribute不能留空。',
    'required_with_all'    => '當:values出現時:attribute不能為空。',
    'required_without'     => '當:values留空時:attribute field不能留空。',
    'required_without_all' => '當:values都不出現時:attribute不能留空。',
    'same'                 => ':attribute與:other必須相同。',
    'size'                 => [
        'numeric' => ':attribute的大小必須是 :size。',
        'file'    => ':attribute的大小必須是 :size KB。',
        'string'  => ':attribute必須是 :size 個字元。',
        'array'   => ':attribute必須是 :size 個元素。',
    ],
    'string'               => ':attribute必須是一個字串。',
    'timezone'             => ':attribute必須是一個正確的時區值。',
    'unique'               => ':attribute已經存在。',
    'uploaded'             => ':attribute上傳失敗。',
    'url'                  => ':attribute的格式錯誤。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'address'               => '地址',
        'age'                   => '年齡',
        'available'             => '可用的',
        'city'                  => '城市',
        'content'               => '內容',
        'country'               => '國家',
        'date'                  => '日期',
        'day'                   => '天',
        'description'           => '描述',
        'email'                 => '電子郵件',
        'excerpt'               => '摘要',
        'first_name'            => '名',
        'gender'                => '性別',
        'hour'                  => '時',
        'last_name'             => '姓',
        'minute'                => '分',
        'mobile'                => '手機',
        'month'                 => '月',
        'name'                  => '名稱',
        'current_password'      => '當前密碼',
        'password'              => '密碼',
        'password_confirmation' => '確認密碼',
        'phone'                 => '電話',
        'second'                => '秒',
        'sex'                   => '性別',
        'size'                  => '大小',
        'time'                  => '時間',
        'title'                 => '標題',
        'username'              => '使用者名字',
        'year'                  => '年',
    ],
];