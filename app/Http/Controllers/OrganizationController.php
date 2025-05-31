<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrganizationController extends Controller
{
    /**
     * Show the user's organizations.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Home', [
            'organizations' => $request->user()->organizations,
            'status' => $request->session()->get('status'),
        ]);
    }

    /**
     * Create a new organization.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:'.Organization::class,
        ]);

        $organization = Organization::create([
            'name' => $request->name
        ]);

        $request->user()->organizations()->attach($organization->id);

        return to_route('organization.events.index', $organization);
    }
}
