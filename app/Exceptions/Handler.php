<?php

namespace Vain\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return Response
     */
    public function render($request, Exception $e)
    {
        //        if ($request->isXmlHttpRequest())
//            return $this->renderXmlHttpException($e);

        if (config('app.debug')) {
            if ($request->isXmlHttpRequest()) {
                return $this->renderDebugXmlHttpException($e);
            }

            return $this->renderExceptionWithWhoops($e);
        }

        return parent::render($request, $e);
    }

    /**
     * Render an exception using Whoops.
     *
     * @param \Exception $e
     *
     * @return Response
     */
    protected function renderExceptionWithWhoops(Exception $e)
    {
        $whoops = new Whoops();
        $whoops->pushHandler(new PrettyPageHandler());

        return new Response(
            $whoops->handleException($e),
            $e->getStatusCode(),
            $e->getHeaders()
        );
    }

    /**
     * Renders an exception from ajax requests.
     *
     * @param \Exception $e
     *
     * @return JsonResponse
     */
    protected function renderXmlHttpException($e)
    {
        // handle our ajax errors
        $data = [
            'message' => $e->getMessage(),
        ];

        if ($e instanceof HttpException) {
            return new JsonResponse($data, $e->getStatusCode());
        }

        return new JsonResponse($data, 500);
    }

    /**
     * Renders an exception from ajax requests
     * Only use this in debug mode.
     *
     * @param \Exception $e
     *
     * @return JsonResponse
     */
    protected function renderDebugXmlHttpException($e)
    {
        // handle our ajax errors
        $data = [
            'message' => $e->getMessage(),
            'trace'   => $e->getTrace(),
        ];

        if ($e instanceof HttpException) {
            return new JsonResponse($data, $e->getStatusCode());
        }

        return new JsonResponse($data, 500);
    }
}
