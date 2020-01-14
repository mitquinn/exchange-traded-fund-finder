<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Models\ExchangeTradedFund;
use App\Services\ExchangeTradedFundRetrieval\Providers\Ssga;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psr\SimpleCache\InvalidArgumentException;

class ExchangeTradedFundController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $exchangeTradedFunds = ExchangeTradedFund::simplePaginate();
        return $this->paginate($exchangeTradedFunds);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $exchangeTradedFund = ExchangeTradedFund::findOrFail($id);
        } catch (ModelNotFoundException $modelNotFoundException) {
            return $this->notFound();
        } catch (Exception $exception) {
            return $this->error();
        }

        return $this->success($exchangeTradedFund);
    }


    /**
     * @param $ticker
     * @return JsonResponse
     */
    public function ticker($ticker)
    {
        $exchangeTradedFund = ExchangeTradedFund::whereTicker($ticker);
        return $this->success($exchangeTradedFund);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
