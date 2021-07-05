<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use App\Models\Memberships;
use App\Models\MembersSubscribers;
use App\Models\Messages;
use App\Models\Packages;
use App\Models\Ratings;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function index()
    {
        $usersCount = User::count();
        $packagesCount = Packages::count();
        $messagesCount = Messages::count();
        $messages = Messages::latest()->take(5)->get();
        $ratings = Ratings::latest()->take(5)->get();

        $chart = Packages::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');


        return view('dashboard.index',compact('usersCount','packagesCount','messagesCount','ratings','messages','chart'));
    }
}
