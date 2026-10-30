<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $submittedItems = $this->input('items', []);

        $selectedItems = collect($submittedItems)
            ->filter(fn($row) => is_array($row) && isset($row['item_id']))
            ->all();

        $this->merge([
            'items' => $selectedItems,
        ]);
    }

    public function rules(): array
    {
        return [
            'status' => [
                'required',
                Rule::in(['pending', 'processing', 'completed', 'cancelled']),
            ],
            'items' => ['required', 'array', 'min:1'],
            'items.*.item_id' => [
                'required',
                'integer',
                'distinct',
                'exists:items,id',
            ],
            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }
}
