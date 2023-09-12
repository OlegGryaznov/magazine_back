<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class VerifyOldPasswordRule implements ValidationRule
{
    protected $newPassword;

    public function __construct($password)
    {
        $this->newPassword = $password;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $user = request()->user();

        if(!empty($this->newPassword) && Hash::check($this->newPassword, $user->password)) {
            $fail('Ви вже використовували цей пароль!');
        }

        if (!empty($this->newPassword) && !Hash::check($value, $user->password)) {
            $fail('Старый пароль введен не верно');
        }
    }
}
