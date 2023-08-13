<?php

namespace App\Http\Controllers\Pet;


use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Adresse;
use App\Models\PetOwner;
use App\Models\Pet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PetController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::eloquent(Pet::query()->with("petowner"))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . $row->name .
                        '" data-age="' . $row->age . '"  data-type="' . $row->type . '"  data-needs="' . $row->needs . '"
                    data-petowner="' . $row->petowner_id . '"
                        class="edit btn tooltipped "  data-placement="right" title="Editer"  data-toggle="modal"
                       data-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';
                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"
                            class="delete_pet btn tooltipped" data-placement="right" title="Delete" data-toggle="url" >
                            <i class="fas fa-trash text-danger"></i> </a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $petowners = PetOwner::all();
        return view("admin.pets.pets")
            ->with('petowners', $petowners);
    }
    public function store(Request $request)
    {

        $validation = Helper::validateRequest($request, [
            'name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:255'],
            'needs' => ['required', 'string', 'max:255'],
            'petowner' => ['required', 'integer', Rule::exists('pet_owners','id')],
        ]);

        if ($validation != null) {
            Alert::error('Erreur', $validation);
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $pet = new Pet();
            $pet->name = $request->name;
            $pet->type = $request->type;
            $pet->age = $request->age;
            $pet->needs = $request->needs;
            $pet->petowner_id = $request->petowner;
            $pet->save();
            DB::commit();
            Alert::success('Success', "Votre pet a été ajouter avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre pet a été rejeter !")->persistent("ok");
            return redirect()->back();
        }
    }

    public function update(Request $request, Pet $pet)
    {
        DB::beginTransaction();
        try {
            $pet->name = $request->name;
            $pet->age = $request->age;
            $pet->type = $request->type;
            $pet->needs = $request->needs;
            $pet->save();
            DB::commit();
            Alert::success('Success', "Votre Animal a été modifier avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre Animal a été rejeter !");
            return redirect()->back();
        }
    }
    public function destroy(Pet $pet)
    {
        DB::beginTransaction();
        try {
            $pet->delete();
            DB::commit();
            Alert::success('Success', "L'Animal a été supprimé avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "L'Animal n'a pas été supprimé !")->persistent("ok");
            return redirect()->back();
        }
    }


}
