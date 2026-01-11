<?php

namespace App\Http\Controllers;

use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'vehicle_make' => ['nullable', 'string', 'max:100'],
            'vehicle_model' => ['nullable', 'string', 'max:100'],
            'vehicle_year' => ['nullable', 'string', 'max:20'],
            'engine' => ['nullable', 'string', 'max:100'],
            'part_name' => ['required', 'string', 'max:255'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:999'],
            'notes' => ['nullable', 'string', 'max:5000'],
            'preferred_contact' => ['nullable', 'in:facebook,phone,email'],
        ]);

        QuoteRequest::query()->create([
            ...$data,
            'quantity' => $data['quantity'] ?? 1,
            'preferred_contact' => $data['preferred_contact'] ?? 'facebook',
            'status' => 'new',
            'source' => 'website',
        ]);

        return redirect()
            ->to('/contact')
            ->with('success', 'Thanks! Your request was sent. We will respond soon.');
    }
}

