<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DataController extends Controller
{
    public function processData()
    {
        // Path to data file 
        $filePath = storage_path('../../../data/test_data.txt');

        $fileContents = file_get_contents($filePath);

        // Split the file contents into individual lines
        $lines = explode("\n", $fileContents);

        $parsedData = [];

        // Loop through each line and process the data
        foreach ($lines as $line) {
            // Split the line into columns using the tab delimiter
            $columns = explode("\t", $line);

            $id = $columns[0];
            $geneIds = $columns[1];
            $value = $columns[2];
            $SRA = $columns[3];
            $abbreviation = $columns[4];
            $experiment = $columns[5];
            $disease = $columns[6];

            // Store the data in an associative array
            $parsedData[] = [
                'id' => $id,
                'gene_ids' => $geneIds,
                'value' => $value,
                'SRA' => $SRA,
                'abbreviation' => $abbreviation,
                'experiment' => $experiment,
                'disease' => $disease,
            ];
        }

        return view('data', compact('parsedData'));
    }

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
        // if (!$request->gene_ids) {
        //     $data = Data::where('disease', $request->disease)->where('experiment', $request->expriment)->where('sra', $request->sra)->limit(100)->get();
        // } else {
        //     $data = Data::whereIn('gene_ids', explode(',', $request->gene_ids))->where('disease', $request->disease)->where('experiment', $request->expriment)->where('sra', $request->sra)->limit(100)->get();
        // }
        // return $data;

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
        } else {
            $subquery = Data::query()->select('experiment')->groupBy('experiment');
            $query->whereIn('experiment', $subquery);
        }

        if ($request->sra) {
            $query->where('sra', $request->sra);
        } else {
            $subquery = Data::query()->select('sra')->groupBy('sra');
            $query->whereIn('sra', $subquery);
        }

        $data = $query->limit(100)->get();

        return $data;
    }
}
