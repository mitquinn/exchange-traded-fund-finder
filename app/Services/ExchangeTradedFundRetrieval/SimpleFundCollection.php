<?php


namespace App\Services\ExchangeTradedFundRetrieval;


use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class SimpleFundCollection
 * @package App\Services\ExchangeTradedFundRetrieval
 */
class SimpleFundCollection implements Arrayable
{
    /** @var SimpleFund[] $simpleFunds */
    protected $simpleFunds;

    /**
     * SimpleFundCollection constructor.
     */
    public function __construct()
    {
        $this->simpleFunds = new Collection();
    }

    /**
     * @param SimpleFund $simpleFund
     * @return $this
     */
    public function addSimpleFund(SimpleFund $simpleFund)
    {
        $this->simpleFunds->add($simpleFund);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getSimpleFunds(): Collection
    {
        return $this->simpleFunds;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $simpleFundArray = [];
        /** @var SimpleFund $simpleFund */
        foreach ($this->getSimpleFunds() as $simpleFund) {
            $simpleFundArray[] = $simpleFund->toArray();
        }
        return $simpleFundArray;
    }
}
