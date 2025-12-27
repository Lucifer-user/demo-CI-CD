<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class labController extends Controller
{
    public function index()
    {
        return view('lab_thuchanh.index');
    }

    public function show($lab_id, Request $request)
    {
        $subpath = $request->query('path', '');

        // Prevent directory traversal
        if (str_contains($subpath, '..')) {
            abort(403);
        }

        $basePath = 'labs/Lab' . $lab_id;
        $fullPathString = $basePath . ($subpath ? '/' . $subpath : '');
        $path = public_path($fullPathString);
        
        $files = [];

        if (is_dir($path)) {
            $items = array_diff(scandir($path), ['.', '..']);
            foreach ($items as $item) {
                $isDir = is_dir($path . '/' . $item);
                $files[] = [
                    'name' => $item,
                    'is_dir' => $isDir,
                    'path' => $subpath ? $subpath . '/' . $item : $item
                ];
            }
        }

        return view('lab_thuchanh.detail', compact('lab_id', 'files', 'subpath'));
    }
}
