<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// use Symfony\Component\HttpFoundation\Session\Session;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if(strlen($katakunci)){
            $data = siswa::where('nis', 'like', "%$katakunci%")
                ->orWhere('nama', 'like', "%$katakunci%")
                ->orWhere('kelas', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = siswa::orderBy('nis', 'desc')->paginate($jumlahbaris);
        }
        return view('siswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('nis',$request->nis);
        Session::flash('nama',$request->nama);
        Session::flash('kelas',$request->kelas);
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'kelas' => 'required',
        ],[
            'nis.required' => 'NIS wajib diisi',
            'nis.numeric' => 'NIS wajib dalam angka',
            'nis.unique' => 'NIS yang diisikan sudah ada dalam database',
            'nama.required' => 'Nama wajib diisi',
            'kelas.required' => 'Kelas wajib diisi',
        ]);
        $data = [
            'nis'=>$request->nis,
            'nama'=>$request->nama,
            'kelas'=>$request->kelas,
        ];
        siswa::create($data);
        return redirect()->to('siswa')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = siswa::where('nis', $id)->first();
        return view('siswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);
        $data = [
            'nama'=>$request->nama,
            'kelas'=>$request->kelas,
        ];
        siswa::where('nis',$id)->update($data);
        return redirect()->to('siswa')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        siswa::where('nis',$id)->delete();
        return redirect()->to('siswa')->with('success', 'Berhasil melalukan delete data');
    }
}
