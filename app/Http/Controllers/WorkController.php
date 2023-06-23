<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    public function mvp()
    {
        $employees = collect([
            [
                'name' => 'John',
                'email' => 'john3@example.com',
                'sales' => [
                    ['customer' => 'The Blue Rabbit Company', 'order_total' => 7444],
                    ['customer' => 'Black Melon', 'order_total' => 1445],
                    ['customer' => 'Foggy Toaster', 'order_total' => 700],
                ],
            ],
            [
                'name' => 'Jane',
                'email' => 'jane8@example.com',
                'sales' => [
                    ['customer' => 'The Grey Apple Company', 'order_total' => 203],
                    ['customer' => 'Yellow Cake', 'order_total' => 8730],
                    ['customer' => 'The Piping Bull Company', 'order_total' => 3337],
                    ['customer' => 'The Cloudy Dog Company', 'order_total' => 5310],
                ],
            ],
            [
                'name' => 'Dave',
                'email' => 'dave1@example.com',
                'sales' => [
                    ['customer' => 'The Acute Toaster Company', 'order_total' => 1091],
                    ['customer' => 'Green Mobile', 'order_total' => 2370],
                ],
            ],
        ]);

        $mostValuableSale = $employees
            ->flatMap(function ($employee) {
                return $employee['sales'];
            })
            ->pluck('order_total')
            ->max();

        $employeeWithMostValuableSale = $employees
            ->first(function ($employee) use ($mostValuableSale) {
                return collect($employee['sales'])
                    ->pluck('order_total')
                    ->contains($mostValuableSale);
            });

        echo $employeeWithMostValuableSale['name'];
    }

    function calculateSkippedRanks($rank, $teamCount)
    {
        return $rank + ($teamCount - 1);
    }
    public function ranks()
    {
        $scores = collect([
            ['score' => 76, 'team' => 'A'],
            ['score' => 62, 'team' => 'B'],
            ['score' => 82, 'team' => 'C'],
            ['score' => 86, 'team' => 'D'],
            ['score' => 91, 'team' => 'E'],
            ['score' => 67, 'team' => 'F'],
            ['score' => 67, 'team' => 'G'],
            ['score' => 82, 'team' => 'H'],
        ]);


        $ranks = $scores
        ->sortByDesc('score') // Sort scores in descending order
        ->values() // Reset array keys
        ->map(function ($item, $index) use ($scores) {
            $sameScoreTeams = $scores->where('score', $item['score']); // Get teams with the same score
            $rank = $sameScoreTeams->keys()->min() + 1; // Determine the minimum rank for teams with the same score
            $item['rank'] = $rank; // Assign rank to the item
            return $item;
        })->sortBy('rank');

        $ranks->each(function ($team) {
            echo "Team: {$team['team']}, Rank: {$team['rank']} <br>";
        });
    }

    public function orders()
    {
        $customer = Customer::with('payments')
            ->join('payments', 'customers.customerNumber', '=', 'payments.customerNumber')
            ->groupBy('customers.customerNumber')
            ->orderByDesc('sumAmount')
            ->select('customers.*', DB::raw('SUM(payments.amount) as sumAmount'))
            ->first();


        $customer_orders = Customer::withCount('orders')
            ->orderByDesc('orders_count')
            ->first();

        echo 'First customer who spent more money on orders. <br>';
        echo 'Customer Name: ' . $customer->customerName . '<br>';
        echo 'Amount: ' . $customer->sumAmount . '<br>---------------------------------------<br>';

        echo 'First customer who has highest number of orders. <br>';
        echo 'Customer Name: ' . $customer_orders->customerName . '<br>';
        echo 'Orders: ' . $customer_orders->orders_count;
    }
}
