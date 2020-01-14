<?php


namespace App\Services\ExchangeTradedFundRetrieval\Interfaces;


use App\Models\ExchangeTradedFund;
use App\Services\ExchangeTradedFundRetrieval\SimpleFund;
use App\Services\ExchangeTradedFundRetrieval\SimpleFundCollection;

/**
 * Interface ExchangeTradedFundRetrievalInterface
 * @package App\Services\ExchangeTradedFundRetrieval\Interfaces
 */
interface ExchangeTradedFundRetrievalInterface
{
    /**
     * @return SimpleFundCollection
     */
    public function fundList(): SimpleFundCollection;

    /**
     * @param SimpleFund $simpleFund
     * @return ExchangeTradedFund
     */
    public function fundDetails(SimpleFund $simpleFund): ExchangeTradedFund;

}
