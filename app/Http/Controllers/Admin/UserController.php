<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Configuration;
use App\Models\User;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = auth()->user();
            return Datatables::eloquent(User::query())
                ->addIndexColumn()
                ->addColumn('action', function ($row) use ($user) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . $row->name . '" data-age="' . $row->age . '"data-genre="' . $row->genre . '"data-tel="' . $row->tel . '" data-email="' . $row->email . '"
                            class="edit btn tooltipped "  data-placement="right" title="Editer"  data-toggle="modal"
                       data-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';

                    if ($user->id != $row->id) {

                        $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . $row->name . '" data-email="' . $row->email . '"
                            class="reset btn  tooltipped "  data-placement="right" title="Changer mot de passe"  data-toggle="modal"
                       data-target="#updatePassword">
                           <i class="fas fa-key text-secondary"></i> </a>';

                    }


                    if ($row->status == 0) {
                        $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . "Cliquez sur Oui pour activer l'utilisateur N° " . '"
                            class="desactiver btn tooltipped" data-placement="right" title="Activer" data-toggle="tooltip" >
                             <i class="fas fa-user-check text-primary"></i></a>';
                    } else {
                        if ($row->status == 1) {
                            $btn .= ' <a href="javascript:void(0)"  data-id="' . $row->id . '"  data-name="' . "Cliquez sur Oui pour désactiver l'utilisateur N° " . '"
                            class="desactiver btn tooltipped" data-placement="right" title="Désactiver" data-toggle="tooltip" >
                            <i class="fas fa-user-times text-danger"></i> </a>';
                        }
                    }


                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view("admin.users.users");
    }

    public function update(Request $request, User $user)
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
            $user->name = $request->name;
            $user->age = $request->age;
            $user->genre = $request->genre;
            $user->tel = $request->tel;
            if ($user->email != $request->email) {
                $user->email = $request->email;
                $user->email_verified_at = null;
            }
            $user->save();
            DB::commit();
            if ($user->email_verified_at == null) {
                $user->sendEmailVerificationNotification();

            }
            Alert::success('Success', "Votre utilisateur a été modifier avec succès !");
            return redirect()->back();

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre produit a été rejeter !");
            return redirect()->back();
        }
    }

    public function changePasswordAccount(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed'
        ]);
        $attributeNames = array(
            'new_password' => 'Nouveau mot de passe',
        );

        $validator->setAttributeNames($attributeNames);

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
            $user->password = Hash::make($request->get('new_password'));
            $user->save();
            DB::commit();
            Alert::success('Success', "Votre demande a été envoyée avec succès !");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Votre demande a été rejeter !");
            return redirect()->back();
        }

    }

    public function desactivateAccount(User $user)
    {
        DB::beginTransaction();
        try {
            if ($user->status == 0) {
                $user->status = 1;
            } else {
                $user->status = 0;
            }
            $user->save();
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

    public function updateProfile(Request $request)
    {
        $user = Auth::²();

        $validator = Validator::make($request->all(), [
            'name' => 'min:2',
            'email' => ['email'],
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Erreur modification du compte !');
        }

        $user->name = $request->name;

        if ($user->email != $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('images/users');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
            $user->photo = $filename;
        }


        DB::beginTransaction();
        try {

            $user->save();
            if ($user->email_verified_at == null) {
                $user->sendEmailVerificationNotification();
            }
            DB::commit();
//            Cache::tags('users')->flush();
            Alert::success('Success', "Profil Modifié!");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Erreur modification du compte");
            return redirect()->back();
        }


    }

    public function editPictures()
    {
        $user = Auth::user();
        return view("admin.administration.edit-picture")->with("user", $user);
    }

    public function updateLogo(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = Helper::generateApikey() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/logo');
            $img = Image::make($image->path());
            $file = new Filesystem;
            $file->cleanDirectory('images/logo');
            if ($img->resize(400, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename)) {
                Configuration::query()->where("label", "logo")->update(["value" => $filename]);
                Alert::success('Success', "Logo Modifié!");
                return Redirect::back();
            } else {
                Alert::warning('Error', "Erreur modification du Logo");
                return Redirect::back();
            }
        } else {
            Alert::warning('Error', "Aucune photo ajoutée !");
            return Redirect::back();
        }
    }

    public function updateBackground(Request $request)
    {

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = Helper::generateApikey() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/background');
            $img = Image::make($image->path());
            $file = new Filesystem;
            $file->cleanDirectory('images/background');
            if ($img->save($destinationPath . '/' . $filename)) {
                Configuration::query()->where("label", "background")->update(["value" => $filename]);
                Alert::success('Success', "Background Modifié!");
                return Redirect::back();
            } else {
                Alert::warning('Error', "Erreur modification du Background");
                return Redirect::back();
            }
        } else {
            Alert::warning('Error', "Aucune photo ajoutée !");
            return Redirect::back();
        }
    }

    public function giveRoleToUser(User $user, Request $request)
    {
        try {
            $user->syncRoles([$request->role]);
//            Cache::tags('users')->flush();
            Alert::success('Success', "Role Affecté avec Succès");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Role Affecté avec Succès");
            return redirect()->back();
        }
    }

    public function show()
    {
        $user = Auth::user();
        return view("admin.users.edit_user")->with("user", $user);
    }

}
