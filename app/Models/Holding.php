<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder as BuilderAlias;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


/**
 * App\Models\Holding
 *
 * @property int $id
 * @property int|null $exchange_traded_fund_id
 * @property mixed $data
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ExchangeTradedFund|null $exchangeTradedFund
 * @method static BuilderAlias|Holding newModelQuery()
 * @method static BuilderAlias|Holding newQuery()
 * @method static BuilderAlias|Holding query()
 * @method static BuilderAlias|Holding whereCreatedAt($value)
 * @method static BuilderAlias|Holding whereData($value)
 * @method static BuilderAlias|Holding whereExchangeTradedFundId($value)
 * @method static BuilderAlias|Holding whereId($value)
 * @method static BuilderAlias|Holding whereUpdatedAt($value)
 * @method static BuilderAlias|Holding whereType($value)
 * @mixin Eloquent
 */
class Holding extends BaseModel
{

    /*** Relationships ***/

    /**
     * @return BelongsTo
     */
    public function exchangeTradedFund()
    {
        return $this->belongsTo(ExchangeTradedFund::class);
    }

    /*** Getters and Setters ***/

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Holding
     */
    public function setData(array $data): Holding
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Holding
     */
    public function setType(string $type): Holding
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getDataAttribute($value)
    {
        return json_decode($value, true);
    }

    /**
     * @param $value
     */
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = json_encode($value);
    }

}
