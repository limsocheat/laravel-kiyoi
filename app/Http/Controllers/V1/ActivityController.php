<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::orderBy('id', 'desc');
        
        if($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('description', 'like', '%' . $request->search . '%')
                ->orWhere('properties->attributes->name', 'like', '%' . $request->search . '%')
                ->orWhere('properties->attributes->user_name', 'like', '%' . $request->search . '%');
            });
        }

        $activities = $query->paginate(100);

        return response()->json(['activities' => $activities]);
    }
}
