<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class EntityTypeStatsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('entity_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizations = Organization::withCount(['sellers' => function($query) {
            $query->whereHas('user', function($q) {
                $q->where('user_type', 'seller');
            });
        }])->get();
        
        $stats = [
            'total_individuals' => Seller::whereNull('organization_id')->count(),
            'total_organizations' => Organization::count(),
            'total_affiliated' => Seller::whereNotNull('organization_id')->count(),
            'total_sellers' => User::where('user_type', 'seller')->count(),
            'total_customers' => User::where('user_type', 'customer')->count(),
        ];

        return view('admin.entity-type-stats.index', compact('organizations', 'stats'));
    }
}