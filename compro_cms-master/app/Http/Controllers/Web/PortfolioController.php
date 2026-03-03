<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Portfolio Categories                                
        $data['portfolio_categories'] = PortfolioCategory::where('status', '1')
                            ->orderBy('id', 'asc')
                            ->get();

        // Portfolios                                
        $data['portfolios'] = Portfolio::where('status', '1')
                            ->orderBy('id', 'desc')
                            ->get();

        return view('web.portfolios', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // Portfolio
        $data['portfolio'] = Portfolio::with('categories')
                        ->where('slug', $slug)
                        ->where('status', '1')
                        ->firstOrFail();

        // Related Portfolios (same category, exclude current)
        $categoryIds = $data['portfolio']->categories->pluck('id');
        if ($categoryIds->isNotEmpty()) {
            $data['related_portfolios'] = Portfolio::with('categories')
                ->where('status', '1')
                ->where('slug', '!=', $slug)
                ->whereHas('categories', function($q) use ($categoryIds) {
                    $q->whereIn('portfolio_categories.id', $categoryIds);
                })
                ->orderBy('id', 'desc')
                ->limit(3)
                ->get();
        } else {
            $data['related_portfolios'] = Portfolio::where('status', '1')
                ->where('slug', '!=', $slug)
                ->orderBy('id', 'desc')
                ->limit(3)
                ->get();
        }

        return view('web.portfolio-single', $data);
    }
}
