<?php

namespace App\Models;


use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;



/**
 * App\Models\ExchangeTradedFund
 *
 * @property int $id
 * @property string $name
 * @property string $ticker
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|GeographicalBreakdown[] $geographicalBreakdowns
 * @property-read int|null $geographical_breakdowns_count
 * @property-read Collection|Holding[] $holdings
 * @property-read int|null $holdings_count
 * @property-read Collection|Sector[] $sectors
 * @property-read int|null $sectors_count
 * @method static Builder|ExchangeTradedFund newModelQuery()
 * @method static Builder|ExchangeTradedFund newQuery()
 * @method static Builder|ExchangeTradedFund query()
 * @method static Builder|ExchangeTradedFund whereCreatedAt($value)
 * @method static Builder|ExchangeTradedFund whereId($value)
 * @method static Builder|ExchangeTradedFund whereName($value)
 * @method static Builder|ExchangeTradedFund whereTicker($value)
 * @method static Builder|ExchangeTradedFund whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ExchangeTradedFund extends BaseModel
{
    /** @var array $fillable */
    protected $fillable = ['name', 'ticker'];

    /*** Relationships ***/

    /**
     * @return HasMany
     */
    public function geographicalBreakdowns()
    {
        return $this->hasMany(GeographicalBreakdown::class);
    }

    /**
     * @return HasMany
     */
    public function holdings()
    {
        return $this->hasMany(Holding::class);
    }

    /**
     * @return HasMany
     */
    public function sectors()
    {
        return $this->hasMany(Sector::class);
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
     * @return ExchangeTradedFund
     */
    public function setId(int $id): ExchangeTradedFund
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ExchangeTradedFund
     */
    public function setName(string $name): ExchangeTradedFund
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getTicker(): string
    {
        return $this->ticker;
    }

    /**
     * @param string $ticket
     * @return ExchangeTradedFund
     */
    public function setTicker(string $ticket): ExchangeTradedFund
    {
        $this->ticker = $ticket;
        return $this;
    }

}
