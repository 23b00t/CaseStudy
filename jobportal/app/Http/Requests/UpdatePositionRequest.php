<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Position;
use App\Models\Company;

class UpdatePositionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Get the positionId from the route
        $positionId = $this->route('position'); // Hole die Position-ID aus der Route
        $position = Position::find($positionId)->first();

        // Get the Company the user has created
        $userId = auth()->id();
        $company = Company::where('user_id', $userId)->first();
        // dd($position->company_id, $company->id);

        // Ensure that $position is not NULL and the position was created by the current user
        return $position && $company->id === $company->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'salary' => 'required|integer',
        ];
    }
}
