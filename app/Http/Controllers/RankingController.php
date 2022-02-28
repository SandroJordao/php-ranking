<?php

namespace App\Http\Controllers;

use App\Services\RankingServices;
use Symfony\Component\HttpFoundation\Response;

class RankingController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RankingServices $service)
    {
        $this->service = $service;
    }

    public function getAll($movement_id){
        try {
            return response()->json(
                $this->service->getAll($movement_id),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
