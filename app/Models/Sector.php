<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


/**
 * App\Models\Sector
 *
 * @property int $id
 * @property int|null $exchange_traded_fund_id
 * @property mixed $data
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read ExchangeTradedFund|null $exchangeTradedFund
 * @method static Builder|Sector newModelQuery()
 * @method static Builder|Sector newQuery()
 * @method static Builder|Sector query()
 * @method static Builder|Sector whereCreatedAt($value)
 * @method static Builder|Sector whereData($value)
 * @method static Builder|Sector whereExchangeTradedFundId($value)
 * @method static Builder|Sector whereId($value)
 * @method static Builder|Sector whereType($value)
 * @method static Builder|Sector whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Sector extends BaseModel
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
     * @return Sector
     */
    public function setId(int $id): Sector
    {
        $this->id = $id;
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
     * @return Sector
     */
    public function setType(string $type): Sector
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Sector
     */
    public function setData(array $data): Sector
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
