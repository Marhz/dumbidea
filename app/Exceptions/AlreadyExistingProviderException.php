<?php

namespace App\Exceptions;

use Exception;

class AlreadyExistingProviderException extends Exception
{
    public function render()
    {
        return redirect('/login')->with('flash', [
            'message' => 'You are already signed up with another platform',
            'level' => 'warning'
        ]);
    }
}
