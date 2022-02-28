<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class RankingServices
{
    public function __construct(){}

    public function getAll($movement_id)
    {
        $subjoin = DB::table('personal_record')
                   ->select('movement_id', 'user_id', DB::raw('MAX(value) AS value'))
                   ->groupBy('movement_id', 'user_id');

        $ranking = DB::table('personal_record')
            ->joinSub($subjoin, 'sub_personal_record', function ($join) {
                $join->on('sub_personal_record.movement_id', '=', 'personal_record.movement_id')
                    ->on('sub_personal_record.user_id', '=', 'personal_record.user_id')
                    ->on('sub_personal_record.value', '=', 'personal_record.value');
            })
            ->join('user', 'user.id', '=', 'personal_record.user_id')
            ->join('movement', 'movement.id', '=', 'personal_record.movement_id')
            ->select('movement.name AS movement_name', 'user.name AS user_name', 'personal_record.value', DB::raw('RANK() OVER (PARTITION BY movement.name ORDER BY personal_record.value DESC) AS user_rank'), 'personal_record.date')
            ->where('personal_record.movement_id', $movement_id)
            ->groupBy('movement.name', 'user.name', 'personal_record.value', 'personal_record.date')
            ->orderBy('personal_record.value', 'DESC')
            ->get();

        return $ranking;
    }
}
