<?php

return [
    // Pesan default untuk validasi Laravel
    'required' => 'Kolom :attribute wajib diisi.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'unique' => 'Kolom :attribute sudah digunakan.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'max' => [
        'string' => 'Kolom :attribute maksimal :max karakter.',
    ],
    'min' => [
        'string' => 'Kolom :attribute minimal :min karakter.',
    ],
    // Tambahkan pesan untuk captcha
    'captcha' => 'Captcha tidak valid atau belum diisi.',
];