<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(View $view)
    {
        $user = Auth::user();
        $views = View::select('id','created_at')->get()
        ->groupBy(function ($views){
           return Carbon::parse($views->created_at)->format('M');
        });
        $months = [];
        $monthCount = [];
        foreach($views as $month => $values){
            $months[] = $month;
            $monthCount[] = count($values);
        }

        

        return view('admin.visited.index', compact('views','user','months','monthCount'));
        
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
    public function store(StoreViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}
