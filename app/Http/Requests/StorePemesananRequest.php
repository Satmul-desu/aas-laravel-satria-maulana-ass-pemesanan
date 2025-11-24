<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemesananRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_pemesan' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pemesanans,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_pemesanan' => 'required|date|after_or_equal:today',
            'jenis_layanan' => 'required|string|max:255',
            'deskripsi' => 'required|string|min:10',
            'harga' => 'required|numeric|min:0',
            'status' => 'in:pending,confirmed,completed,cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_pemesan.required' => 'Nama pemesan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'tanggal_pemesanan.required' => 'Tanggal pemesanan wajib diisi.',
            'tanggal_pemesanan.after_or_equal' => 'Tanggal pemesanan tidak boleh kurang dari hari ini.',
            'jenis_layanan.required' => 'Jenis layanan wajib dipilih.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
