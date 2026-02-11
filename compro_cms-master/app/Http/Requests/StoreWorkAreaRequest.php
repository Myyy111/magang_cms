<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkAreaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Sesuaikan dengan logic authorization Anda
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Validasi Wilayah Kerja
            'wilayah_kerja' => [
                'required',
                'in:kantor_pusat,kantor_wilayah,kantor_cabang'
            ],
            
            // Validasi Unit Kerja - KDKR, Nama KW, KDKC, NMKC
            'kdkr' => [
                'nullable',
                'string',
                'max:10'
            ],
            'nama_kw' => [
                'nullable',
                'string',
                'max:100'
            ],
            'kdkc' => [
                'nullable',
                'string',
                'max:10'
            ],
            'nmkc' => [
                'nullable',
                'string',
                'max:100'
            ],
            
            // Validasi Unit Kerja - Kab/Kota
            'kab_kota' => [
                'nullable',
                'string',
                'max:100'
            ],
            
            // Validasi Unit Kerja - Kantor Cabang/Asisten Deputi
            'kantor_cabang' => [
                'nullable',
                'string',
                'max:150'
            ],
            
            // Validasi Unit Kerja - Deputi/Direktorat/Bidang
            'deputi_direktorat' => [
                'nullable',
                'string',
                'max:150'
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // Pesan Wilayah Kerja
            'wilayah_kerja.required' => 'Wilayah kerja wajib dipilih',
            'wilayah_kerja.in' => 'Pilihan wilayah kerja tidak valid. Pilih salah satu: Kantor Pusat, Kantor Wilayah, atau Kantor Cabang',
            
            // Pesan Kab/Kota
            'kab_kota.required' => 'Kabupaten/Kota wajib diisi',
            'kab_kota.string' => 'Kabupaten/Kota harus berupa teks',
            'kab_kota.min' => 'Kabupaten/Kota minimal 3 karakter',
            'kab_kota.max' => 'Kabupaten/Kota maksimal 100 karakter',
            'kab_kota.regex' => 'Kabupaten/Kota hanya boleh berisi huruf, angka, spasi, dan tanda baca (-, /, ., ,)',
            
            // Pesan Kantor Cabang
            'kantor_cabang.required' => 'Kantor Cabang/Asisten Deputi wajib diisi',
            'kantor_cabang.string' => 'Kantor Cabang/Asisten Deputi harus berupa teks',
            'kantor_cabang.min' => 'Kantor Cabang/Asisten Deputi minimal 3 karakter',
            'kantor_cabang.max' => 'Kantor Cabang/Asisten Deputi maksimal 150 karakter',
            'kantor_cabang.regex' => 'Kantor Cabang/Asisten Deputi hanya boleh berisi huruf, angka, spasi, dan tanda baca (-, /, ., ,)',
            
            // Pesan Deputi/Direktorat
            'deputi_direktorat.required' => 'Deputi/Direktorat/Bidang wajib diisi',
            'deputi_direktorat.string' => 'Deputi/Direktorat/Bidang harus berupa teks',
            'deputi_direktorat.min' => 'Deputi/Direktorat/Bidang minimal 3 karakter',
            'deputi_direktorat.max' => 'Deputi/Direktorat/Bidang maksimal 150 karakter',
            'deputi_direktorat.regex' => 'Deputi/Direktorat/Bidang hanya boleh berisi huruf, angka, spasi, dan tanda baca (-, /, ., ,)'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'wilayah_kerja' => 'Wilayah Kerja',
            'kab_kota' => 'Kabupaten/Kota',
            'kantor_cabang' => 'Kantor Cabang/Asisten Deputi',
            'deputi_direktorat' => 'Deputi/Direktorat/Bidang'
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Trim whitespace dari semua input
        $this->merge([
            'kab_kota' => trim($this->kab_kota ?? ''),
            'kantor_cabang' => trim($this->kantor_cabang ?? ''),
            'deputi_direktorat' => trim($this->deputi_direktorat ?? '')
        ]);
    }
}
