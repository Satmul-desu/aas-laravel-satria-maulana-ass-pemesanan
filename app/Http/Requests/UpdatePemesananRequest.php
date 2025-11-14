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
        return [
            'nama_pemesan' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'telepon' => 'sometimes|required|string|max:20',
            'alamat' => 'sometimes|required|string',
            'tanggal_pemesanan' => 'sometimes|required|date',
            'jenis_layanan' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'harga' => 'sometimes|required|numeric|min:0',
            'status' => 'sometimes|in:pending,confirmed,completed,cancelled',
        ];
    }
}
