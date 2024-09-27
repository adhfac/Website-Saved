<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index')
            ->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        $kota = Kota::all();
        return view('mahasiswa.create')
            ->with('prodi', $prodi)
            ->with('kota', $kota);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->cannot('create', Fakultas::class)) {
            abort(403, 'Anda tidak memiliki akses');
        }
        // dd($request);
        // validasi data input
        $val = $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'kota_id' => 'required',
            'prodi_id' => 'required',
            'url_foto' => 'required|file|mimes:png,jpg|max:5000'
        ]);

        // ambil ext file
        $ext = $request->url_foto->getClientOriginalExtension(); // png / jpg
        // rename file, misalnya : 2327250015.png
        $val['url_foto'] = $request->npm . "." . $ext;
        //upload file bisa pakai move(), storeAs()
        $request->url_foto->move('foto', $val['url_foto']);
        // foto : folder tujuan public/foto

        // simpan ke dalam tabel mahasiswas
        Mahasiswa::create($val);
        // redirect ke route prodi
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'] . ' berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //dd($mahasiswa);
        return view('mahasiswa.show')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        $prodi = Prodi::all();
        $kota = Kota::all();
        return view('mahasiswa.edit')
            ->with('prodi', $prodi)
            ->with('kota', $kota)
            ->with('mahasiswa', $mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        if($request->hasFile('url_foto')) {
            // hapus file foto lama
            File::delete('foto/' . $mahasiswa['url_foto']);
            // validasi data input
            $val = $request->validate([
                'npm' => 'required',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'kota_id' => 'required',
                'prodi_id' => 'required',
                'url_foto' => 'required|file|mimes:png,jpg|max:5000'
            ]);

            // ambil ext file
            $ext = $request->url_foto->getClientOriginalExtension(); // png / jpg
            // rename file, misalnya : 2327250015.png
            $val['url_foto'] = $request->npm . "." . $ext;
            //upload file bisa pakai move(), storeAs()
            $request->url_foto->move('foto', $val['url_foto']);
            // foto : folder tujuan public/foto
        } else {
            // validasi data input tanpa foto
            $val = $request->validate([
                'npm' => 'required',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'alamat' => 'required',
                'kota_id' => 'required',
                'prodi_id' => 'required'
            ]);
        }

        // ubah data mahasiswas
        // Mahasiswa::create($val);
        $mahasiswa->update($val);
        // redirect ke route prodi
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'] . ' berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        File::delete('foto/' . $mahasiswa['url_foto']); // file dihapus
        $mahasiswa->delete(); // data mahasiswa dihapus
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
    }
}
