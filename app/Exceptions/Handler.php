<?php
namespace App\Exceptions;
    use App\Helper\ResponseBuilder;
    use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
    use Throwable;
    use Illuminate\Database\Eloquent\ModelNotFoundException;

    class Handler extends ExceptionHandler
    {

        /**
         * A list of the exception types that are not reported.
         *
         * @var array
         */
        protected $dontReport = [
            //
        ];
        
        /**
         * The list of the inputs that are never flashed to the session on validation exceptions.
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
        public function register(): void
        {
            $this->reportable(function (Throwable $e) {
                //
            });
        }
        public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException && $request->expectsJson()) {
            return ResponseBuilder::json("The resource you are looking for not found", NULL, 404);
        }

        return parent::render($request, $exception);
    }
    }
