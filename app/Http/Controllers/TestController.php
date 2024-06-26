<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Notice;
use App\Models\Staff;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Order;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

class TestController extends Controller
{
    public function testFunc(Request $request)
    {
        $subscription = Ticket::with('customer')->get();

        return $subscription;
    }
}
