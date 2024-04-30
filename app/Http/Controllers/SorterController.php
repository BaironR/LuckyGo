<?php

namespace App\Http\Controllers;

use App\Models\Sorter;
use Illuminate\Http\Request;

class SorterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar

        Sorter::create([
            'age' => $request->age,
            'lotteries_entered' => $request->lotteries_entered,
            'status' => $request->status
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Sorter $sorter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sorter $sorter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sorter $sorter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sorter $sorter)
    {
        //
    }
}
