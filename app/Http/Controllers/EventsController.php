<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organization;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventsController extends Controller
{
    /**
     * Show the list of events for a given organization.
     */
    public function index(Organization $organization): Response
    {
        $events = $organization->events()->with(['attendees', 'organization'])->get();

        return Inertia::render('events/Index', [
            'events' => $events,
            'organization' => $organization,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Organization $organization)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Organization $organization)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'max_attendees' => 'required|integer|min:1',
        ]);

        $event = new Event($request->all());
        $event->organization()->associate($organization);
        $event->save();

        return redirect()->route('organization.events.index', $organization)
                         ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Organization $organization, Event $event)
    {
        $events = $organization->events()->with(['attendees', 'organization'])->get();

        return Inertia::render('events/Show', [
            'attendees' => $event->attendees,
            'event' => $event,
            'events' => $events,
            'organization' => $organization,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization, Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization, Event $event)
    {
        //
    }
}
