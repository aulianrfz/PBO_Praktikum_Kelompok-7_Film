<?php

namespace App\Exceptions;

use Exception;

class tiketException extends Exception
{
    /**
     * Report or log the exception.
     *
     * @return void
     */
    public function report()
    {
        // You can log the exception if needed.
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->view('errors.500', ['error' => $this->getMessage()], 500);
    }
}