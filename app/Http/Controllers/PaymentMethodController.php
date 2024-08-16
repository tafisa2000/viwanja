<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return view('backend.payment_methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('backend.payment_methods.create');
    }

    public function store(Request $request)
    {
        PaymentMethod::create($request->all());
        return redirect()->route('payment_methods.index');
    }

    public function edit(PaymentMethod $paymentMethod)
    {

        return view('backend.payment_methods.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $paymentMethod->update($request->all());
        return redirect()->route('payment_methods.index');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('payment_methods.index');
    }
}
