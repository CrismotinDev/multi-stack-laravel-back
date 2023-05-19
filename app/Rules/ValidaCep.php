<?php

namespace App\Rules;

use App\Services\ViaCep;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;

class ValidaCep implements Rule
{

    public function __construct(public ViaCep $viaCep)
    {
    }
    public function passes($attribute, $value)
    {
        $cep = str_replace('-', '', $value);

        return !!$this->viaCep->buscar($cep);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cep inválido';
    }
}
