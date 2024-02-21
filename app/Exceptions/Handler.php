<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render($request, Throwable $e)
    {
        if ($request->wantsJson() || $request->is('api/*')) {

            switch (get_class($e)) {
                case NotFoundHttpException::class:

                    return response()->json([
                        'message' => 'Record not found !!',
                    ], 404);

                case ModelNotFoundException::class:

                    return response()->json([
                        'message' => class_basename($e->getModel()).' Not found',
                    ], 404);

                default:

                    $statusCode = (int) $e->getCode();

                    if ($this->validStatusCode($statusCode)) {
                        return response()->json([
                            'message' => $e->getMessage(),
                        ], $e->getCode());
                    }
            }
        }

        return parent::render($request, $e);
    }

    protected function validStatusCode(int $statusCode): bool
    {
        return $statusCode > 100 && $statusCode <= 600;
    }
}
