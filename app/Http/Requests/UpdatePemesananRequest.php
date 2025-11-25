<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemesananRequest extends FormRequest
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
        $pemesananId = $this->route('pemesanan')->id ?? null;

        return [
            'nama_pemesan' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255|unique:pemesanans,email,' . $pemesananId,
            'telepon' => 'sometimes|required|string|max:20',
            'alamat' => 'sometimes|required|string',
            'tanggal_pemesanan' => 'sometimes|required|date',
            'jenis_layanan' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string|min:10',
            'harga' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|in:pending,confirmed,completed,cancelled',
            'alat_id' => 'required|array',
            'alat_id.*' => 'exists:alats,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'numeric|min:1',
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
            'jenis_layanan.required' => 'Jenis layanan wajib dipilih.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'deskripsi.min' => 'Deskripsi minimal 10 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}
