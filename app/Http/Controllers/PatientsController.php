<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::all();
        $total = count($patients);

        if ($total) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditampilkan',
                'total' => $total,
                'data' => $patients
            ], 200);
        }

        $empty = [
            'success' => false,
            'message' => 'Data tersebut kosong'
        ];

        return response()->json($empty, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|unique:patients,name',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'nullable'
        ]);

        $patients = Patient::create($validasi);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $patients
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patients = Patient::find($id);

        if ($patients) {
            $success = [
                'success' => true,
                'message' => 'id : ' . $id . ' berhasil ditampilkan',
                'data' => $patients
            ];

            return response()->json($success, 200);
        }

        $empty = [
            'success' => false,
            'message' => 'Data tidak dapat ditemukan'
        ];

        return response()->json($empty, 404);
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
        $patients = Patient::find($id);

        if ($patients) {
            $patients->update($request->all());

            $success = [
                'success' => true,
                'message' => 'id : ' . $id . ' berhasil di update',
                'data' => $patients
            ];

            return response()->json($success, 200);
        }

        $empty = [
            'success' => false,
            'message' => 'id : ' .  $id . ' tidak dapat ditemukan'
        ];

        return response()->json($empty, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patients = Patient::find($id);

        if ($patients) {
            $patients->delete();

            $success = [
                'success' => true,
                'message' => 'id : ' . $id . ' berhasil dihapus'
            ];

            return response()->json($success, 200);
        }

        $empty = [
            'success' => false,
            'message' => 'id : ' .  $id . ' tidak dapat ditemukan'
        ];

        return response()->json($empty, 404);
    }

    # membuat function status dead
    public function dead()
    {
        $patients = Patient::where('status', 'dead')->get();
        $total = count($patients);

        if ($total) {
            $success = [
                'success' => true,
                'message' => 'Data pasien dengan status dead, berhasil ditampilkan',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($success, 200);
        }

        $empty = [
            'success' => false,
            'message' => 'Data tersebut kosong'
        ];
        return response()->json($empty, 200);
    }

    # membuat function status positive
    public function positive()
    {
        $patients = Patient::where('status', 'positive')->get();
        $total = count($patients);

        if ($total) {
            $success = [
                'success' => true,
                'message' => 'Data pasien dengan status positive, berhasil ditampilkan',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($success, 200);
        }

        $empty = [
            'success' => false,
            'message' => 'Data tersebut kosong'
        ];
        return response()->json($empty, 200);
    }

    # membuat function status recovered
    public function recovered()
    {
        $patients = Patient::where('status', 'recovered')->get();
        $total = count($patients);

        if ($total) {
            $success = [
                'success' => true,
                'message' => 'Data pasien dengan status recovered, berhasil ditampilkan',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($success, 200);
        }

        $empty = [
            'success' => false,
            'message' => 'Data tersebut kosong'
        ];
        return response()->json($empty, 200);
    }

    # membuat function search
    public function search($name)
    {
        $patients = Patient::where('name', 'like', '%' . $name . '%')->get();
        $total = count($patients);

        if ($total) {
            $success = [
                'success' => true,
                'message' => 'Get searched resource',
                'total' => $total,
                'data' => $patients
            ];

            return response()->json($success, 200);
        }

        $failed = [
            'success' => false,
            'message' => 'Data tidak dapat ditemukan'
        ];

        return response()->json($failed, 404);
    }
}
