<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 26.06.2019
 * Time: 10:50
 */

namespace App\Http\Controllers;

use App\Http\Requests\Game\SearchRequest;
use App\Serivces\Export\ExportService;

/**
 * Class ExportController
 * @package App\Http\Controllers
 */
class ExportController extends Controller
{
    /**
     * @var ExportService
     */
    private $exportService;

    /**
     * ExportController constructor.
     * @param ExportService $exportService
     */
    public function __construct(ExportService $exportService)
    {
        $this->exportService = $exportService;
    }

    /**
     * @param SearchRequest $request
     * @return void
     * @throws \League\Csv\CannotInsertRecord
     */
    public function exportToCsv(SearchRequest $request): void
    {
        $this->exportService->getGamesDataAsCsv($request->validated());
    }
}