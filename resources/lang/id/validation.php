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

    'accepted' => 'Atribut :attribute harus diterima.',
    'active_url' => 'Atribut :attribute bukan URL yang valid.',
    'after' => 'Atribut :attribute harus berisi tanggal setelah :date.',
    'after_or_equal' => 'Atribut :attribute harus berisi tanggal setelah atau sama dengan :date.',
    'alpha' => 'Atribut :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Atribut :attribute hanya boleh berisi huruf, angka, strip dan underscore.',
    'alpha_num' => 'Atribut :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Atribut :attribute harus berupa sebuah array.',
    'before' => 'Atribut :attribute harus berisi tanggal sebelum :date.',
    'before_or_equal' => 'Atribut :attribute harus berisi tanggal sebelum atau sama dengan :date.',
    'between' => [
        'numeric' => 'Atribut :attribute harus antara :min dan :max.',
        'file' => 'Atribut :attribute harus antara :min dan :max kilobyte.',
        'string' => 'Atribut :attribute harus antara :min dan :max karakter.',
        'array' => 'Atribut :attribute harus memiliki antara :min dan :max item.',
    ],
    'boolean' => 'Atribut :attribute harus bernilai true atau false.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => 'Atribut :attribute bukan tanggal yang valid.',
    'date_equals' => 'Atribut :attribute harus berupa tanggal yang sama dengan :date.',
    'date_format' => 'Atribut :attribute tidak sesuai format :format.',
    'different' => 'Atribut :attribute dan :other harus berbeda.',
    'digits' => 'Atribut :attribute harus terdiri dari :digits digit.',
    'digits_between' => 'Atribut :attribute harus antara :min dan :max digit.',
    'dimensions' => 'Atribut :attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => 'Atribut :attribute memiliki nilai yang duplikat.',
    'email' => 'Atribut :attribute harus berupa alamat email yang valid.',
    'ends_with' => 'Atribut :attribute harus diakhiri salah satu dari berikut: :values.',
    'exists' => 'Atribut :attribute yang dipilih tidak valid.',
    'file' => 'Atribut :attribute harus berupa berkas.',
    'filled' => 'Atribut :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'Atribut :attribute harus lebih besar dari :value.',
        'file' => 'Atribut :attribute harus lebih besar dari :value kilobyte.',
        'string' => 'Atribut :attribute harus lebih besar dari :value karakter.',
        'array' => 'Atribut :attribute harus memiliki lebih dari :value item.',
    ],
    'gte' => [
        'numeric' => 'Atribut :attribute harus lebih besar atau sama dengan :value.',
        'file' => 'Atribut :attribute harus lebih besar atau sama dengan :value kilobyte.',
        'string' => 'Atribut :attribute harus lebih besar atau sama dengan :value karakter.',
        'array' => 'Atribut :attribute harus memiliki :value item atau lebih.',
    ],
    'image' => 'Atribut :attribute harus berupa gambar.',
    'in' => 'Atribut :attribute yang dipilih tidak valid.',
    'in_array' => 'Atribut :attribute tidak ditemukan di :other.',
    'integer' => 'Atribut :attribute harus berupa bilangan bulat.',
    'ip' => 'Atribut :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Atribut :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Atribut :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Atribut :attribute harus berupa string JSON yang valid.',
    'lt' => [
        'numeric' => 'Atribut :attribute harus kurang dari :value.',
        'file' => 'Atribut :attribute harus kurang dari :value kilobyte.',
        'string' => 'Atribut :attribute harus kurang dari :value karakter.',
        'array' => 'Atribut :attribute harus memiliki kurang dari :value item.',
    ],
    'lte' => [
        'numeric' => 'Atribut :attribute harus kurang atau sama dengan :value.',
        'file' => 'Atribut :attribute harus kurang atau sama dengan :value kilobyte.',
        'string' => 'Atribut :attribute harus kurang atau sama dengan :value karakter.',
        'array' => 'Atribut :attribute tidak boleh memiliki lebih dari :value item.',
    ],
    'max' => [
        'numeric' => 'Atribut :attribute tidak boleh lebih besar dari :max.',
        'file' => 'Atribut :attribute tidak boleh lebih besar dari :max kilobyte.',
        'string' => 'Atribut :attribute tidak boleh lebih dari :max karakter.',
        'array' => 'Atribut :attribute tidak boleh memiliki lebih dari :max item.',
    ],
    'mimes' => 'Atribut :attribute harus berupa file berjenis: :values.',
    'mimetypes' => 'Atribut :attribute harus berupa file berjenis: :values.',
    'min' => [
        'numeric' => 'Atribut :attribute harus minimal :min.',
        'file' => 'Atribut :attribute harus minimal :min kilobyte.',
        'string' => 'Atribut :attribute harus minimal :min karakter.',
        'array' => 'Atribut :attribute harus memiliki minimal :min item.',
    ],
    'not_in' => 'Atribut :attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :attribute tidak valid.',
    'numeric' => 'Atribut :attribute harus berupa angka.',
    'password' => 'Kata sandi salah.',
    'present' => 'Atribut :attribute harus ada.',
    'regex' => 'Format :attribute tidak valid.',
    'required' => 'Atribut :attribute wajib diisi.',
    'required_if' => 'Atribut :attribute wajib diisi ketika :other adalah :value.',
    'required_unless' => 'Atribut :attribute wajib diisi kecuali :other ada di :values.',
    'required_with' => 'Atribut :attribute wajib diisi ketika :values ada.',
    'required_with_all' => 'Atribut :attribute wajib diisi ketika :values ada.',
    'required_without' => 'Atribut :attribute wajib diisi ketika :values tidak ada.',
    'required_without_all' => 'Atribut :attribute wajib diisi ketika tidak ada :values yang ada.',
    'same' => 'Atribut :attribute dan :other harus sama.',
    'size' => [
        'numeric' => 'Atribut :attribute harus berukuran :size.',
        'file' => 'Atribut :attribute harus berukuran :size kilobyte.',
        'string' => 'Atribut :attribute harus berukuran :size karakter.',
        'array' => 'Atribut :attribute harus mengandung :size item.',
    ],
    'starts_with' => 'Atribut :attribute harus diawali salah satu dari: :values.',
    'string' => 'Atribut :attribute harus berupa string.',
    'timezone' => 'Atribut :attribute harus berisi zona waktu yang valid.',
    'unique' => 'Atribut :attribute sudah digunakan.',
    'uploaded' => 'Atribut :attribute gagal diunggah.',
    'url' => 'Format :attribute tidak valid.',
    'uuid' => 'Atribut :attribute harus berupa UUID yang valid.',

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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'password' => 'kata sandi',
        'password_confirmation' => 'konfirmasi kata sandi',
        'telepon' => 'nomor telepon',
        'alamat' => 'alamat',
        'asal_sekolah' => 'asal sekolah',
        'jenjang' => 'jenjang',
        'kelas' => 'kelas',
        'nama_orang_tua' => 'nama orang tua',
        'telp_orang_tua' => 'nomor telepon orang tua',
        // add more attribute name translations as needed
    ],
];
