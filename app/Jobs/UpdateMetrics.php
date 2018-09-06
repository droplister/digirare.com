<?php

namespace App\Jobs;

use App\Card;
use App\Metric;
use App\Collector;
use Carbon\Carbon;
use Droplister\XcpCore\App\Block;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateMetrics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Block
     *
     * @var \Droplister\XcpCore\App\Block
     */
    protected $block;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Cards w/ Tokens
        $cards = Card::has('token')->get();

        // Interval Period
        $intervals = $this->getIntervals();

        // End of Day Only
        if($this->isEndOfDay())
        {
            // Day, Month, Year
            foreach($intervals as $interval => $dates)
            {
                // Site Metrics
                $this->updateCards($interval, $dates);
                $this->updateCollectors($interval, $dates);

                // Card Metrics
                foreach($cards as $card)
                {
/*
                    $this->updateCredits($card, $interval, $dates);
                    $this->updateDebits($card, $interval, $dates);
                    $this->updateOrders($card, $interval, $dates);
                    $this->updateOrderMatches($card, $interval, $dates);
                    $this->updateSends($card, $interval, $dates);
*/
                    // Balances (edge-case)
                    if($interval === 'day')
                    {
                        $this->updateBalances($card, $interval, $dates);
                    }
                }
            }
        }
    }

    /**
     * Get Intervals

     * @return array
     */
    private function getIntervals()
    {
        // Block Time
        $bt = $this->block->confirmed_at;

        // Intervals
        $startOfDay = $bt->startOfDay()->toDateTimeString();
        $endOfDay = $bt->endOfDay()->toDateTimeString();
        $startOfMonth = $bt->startOfMonth()->toDateTimeString();
        $endOfMonth = $bt->endOfMonth()->toDateTimeString();
        $startOfYear = $bt->startOfYear()->toDateTimeString();
        $endOfYear = $bt->endOfYear()->toDateTimeString();

        return [
            'day' => [
                'start' => $startOfDay,
                'end' => $endOfDay,
            ],
            'month' => [
                'start' => $startOfMonth,
                'end' => $endOfMonth,
            ],
            'year' => [
                'start' => $startOfYear,
                'end' => $endOfYear,
            ],
        ];
    }

    /**
     * Update Balances
     *
     * @param  \App\Card  $card
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateBalances($card, $interval, $dates)
    {
        $count = $card->balances()->count();

        $this->updateMetric($card, 'balances', 'count', $count, $interval, $dates['start']);
    }

    /**
     * Update Cards
     *
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateCards($interval, $dates)
    {
        $count = Card::whereHas('token', function ($token) use ($dates) {
            return $token->whereBetween('confirmed_at', [$dates['start'], $dates['end']]);
        })->count();

        $this->updateSimpleMetric('cards', 'count', $count, $interval, $dates['start']);
    }

    /**
     * Update Collectors
     *
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateCollectors($interval, $dates)
    {
        $count = Collector::has('cardBalances')->count();

        $this->updateSimpleMetric('collectors', 'count', $count, $interval, $dates['start']);
    }

    /**
     * Update Credits
     * 
     * @param  \App\Card  $card
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateCredits($card, $interval, $dates)
    {
        $count = $card->token->credits()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $sum = $card->token->credits()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('quantity');

        $this->updateMetric($card, 'credits', 'count', $count, $interval, $dates['start']);
        $this->updateMetric($card, 'credits', 'sum', $sum, $interval, $dates['start']);
    }

    /**
     * Update Debits
     * 
     * @param  \App\Card  $card
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateDebits($card, $interval, $dates)
    {
        $count = $card->token->debits()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $sum = $card->token->debits()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('quantity');

        $this->updateMetric($card, 'debits', 'count', $count, $interval, $dates['start']);
        $this->updateMetric($card, 'debits', 'sum', $sum, $interval, $dates['start']);
    }

    /**
     * Update Orders
     * 
     * @param  \App\Card  $card
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateOrders($card, $interval, $dates)
    {
        $get_orders_count = $card->token->getOrders()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $get_orders_sum = $card->token->getOrders()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('get_quantity');

        $give_orders_count = $card->token->giveOrders()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $give_orders_sum = $card->token->giveOrders()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('give_quantity');

        $orders_count = $get_orders_count + $give_orders_count;
        $orders_sum = $get_orders_sum + $give_orders_sum;

        $this->updateMetric($card, 'get_orders', 'count', $get_orders_count, $interval, $dates['start']);
        $this->updateMetric($card, 'get_orders', 'sum', $get_orders_sum, $interval, $dates['start']);
        $this->updateMetric($card, 'give_orders', 'count', $give_orders_count, $interval, $dates['start']);
        $this->updateMetric($card, 'give_orders', 'sum', $give_orders_sum, $interval, $dates['start']);
        $this->updateMetric($card, 'orders', 'count', $orders_count, $interval, $dates['start']);
        $this->updateMetric($card, 'orders', 'sum', $orders_sum, $interval, $dates['start']);
    }

    /**
     * Update Order Matches
     * 
     * @param  \App\Card  $card
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateOrderMatches($card, $interval, $dates)
    {
        $backward_order_matches_count = $card->token->backwardOrderMatches()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $backward_order_matches_sum = $card->token->backwardOrderMatches()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('backward_quantity');

        $forward_order_matches_count = $card->token->forwardOrderMatches()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $forward_order_matches_sum = $card->token->forwardOrderMatches()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('forward_quantity');

        $order_matches_count = $backward_order_matches_count + $forward_order_matches_count;
        $order_matches_sum = $backward_order_matches_sum + $forward_order_matches_sum;

        $this->updateMetric($card, 'backward_order_matches', 'count', $backward_order_matches_count, $interval, $dates['start']);
        $this->updateMetric($card, 'backward_order_matches', 'sum', $backward_order_matches_sum, $interval, $dates['start']);
        $this->updateMetric($card, 'forward_order_matches', 'count', $forward_order_matches_count, $interval, $dates['start']);
        $this->updateMetric($card, 'forward_order_matches', 'sum', $forward_order_matches_sum, $interval, $dates['start']);
        $this->updateMetric($card, 'order_matches', 'count', $order_matches_count, $interval, $dates['start']);
        $this->updateMetric($card, 'order_matches', 'sum', $order_matches_sum, $interval, $dates['start']);
    }

    /**
     * Update Sends
     * 
     * @param  \App\Card  $card
     * @param  string  $interval
     * @param  array  $dates
     * @return void
     */
    private function updateSends($card, $interval, $dates)
    {
        $count = $card->token->sends()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->count();

        $sum = $card->token->sends()
            ->whereBetween('confirmed_at', [$dates['start'], $dates['end']])
            ->sum('quantity');

        $this->updateMetric($card, 'sends', 'count', $count, $interval, $dates['start']);
        $this->updateMetric($card, 'sends', 'sum', $sum, $interval, $dates['start']);
    }

    /**
     * Update Metric
     * 
     * @param  \App\Card  $card
     * @param  string  $category
     * @param  string  $type
     * @param  integer  $value
     * @param  string  $interval
     * @param  string  $timestamp
     * @return void
     */
    private function updateMetric($card, $category, $type, $value, $interval, $timestamp)
    {
        // Date
        $date = Carbon::parse($timestamp)->toDateString();

        // Save
        $card->metrics()->updateOrCreate([
            'date' => $date,
            'interval' => $interval,
            'category' => $category,
            'type' => $type,
        ],[
            'value' => $value,
            'timestamp' => $timestamp,
        ]);
    }

    /**
     * Update Simple Metric
     * 
     * @param  string  $category
     * @param  string  $type
     * @param  integer  $value
     * @param  string  $interval
     * @param  string  $timestamp
     * @return void
     */
    private function updateSimpleMetric($category, $type, $value, $interval, $timestamp)
    {
        // Date
        $date = Carbon::parse($timestamp)->toDateString();

        // Save
        Metric::updateOrCreate([
            'chartable_id' => null,
            'chartable_type' => null,
            'date' => $date,
            'interval' => $interval,
            'category' => $category,
            'type' => $type,
        ],[
            'value' => $value,
            'timestamp' => $timestamp,
        ]);
    }

    /**
     * Is End of Day
     * 
     * @return boolean
     */
    private function isEndOfDay()
    {
        // > 10:00pm
        return (int) $this->block->confirmed_at->format('H') >= 22;
    }
}