<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DataController extends Controller
{

    public function getGeneids()
    {
        $data = Data::select('gene_ids')->limit(100)->get()->toArray();
        $data = array_map(function ($elem) {
            return $elem['gene_ids'];
        }, $data);
        return $data;
    }
    public function getExpriment()
    {
        $data = Data::select('experiment')->limit(100)->get()->toArray();
        $data = array_map(function ($elem) {
            return $elem['experiment'];
        }, $data);
        return $data;
    }
    public function getSra()
    {
        $data = Data::select('sra')->limit(100)->get()->toArray();
        $data = array_map(function ($elem) {
            return $elem['sra'];
        }, $data);
        return $data;
    }
    public function getDisease()
    {
        $data = Data::select('disease')->limit(100)->get()->toArray();
        $data = array_map(function ($elem) {
            return $elem['disease'];
        }, $data);
        return $data;
    }

    public function getChartData(Request $request)
    {

        $query = Data::query();

        if ($request->gene_ids) {
            $query->whereIn('gene_ids', explode(',', $request->gene_ids));
        }

        if ($request->disease) {
            $query->where('disease', $request->disease);
        }

        // If sra or expriment is null include all data in the query
        if ($request->experiment) {
            $query->where('experiment', $request->experiment);
        }

        if ($request->sra) {
            $query->where('sra', $request->sra);
        }

        $data = $query->limit(51)->get();
        return $data;
    }
}
