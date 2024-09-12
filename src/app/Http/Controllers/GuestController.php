<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Services\GuestService;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    protected GuestService $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $startTime = microtime(true);

        $perPage = $request->query('per_page', 10);

        $guests = Guest::paginate($perPage);

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $memoryUsage = round(memory_get_usage(true) / 1024, 2);

        return response()->json($guests, 200)
            ->header('X-Debug-Time', $executionTime)
            ->header('X-Debug-Memory', $memoryUsage);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $startTime = microtime(true);

        $guest = $this->guestService->createGuest($request);

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $memoryUsage = round(memory_get_usage(true) / 1024, 2);

        return response()->json($guest, 201)
            ->header('X-Debug-Time', $executionTime)
            ->header('X-Debug-Memory', $memoryUsage);
    }

    /**
     * @param Guest $guest
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Guest $guest): \Illuminate\Http\JsonResponse
    {
        $startTime = microtime(true);

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $memoryUsage = round(memory_get_usage(true) / 1024, 2);

        return response()->json($guest, 200)
            ->header('X-Debug-Time', $executionTime)
            ->header('X-Debug-Memory', $memoryUsage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $startTime = microtime(true);

        $validatedData = app(GuestService::class)->validate($request);

        $guest->update($validatedData);

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $memoryUsage = round(memory_get_usage(true) / 1024, 2);

        return response()->json($guest, 200)
            ->header('X-Debug-Time', $executionTime)
            ->header('X-Debug-Memory', $memoryUsage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $startTime = microtime(true);

        $guest->delete();

        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        $memoryUsage = round(memory_get_usage(true) / 1024, 2);

        return response()->json(['message' => 'Guest deleted successfully'], 200)
            ->header('X-Debug-Time', $executionTime)
            ->header('X-Debug-Memory', $memoryUsage);
    }
}
