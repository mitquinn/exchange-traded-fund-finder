<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Models\ExchangeTradedFund;
use App\Models\Holding;
use App\Services\ExchangeTradedFundRetrieval\Providers\Ssga;
use App\Services\ExchangeTradedFundRetrieval\SimpleFund;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Psr\SimpleCache\InvalidArgumentException;
use function foo\func;

/**
 * Class SsgaController
 * @package App\Http\Controllers\Api\V1
 */
class SsgaController extends ApiController
{
    /** @var Ssga $ssga */
    protected $ssga;

    public function __construct()
    {
        $this->setSsga(new Ssga());
    }

    /**
     * This obviously needs some pagination but I am trying to keep it simple.
     * @return JsonResponse
     * @throws InvalidArgumentException
     */
    public function available()
    {
        try {
            $availableFunds = $this->getSsga()->fundList()->toArray();
            return $this->success($availableFunds);
        } catch (Exception $exception) {
            return $this->error();
        }
    }


    public function detail(string $ticker)
    {
        try {
            $simpleFund = $this->getSsga()->fundList()->getSimpleFunds()->first(function (SimpleFund $simpleFund) use ($ticker) {
                return $simpleFund->getIdentifier() == $ticker;
            });

            if (is_null($simpleFund)) {
                return $this->notFound('Ssga - Fund with that ticker was not found.');
            }

            $exchangeTradedFund = ExchangeTradedFund::whereTicker($ticker)->firstOrFail();
            $exchangeTradedFund->load('holdings', 'geographicalBreakdowns', 'sectors');
            return $exchangeTradedFund;

        } catch (ModelNotFoundException $modelNotFoundException) {
            $exchangeTradedFund = $this->getSsga()->fundDetails($simpleFund);
            $exchangeTradedFund->load('holdings', 'geographicalBreakdowns', 'sectors');
            return $this->success($exchangeTradedFund);

        } catch (Exception $exception) {
            return $this->error($exception->getMessage());
        }

    }


    /*** Getters and Setters ***/

    /**
     * @return Ssga
     */
    private function getSsga(): Ssga
    {
        return $this->ssga;
    }

    /**
     * @param Ssga $ssga
     * @return SsgaController
     */
    private function setSsga(Ssga $ssga): SsgaController
    {
        $this->ssga = $ssga;
        return $this;
    }


}
