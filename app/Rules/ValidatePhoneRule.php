<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidatePhoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        preg_match('/^[\+]380(39|50|6[3|6-8]|9[1-9])[0-9]{7}$/', $value, $matches);

        if(count($matches) == 0) {
            $fail('Вкажіть номер телефону в форматі +380ХХХХХХХХХ');
        }
    }
}
