<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Donation;
use App\Models\Message;
use App\Models\FundApplication;
use App\Models\Consultation;
use App\Models\Blog;
use App\Models\Book;
use App\Models\ActivityLog;
use App\Http\Resources\ActivityLogResource;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'stats' => [
                // 1. Total Donations (Money)
                $this->getStat('Total Donations', Donation::class, true),

                // 2. Fund Applications (Count)
                $this->getStat('Fund Applications', FundApplication::class),

                // 3. Consultancy Requests (Count)
                $this->getStat('Consultancy Requests', Consultation::class),

                // 4. Media Posts (Count)
                $this->getStat('Media Posts', Blog::class),

                // 5. Books (Count)
                $this->getStat('Books in Library', Book::class),

                // 6. Contact Messages (Count)
                $this->getStat('Contact Messages', Message::class),
            ],
            // Recent Activity Feed (Latest 5 items)
            'recent_activities' => ActivityLogResource::collection(
                ActivityLog::latest()->take(5)->get()
            )
        ]);
    }

    /**
     * Helper Function: Calculates Totals & Growth vs Last Month
     */
    private function getStat($label, $modelClass, $isMoney = false)
    {
        // 1. Set Time Ranges
        $now = Carbon::now();
        $thisMonthStart = $now->copy()->startOfMonth();
        $thisMonthEnd   = $now->copy()->endOfMonth();

        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd   = $now->copy()->subMonth()->endOfMonth();

        // 2. Query Data
        // We use 'created_at' to track when the record entered the system.
        if ($isMoney) {
            // For Donation: Sum the 'amount' column
            $current  = $modelClass::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->sum('amount');
            $previous = $modelClass::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('amount');
            $total    = $modelClass::sum('amount');
        } else {
            // For Others: Count the IDs
            $current  = $modelClass::whereBetween('created_at', [$thisMonthStart, $thisMonthEnd])->count();
            $previous = $modelClass::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
            $total    = $modelClass::count();
        }

        // 3. Calculate Growth Percentage
        $growth = 0;
        if ($previous > 0) {
            $growth = (($current - $previous) / $previous) * 100;
        } elseif ($current > 0) {
            $growth = 100; // 100% growth (from 0 to something)
        }

        // 4. Format for Frontend
        return [
            'label'  => $label,
            'value'  => $isMoney ? '$' . number_format($total, 0) : number_format($total),
            'growth' => round($growth, 1), // e.g., 12.5
            'trend'  => $growth >= 0 ? 'up' : 'down', // e.g., 'up' (Green) or 'down' (Red)
            'period' => 'vs last month'
        ];
    }
}
