<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Mobil;
use App\Models\Pinjam;
use App\Models\Kembali;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KembaliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $kembali = Kembali::with(['pinjam'])->where('users_id', Auth::user()->id)->get();
        return view('kembali.index', compact(['kembali']));
    }

    public function getPinjamanInfo($pinjam_id)
    {
        $pinjam = Pinjam::with('mobil')->where('id', $pinjam_id)->first();

        if ($pinjam) {
            $tanggal_mulai = Carbon::parse($pinjam->tanggal_mulai);
            $tanggal_selesai = Carbon::parse($pinjam->tanggal_selesai);
            $lama_sewa = $tanggal_selesai->diffInDays($tanggal_mulai);

            $total_tarif = $lama_sewa * $pinjam->mobil->tarif_sewa;

            return response()->json(['lama_sewa' => $lama_sewa, 'total_tarif' => $total_tarif]);
        }

        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pinjam = Pinjam::with(['mobil', 'user'])->where('status_pinjam', 'sedang dipinjam')->where('users_id', Auth::user()->id)->get();
        $array_mobil = [];

        foreach ($pinjam as $pin) {
            $value = $pin->mobil->no_plat . ' (' . $pin->mobil->merk . ' - ' . $pin->mobil->model . ')';
            $array_mobil[$pin->id] = $value;
        }

        return view('kembali.create', compact(['pinjam', 'array_mobil']));
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
            $idPinjam = $request->get('mobil_id');
            $data = [
                'tanggal_kembali' => $request->tanggal_kembali,
                'total_biaya' => $request->total_biaya,
                'pinjam_id' => $idPinjam,
                'users_id' => Auth::user()->id
            ];
            Kembali::create($data);
            Pinjam::where('id', $idPinjam)->update(['status_pinjam' => 'sudah dikembalikan']);
            $mobilId = Pinjam::find($idPinjam)->mobil_id;
            Mobil::where('id', $mobilId)->update(['status' => 'ready']);
            DB::commit();
            return redirect('kembali')->with('message', 'Mobil berhasil dikembalikan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('kembali')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
