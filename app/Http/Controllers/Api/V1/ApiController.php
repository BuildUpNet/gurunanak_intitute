<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/** Shared list filters for the read-only form-submission APIs. */
abstract class ApiController extends Controller
{
    protected const DEFAULT_PER_PAGE = 20;
    protected const MAX_PER_PAGE     = 100;

    /** ?search= (across the given columns), ?from=YYYY-MM-DD, ?to=YYYY-MM-DD, newest first */
    protected function applyCommonFilters(Builder $query, Request $request, array $searchColumns): Builder
    {
        $request->validate([
            'search'   => 'nullable|string|max:100',
            'from'     => 'nullable|date_format:Y-m-d',
            'to'       => 'nullable|date_format:Y-m-d',
            'per_page' => 'nullable|integer|min:1|max:' . self::MAX_PER_PAGE,
            'page'     => 'nullable|integer|min:1',
        ]);

        return $query
            ->when($request->filled('search'), function ($q) use ($request, $searchColumns) {
                $q->where(function ($q2) use ($request, $searchColumns) {
                    foreach ($searchColumns as $column) {
                        $q2->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                });
            })
            ->when($request->filled('from'), fn($q) => $q->whereDate('created_at', '>=', $request->from))
            ->when($request->filled('to'), fn($q) => $q->whereDate('created_at', '<=', $request->to))
            ->latest()
            ->orderByDesc('id');
    }

    protected function perPage(Request $request): int
    {
        return (int) $request->input('per_page', self::DEFAULT_PER_PAGE);
    }
}
