<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::select('first_name', 'last_name', 'email', 'country')->get();
    }

    public function show(Customer $customer)
    {
        return $customer->only([
            'first_name', 'last_name', 'email', 'username',
            'gender', 'country', 'city', 'phone'
        ]);
    }
}
