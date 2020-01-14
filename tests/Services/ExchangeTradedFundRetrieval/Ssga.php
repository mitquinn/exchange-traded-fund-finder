<?php


namespace Tests\Services\ExchangeTradedFundRetrieval;


use App\Models\ExchangeTradedFund;
use App\Services\ExchangeTradedFundRetrieval\Providers\Ssga;
use App\Services\ExchangeTradedFundRetrieval\SimpleFund;
use App\Services\ExchangeTradedFundRetrieval\SimpleFundCollection;
use Tests\TestCase;

class SsgaTest extends TestCase
{
    /** @var Ssga $ssga */
    protected Ssga $ssga;


    protected function setUp(): void
    {
        parent::setUp();
        $this->setSsga(new Ssga());
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function testFundList()
    {
        $simpleFundCollection = $this->getSsga()->fundList();
        static::assertInstanceOf(SimpleFundCollection::class, $simpleFundCollection);
        static::assertNotNull($simpleFundCollection->getSimpleFunds()->first());
        static::assertInstanceOf(SimpleFund::class, $simpleFundCollection->getSimpleFunds()->first());
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function testFundDetails()
    {
        $simpleFund = $this->getSsga()->fundList()->getSimpleFunds()->first();
        static::assertNotNull($simpleFund);
        static::assertInstanceOf(SimpleFund::class, $simpleFund);
        $exchangeTradedFund = $this->getSsga()->fundDetails($simpleFund);
        static::assertInstanceOf(ExchangeTradedFund::class, $exchangeTradedFund);
    }

    /*** Getter and Setters ***/

    /**
     * @return Ssga
     */
    public function getSsga(): Ssga
    {
        return $this->ssga;
    }

    /**
     * @param Ssga $ssga
     * @return SsgaTest
     */
    public function setSsga(Ssga $ssga): SsgaTest
    {
        static::assertInstanceOf(Ssga::class, $ssga);
        $this->ssga = $ssga;
        return $this;
    }

}
