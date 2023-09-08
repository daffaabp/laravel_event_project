<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class CreateEventRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $now = Carbon::now();
        return [
            'title' => 'required|max:155|min:2',
            'address' => 'required|max:155|min:2',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:2048',  // upload gambar maksimal hanya bisa 1mb
            'start_datetime' => [
                'required',
                'date',
                'after_or_equal:' . $now->format('Y-m-d H:i:s'),
                'before_or_equal:end_date',
                ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_datetime',    // Memeriksa apakah tanggal setelah atau sama dengan start_datetime
                function ($attribute, $value, $fail) use ($now) {
                    $startDate = $this->input('start_datetime');
                    $endDate = $this->input('end_date');

                    // Jika tanggal end_date sama dengan start_datetime, maka valid
                    if ($startDate == $endDate) {
                        return;
                    }

                    $startDate = Carbon::parse($startDate);
                    $endDate = Carbon::parse($endDate);

                    if ($endDate->lessThan($now) || $endDate->lessThan($startDate)) {
                        $fail('The end date must be greater than or equal to start date and today.');
                    }
                },
                ],
            'country_id' => 'required',
            'city_id' => 'required',
            'description' => 'required',
            'num_tickets' => [
                        'required',
                        'integer',
                        'min:1',        // Tiket harus lebih besar atau sama dengan 1
                        ],
            'tags.*' =>  'required|exists:tags,id' // pajak akan di perlukan dan akan ada di tag dan kolomnya akan menjadi ID
        ];
    }
}