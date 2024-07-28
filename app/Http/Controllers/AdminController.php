<?php

namespace App\Http\Controllers;

use App\Models\Subscription;

class AdminController
{
    public function index()
    {
        $subscriptions = Subscription::with('device')->get();
        return view('admin.purchases', compact('subscriptions'));
    }
}