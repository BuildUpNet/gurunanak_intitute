<?php

namespace App\Support;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Paginator with clean URLs: page 1 = {path}, page N = {path}/page/N
 * (no "?page=" query string — SEO friendly).
 */
class PathPaginator extends LengthAwarePaginator
{
    public function url($page)
    {
        $page = max(1, (int) $page);
        $base = rtrim($this->path(), '/');

        return $page === 1 ? $base : $base . '/page/' . $page;
    }
}
