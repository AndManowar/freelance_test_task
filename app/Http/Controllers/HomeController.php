<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\SearchRequest;
use App\Serivces\Game\GameService;
use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @var GameService
     */
    private $gameService;

    /**
     * Create a new controller instance.
     *
     * @param GameService $gameService
     */
    public function __construct(GameService $gameService)
    {
        $this->middleware('auth');
        $this->gameService = $gameService;
    }

    /**
     * Show the application dashboard.
     *
     * @param SearchRequest $request
     * @return View
     */
    public function index(SearchRequest $request): View
    {
        return view('home', [
            'games' => $this->gameService->getGames($request->validated())
        ]);
    }
}
