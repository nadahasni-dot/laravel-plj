<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'get mahasiswa list success',
            'data' => Mahasiswa::orderByDesc('created_at')->get(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:100',
            'nim' => 'required|min:6|max:10|unique:mahasiswa',
            'angkatan' => 'required|min:4|max:4',
            'jurusan' => 'required|min:6|max:100'
        ]);

        Mahasiswa::create($validatedData);
        return response()->json(
            [
                'success' => true,
                'message' => 'Create Mahasiswa Success',
            ],
            201
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return response()->json([
            'success' => true,
            'message' => 'User found',
            'data' => $mahasiswa,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'name' => 'required|min:3|max:100',
            'angkatan' => 'required|min:4|max:4',
            'jurusan' => 'required|min:6|max:100'
        ];

        if ($request->nim != $mahasiswa->nim) {
            $rules['nim'] = 'required|min:6|max:10|unique:mahasiswa';
        }

        $validatedData = $request->validate($rules);

        Mahasiswa::where('id', $mahasiswa->id)
            ->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Update mahasiswa success',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        Mahasiswa::destroy($mahasiswa->id);
        return response()->json([
            'success' => true,
            'message' => 'Mahasiswa Deleted Successfully',
        ], 200);
    }
}
