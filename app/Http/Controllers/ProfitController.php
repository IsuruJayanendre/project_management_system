<?php

namespace App\Http\Controllers;

use App\Models\profit;
use App\Models\Project;
use Illuminate\Http\Request;

class ProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profit.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(profit $profit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(profit $profit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, profit $profit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(profit $profit)
    {
        //
    }
}
