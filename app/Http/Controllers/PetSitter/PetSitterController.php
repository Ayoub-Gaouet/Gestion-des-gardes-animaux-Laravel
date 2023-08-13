<?php

namespace App\Http\Controllers\PetSitter;

use App\Models\PetSitter;
use DB;
use Exception;
use Illuminate\Http\Request;
use Log;
use RealRashid\SweetAlert\Facades\Alert;

use Validator;
use Yajra\DataTables\Facades\DataTables;

class PetSitterController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            return Datatables::eloquent(PetSitter::query())
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="'
                        . $row->name . '" data-age="' . $row->age . '"data-genre="' . $row->genre .
                        '"data-tel="' . $row->tel . '"data-number_of_year_of_exp="' . $row->number_of_year_of_exp
                        . '"data-type_of_pets_can_care="' . $row->type_of_pets_can_care . '" data-email="' . $row->email . '"

                            class="edit btn tooltipped "  data-placement="right" title="Editer"  data-toggle="modal"
                       data-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';
                    if ($row->status == 0) {
                        $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . "Cliquez sur Oui pour activer le Propriétaire d'animal  N° " . '"
                            class="desactiver btn tooltipped" data-placement="right" title="Activer" data-toggle="tooltip" >
                             <i class="fas fa-user-check text-primary"></i></a>';
                    } else {
                        if ($row->status == 1) {
                            $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . "Cliquez sur Oui pour désactiver Propriétaire d'animal N° " . '"
                            class="desactiver btn tooltipped" data-placement="right" title="Désactiver" data-toggle="tooltip" >
                            <i class="fas fa-user-times text-danger"></i> </a>';
                        }
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("admin.petsitters.petsitters");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['max:255', 'required', 'string'],
            'age' => ['required', 'numeric'],
            'genre' => ['max:255', 'required', 'string'],
            'tel' => ['max:255', 'required', 'string'],
            'number_of_year_of_exp' => ['required', 'numeric'],
            'type_of_pets_can_care' => ['max:255', 'required', 'string'],
            'email' => ['email', 'required'],
            'password' => ['required', 'string', 'min:8'],

        ]);

        if ($validator->errors()->any()) {
            $text = "";
            foreach ($validator->errors()->all() as $error) {
                $text = $error . "\n";
            }

            Alert::warning('Error', $text);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $petsitter = new PetSitter();
            $petsitter->name = $request->name;
            $petsitter->age = $request->age;
            $petsitter->genre = $request->genre;
            $petsitter->tel = $request->tel;
            $petsitter->number_of_year_of_exp = $request->number_of_year_of_exp;
            $petsitter->type_of_pets_can_care = $request->type_of_pets_can_care;
            $petsitter->password = $request->password;
            if ($petsitter->email != $request->email) {
                $petsitter->email = $request->email;
                $petsitter->email_verified_at = null;
            }
            $petsitter->save();
            DB::commit();
            Alert::success('Success', "Votre gardien a été ajouter avec succès !");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre gardien a été rejeter !");
            return redirect()->back();
        }
    }

    public function update(Request $request, PetSitter $petsitter)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['max:255', 'required', 'string'],
            'age' => ['required', 'numeric'],
            'genre' => ['max:255', 'required', 'string'],
            'tel' => ['max:255', 'required', 'string'],
            'number_of_year_of_exp' => ['required', 'numeric'],
            'type_of_pets_can_care' => ['max:255', 'required', 'string'],
            'email' => ['email', 'required'],
        ]);

        if ($validator->errors()->any()) {
            $text = "";
            foreach ($validator->errors()->all() as $error) {
                $text = $error . "\n";
            }

            Alert::warning('Error', $text);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $petsitter->name = $request->name;
            $petsitter->age = $request->age;
            $petsitter->genre = $request->genre;
            $petsitter->tel = $request->tel;
            $petsitter->number_of_year_of_exp = $request->number_of_year_of_exp;
            $petsitter->type_of_pets_can_care = $request->type_of_pets_can_care;
            if ($petsitter->email != $request->email) {
                $petsitter->email = $request->email;
                $petsitter->email_verified_at = null;
            }


            $petsitter->save();
            DB::commit();
            Alert::success('Success', "Votre gardien a été modifier avec succès !");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre gardiena été rejeter !");
            return redirect()->back();
        }

    }

    public function desactivateAccount(PetSitter $petsitter)
    {
        DB::beginTransaction();
        try {
            if ($petsitter->status == 0) {
                $petsitter->status = 1;
            } else {
                $petsitter->status = 0;
            }
            $petsitter->save();
            DB::commit();
//            Cache::tags('users')->flush();
            Alert::success('Success', "Votre compte a été désactiver avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre demande a été rejeter !");
            return redirect()->back();
        }

    }
}
