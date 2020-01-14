<?php

namespace App\Models;

use Laravel\Spark\Team as SparkTeam;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property int $owner_id
 * @property string $name
 * @property string|null $slug
 * @property string|null $photo_url
 * @property string|null $stripe_id
 * @property string|null $current_billing_plan
 * @property string|null $card_brand
 * @property string|null $card_last_four
 * @property string|null $card_country
 * @property string|null $billing_address
 * @property string|null $billing_address_line_2
 * @property string|null $billing_city
 * @property string|null $billing_state
 * @property string|null $billing_zip
 * @property string|null $billing_country
 * @property string|null $vat_id
 * @property string|null $extra_billing_information
 * @property \Illuminate\Support\Carbon|null $trial_ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $email
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Invitation[] $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read int|null $local_invoices_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\TeamSubscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereBillingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereBillingAddressLine2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereBillingCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereBillingCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereBillingState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereBillingZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCardBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCardCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCardLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereCurrentBillingPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereExtraBillingInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team wherePhotoUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Team whereVatId($value)
 * @mixin \Eloquent
 */
class Team extends SparkTeam
{
    //
}
