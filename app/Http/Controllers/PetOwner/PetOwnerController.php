<?php

namespace App\Http\Controllers\PetOwner;


use App\Http\Controllers\Controller;
use App\Models\Adresse;
use App\Models\petowner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class PetOwnerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            return Datatables::eloquent(PetOwner::query())
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="'
                        . $row->name . '" data-age="' . $row->age . '"data-genre="' . $row->genre .
                        '"data-tel="' . $row->tel . '" data-email="' . $row->email . '"
                    data-adresse="' . $row->adresse_id . '"
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
        return view("admin.petowners.petowners");
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['max:255', 'required', 'string'],
            'age' => ['required', 'numeric'],
            'genre' => ['max:255', 'required', 'string'],
            'tel' => ['max:255', 'required', 'string'],
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
            $petowner = new PetOwner();
            $petowner->name = $request->name;
            $petowner->age = $request->age;
            $petowner->genre = $request->genre;
            $petowner->tel = $request->tel;
            $petowner->password = $request->password;
            if ($petowner->email != $request->email) {
                $petowner->email = $request->email;
                $petowner->email_verified_at = null;
            }
            $petowner->save();
            DB::commit();
            if ($petowner->email_verified_at == null) {
                $petowner->sendEmailVerificationNotification();

            }
            Alert::success('Success', "Votre Propriétaire d'animal a été modifier avec succès !");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre Propriétaire d'animal a été rejeter !");
            return redirect()->back();
        }
    }
    public function update(Request $request, PetOwner $petowner)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['max:255', 'required', 'string'],
            'age' => ['required', 'numeric'],
            'genre' => ['max:255', 'required', 'string'],
            'tel' => ['max:255', 'required', 'string'],
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
            $petowner->name = $request->name;
            $petowner->age = $request->age;
            $petowner->genre = $request->genre;
            $petowner->tel = $request->tel;
            if ($petowner->email != $request->email) {
                $petowner->email = $request->email;
                $petowner->email_verified_at = null;
            }
            $petowner->save();
            DB::commit();
            if ($petowner->email_verified_at == null) {
                $petowner->sendEmailVerificationNotification();

            }
            Alert::success('Success', "Votre Propriétaire d'animal a été modifier avec succès !");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre Propriétaire d'animal a été rejeter !");
            return redirect()->back();
        }

    }
    public function desactivateAccount(PetOwner $petowner)
    {
        DB::beginTransaction();
        try {
            if ($petowner->status == 0) {
                $petowner->status = 1;
            } else {
                $petowner->status = 0;
            }
            $petowner->save();
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
