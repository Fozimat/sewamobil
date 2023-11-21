<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pinjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = Pinjam::with(['mobil', 'user'])->where('users_id', Auth::user()->id)->get();
        return view('pinjam.index', compact(['pinjam']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mobil = Mobil::where('status', 'ready')->get();
        return view('pinjam.create', compact(['mobil']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $pinjam = Pinjam::create(array_merge($request->all(), ['users_id' => Auth::user()->id, 'status_pinjam' => 'sedang dipinjam']));;
            if ($pinjam) {
                $mobil = Mobil::find($pinjam->mobil_id);
                if ($mobil) {
                    $mobil->update(['status' => 'not ready']);
                } else {
                    throw new \Exception('Mobil tidak ditemukan');
                }
            } else {
                throw new \Exception('Failed');
            }
            DB::commit();
            return redirect('pinjam')->with('message', 'Peminjaman berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('pinjam')->with('message', $e->getMessage());
        }
    }

    public function cancel(Pinjam $pinjam)
    {
        try {
            DB::beginTransaction();
            $mobil = Mobil::find($pinjam->mobil_id);

            if ($mobil) {
                $mobil->update(['status' => 'ready']);
            } else {
                throw new \Exception('Mobil tidak ditemukan');
            }
            $pinjam->delete();
            DB::commit();
            return redirect('pinjam')->with('message', 'Peminjaman dibatalkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('pinjam')->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
