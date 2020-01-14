<?php


namespace App\Services\ExchangeTradedFundRetrieval;

use Illuminate\Contracts\Support\Arrayable;

/**
 * Class SimpleFund
 * @package App\Services\ExchangeTradedFundRetrieval
 */
class SimpleFund implements Arrayable
{

    /** @var string $identifier */
    protected $identifier;

    /** @var string $name */
    protected $name;

    /** @var string $detailUrl */
    protected $detailUrl;

    /**
     * ListFund constructor.
     * @param string $identifier
     * @param string $name
     * @param string $detailUrl
     */
    public function __construct(string $identifier, string $name, string $detailUrl)
    {
        $this->setIdentifier($identifier);
        $this->setName($name);
        $this->setDetailUrl($detailUrl);
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'identifier' => $this->getIdentifier(),
            'name' => $this->getName(),
            'detail_url' => $this->getDetailUrl()
        ];
    }

    /** Getters and Setters ***/

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     * @return SimpleFund
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return SimpleFund
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDetailUrl()
    {
        return $this->detailUrl;
    }

    /**
     * @param mixed $detailUrl
     * @return SimpleFund
     */
    public function setDetailUrl($detailUrl)
    {
        $this->detailUrl = $detailUrl;
        return $this;
    }

}
