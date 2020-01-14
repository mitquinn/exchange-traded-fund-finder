<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiController
 * @package App\Http\Controllers\Api
 */
class ApiController extends Controller
{

    /**
     * @param $status
     * @param $body
     * @param $httpCode
     * @param null $meta
     * @return JsonResponse
     */
    private function send($status, $body, $httpCode, $meta = null): JsonResponse
    {
        $response = [
            'status' => $status,
            'data' =>  $body
        ];

        //If we include a meta than we will attach it.
        if(!is_null($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response)->setStatusCode($httpCode);
    }

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function success($body)
    {
        return $this->send('success', $body, 200);
    }

    /**
     * @param Paginator $paginator
     * @return JsonResponse
     */
    protected function paginate(Paginator $paginator)
    {
        $meta = [
            'current_page' => $paginator->currentPage(),
            'first_page_url' => $paginator->url(1),
            'from' => $paginator->firstItem(),
            'next_page_url' => $paginator->nextPageUrl(),
            'path' => request()->url(),
            'per_page' => $paginator->perPage(),
            'prev_page_url' => $paginator->previousPageUrl(),
            'to' => $paginator->lastItem(),
        ];

        return $this->send('success', $paginator->items(), 200, $meta);

    }

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function created($body)
    {
        return $this->send('created', $body, 201);
    }

    /**
     * @param $body
     * @return JsonResponse
     */
    protected function badRequest($body)
    {
        return $this->send('bad_request', $body, 400);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function unauthorized($body = null)
    {
        if(is_null($body)) {
            $body = "You are unauthorized to make this request.";
        }
        return $this->send('unauthorized', $body, 401);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function forbidden($body = null)
    {
        if(is_null($body)) {
            $body = "Forbidden";
        }
        return $this->send('forbidden', $body, 403);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function notFound($body = null)
    {
        if(is_null($body)) {
            $body = "Unable to find requested content.";
        }
        return $this->send('not_found', $body, 404);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function error($body = null)
    {
        if(is_null($body)) {
            $body = "There was an internal server error.";
        }
        return $this->send('internal_server_error', $body, 500);
    }

    /**
     * @param null $body
     * @return JsonResponse
     */
    protected function accepted($body = null) {
        if(is_null($body)) {
            $body = "The request has been accepted and will processed shortly.";
        }
        return $this->send('accepted', $body, 202);
    }

}
