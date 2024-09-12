<?php

namespace App\Services;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestService
{
    /**
     * Создание нового гостя
     *
     * @param Request $request
     * @return Guest
     */
    public function createGuest(Request $request): Guest
    {
        $validated = $this->validateGuestData($request);

        $validated['country'] = $this->getCountryByPhone($validated['phone']);

        return Guest::create($validated);
    }

    /**
     * Валидация данных гостя
     *
     * @param Request $request
     * @return array
     */
    private function validateGuestData(Request $request): array
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:guests',
            'phone'      => 'required|string|unique:guests',
        ]);
    }

    /**
     * Определение страны по номеру телефона
     *
     * @param string $phone
     * @return string|null
     */
    private function getCountryByPhone(string $phone): ?string
    {
        if (strpos($phone, '+7') === 0) {
            return 'Russia';
        }
        // Добавьте другие правила для определения страны по номеру телефона
        return null;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validate(Request $request): array
    {

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:guests,email,' . $request->route('guest')->id,
            'phone'      => 'required|string|unique:guests,phone,' . $request->route('guest')->id,
        ];

        return $request->validate($rules);
    }
}
