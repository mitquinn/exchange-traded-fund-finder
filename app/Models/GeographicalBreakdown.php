<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;



/**
 * App\Models\GeographicalBreakdown
 *
 * @property int $id
 * @property int|null $exchange_traded_fund_id
 * @property mixed $data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ExchangeTradedFund|null $exchangeTradedFund
 * @method static Builder|GeographicalBreakdown newModelQuery()
 * @method static Builder|GeographicalBreakdown newQuery()
 * @method static Builder|GeographicalBreakdown query()
 * @method static Builder|GeographicalBreakdown whereCreatedAt($value)
 * @method static Builder|GeographicalBreakdown whereData($value)
 * @method static Builder|GeographicalBreakdown whereExchangeTradedFundId($value)
 * @method static Builder|GeographicalBreakdown whereId($value)
 * @method static Builder|GeographicalBreakdown whereUpdatedAt($value)
 * @mixin Eloquent
 */
class GeographicalBreakdown extends BaseModel
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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GeographicalBreakdown
     */
    public function setId(int $id): GeographicalBreakdown
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return GeographicalBreakdown
     */
    public function setData(array $data): GeographicalBreakdown
    {
        $this->data = $data;
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
