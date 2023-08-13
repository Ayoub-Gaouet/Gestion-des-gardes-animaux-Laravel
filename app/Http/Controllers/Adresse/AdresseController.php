<?php

namespace App\Http\Controllers\Adresse;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Adresse;
use App\Models\PetSitter;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class AdresseController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::eloquent(Adresse::query()->with("petsitter"))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-rue="' . $row->rue . '" data-ville="' . $row->ville . '"
                    data-code_postal="' . $row->code_postal . '" data-petsitter="' . $row->petsitter_id . '"
                        class="edit btn tooltipped "  data-placement="right" title="Editer"  data-toggle="modal"
                       data-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';
                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"
                            class="delete_adresse btn tooltipped" data-placement="right" title="Delete" data-toggle="url" >
                            <i class="fas fa-trash text-danger"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $petsitters = PetSitter::all();
        return view("admin.adresses.adresses")
            ->with('petsitters', $petsitters);
    }
    public function store(Request $request)
    {

        $validation = Helper::validateRequest($request, [
            'rue' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:255'],
            'petsitter' => ['required', 'integer', Rule::exists('pet_sitters','id')],

        ]);

        if ($validation != null) {
            Alert::error('Erreur', $validation);
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $adresse = new Adresse();
            $adresse->rue = $request->rue;
            $adresse->ville = $request->ville;
            $adresse->code_postal = $request->code_postal;
            $adresse->petsitter_id = $request->petsitter;
            $adresse->save();
            DB::commit();
            Alert::success('Success', "Votre adresse a été ajouter avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre adresse a été rejeter !")->persistent("ok");
            return redirect()->back();
        }
    }

    public function update(Request $request, Adresse $adresse)
    {
        $validation = Helper::validateRequest($request, [
            'rue' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'string', 'max:255'],
            'petsitter' => ['required', 'integer', Rule::exists('pet_sitters','id')],

        ]);

        if ($validation != null) {
            Alert::error('Erreur', $validation);
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $adresse->rue = $request->rue;
            $adresse->ville = $request->ville;
            $adresse->code_postal = $request->code_postal;
            $adresse->petsitter_id = $request->petsitter;
            $adresse->save();
            DB::commit();
            Alert::success('Success', "Votre adresse a été modifier avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre adresse a été rejeter !")->persistent("ok");
            return redirect()->back();
        }
    }
    public function destroy(Adresse $adresse)
    {
        DB::beginTransaction();
        try {
            $adresse->delete();
            DB::commit();
            Alert::success('Success', "Le adresse a été supprimé avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Le adresse n'a pas été supprimé !")->persistent("ok");
            return redirect()->back();
        }
    }
}
