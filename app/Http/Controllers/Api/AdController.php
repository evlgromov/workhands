<?php

namespace App\Http\Controllers\Api;

use App\Ad;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\AdRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class AdController extends Controller
{
    public function getAll () {
        return response()->json([
            'ads' => Ad::with('mainPhoto')->latest()->paginate(10)
        ], 200);
    }

    public function getAdById ($id, Request $request) {
        $ad = Ad::with('mainPhoto')->where('id', $id)->first()->only('title', 'price', 'mainPhoto');

        if (!$ad) return response()->json(
            ['data' => [
                'errors' => [
                    'id' => 'Запись не найдена'
                ]
            ]], 404
        );

        return response()->json([
            'ad' => $ad,

        ], 200);
    }

    public function createAd(AdRequest $request)
    {
        try {

            $ad = Ad::create($request->validated());

            foreach ($request->photos as $photo) {
                $ad->photos()->create([
                    'ad_id' => $ad->id,
                    'link' => $photo['link']
                ]);
            }

            
            return response()->json(
                ['data' => [
                    'message' => 'Запись успешно создана',
                    'id' => $ad->id
                ]], 201
            );
        } catch(\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'error' => true
            ], 500);
        }
    }
}
