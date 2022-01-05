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
        // menampilkan seluruh data
        $patients = Patient::all();

        // memberikan informasi jumlah seluruh data
        $total = count($patients);

        if ($total) {
            // jika data nya ada
            $dataAda = [
                'success' => true,
                'message' => 'Data is available',
                'total' => $total,
                'data' => $patients
            ];

            return response()->json($dataAda, 200);
        }

        // else, jika data nya kosong
        $dataEmpty = [
            'success' => false,
            'message' => 'Data is empty'
        ];

        return response()->json($dataEmpty, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create validation
        $validation = $request->validate([
            'name' => 'required|unique:patients,name',
            'phone' => 'required|numeric',
            'address' => 'required',
            'status' => 'required',
            'in_date_at' => 'required',
            'out_date_at' => 'nullable'
        ]);

        // menyimpan data ke database
        $patients = Patient::create($validation);

        return response()->json([
            'success' => true,
            'message' => 'Data is added successfully',
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
        // mencari id
        $patients = Patient::find($id);

        // buat kondisi
        if ($patients) {
            // jika data berhasil ditampilkan sesuai id yang ada di db
            $success = [
                'success' => true,
                'message' => 'id : ' . $id . ' successful appears',
                'data' => $patients
            ];

            return response()->json($success, 200);
        }

        // else, tidak dapat menampilkan data, dikarenakan id tidak sesuai yang ada di db
        $failed = [
            'message' => 'Resource not found'
        ];

        return response()->json($failed, 404);
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
        // mencari id
        $patients = Patient::find($id);

        // buat kondisi
        if ($patients) {
            // mengupdate data patients
            $patients->update($request->all());

            // response success => status code (200)
            $success = [
                'success' => true,
                'message' => 'id : ' . $id . ' is update successfully',
                'data' => $patients
            ];

            return response()->json($success, 200);
        }

        // else, response failed => status code (404)
        $failed = [
            'success' => false,
            'message' => 'id : ' .  $id . ' not found'
        ];

        return response()->json($failed, 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // mencari id
        $patients = Patient::find($id);

        // buat kondisi
        if ($patients) {
            // menghapus data patients
            $patients->delete();

            // response success => status code (200)
            $success = [
                'success' => true,
                'message' => 'id : ' . $id . ' is deleted successfully'
            ];

            return response()->json($success, 200);
        }

        // else, response failed => status code (404)
        $failed = [
            'success' => false,
            'message' => 'id : ' .  $id . ' not found'
        ];

        return response()->json($failed, 404);
    }

    // membuat function status dead
    public function dead()
    {
        $patients = Patient::where('status', 'dead')->get();
        $total = count($patients);

        if ($total) {
            $data = [
                'success' => true,
                'message' => 'Get dead resource',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($data, 200);
        }

        $data = [
            'success' => false,
            'message' => 'Data is empty'
        ];
        return response()->json($data, 200);
    }

    // membuat function status positive
    public function positive()
    {
        $patients = Patient::where('status', 'positive')->get();
        $total = count($patients);

        if ($total) {
            $data = [
                'success' => true,
                'message' => 'Get positive resource',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($data, 200);
        }

        $data = [
            'success' => false,
            'message' => 'Data is empty'
        ];
        return response()->json($data, 200);
    }

    // membuat function status recovered
    public function recovered()
    {
        $patients = Patient::where('status', 'recovered')->get();
        $total = count($patients);

        if ($total) {
            $data = [
                'success' => true,
                'message' => 'Get recovered resource',
                'total patients' => $total,
                'data patients' => $patients
            ];
            return response()->json($data, 200);
        }

        $data = [
            'success' => false,
            'message' => 'Data is empty'
        ];
        return response()->json($data, 200);
    }

    // membuat function search
    public function search($name)
    {
        // mencari dan menampilkan data berdasarkan nama yang di cari
        $patients = Patient::where('name', 'like', '%' . $name . '%')->get();

        // memberikan informasi jumlah seluruh data
        $total = count($patients);

        // buat kondisi
        if ($total) {
            // success, jika ada data yang berdasarkan nama yang di cari
            $success = [
                'success' => true,
                'message' => 'Get searched resource',
                'total' => $total,
                'data' => $patients
            ];

            return response()->json($success, 200);
        }

        // else, jika nama yang di cari tidak ada di db
        $failed = [
            'success' => false,
            'message' => 'Resource not found'
        ];

        return response()->json($failed, 404);
    }
}
