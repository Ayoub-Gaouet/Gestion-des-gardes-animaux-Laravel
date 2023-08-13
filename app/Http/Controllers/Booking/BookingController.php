<?php

namespace App\Http\Controllers\Booking;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;
class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::eloquent(Booking::query()->with("user"))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"
                    data-name="' . $row->name . '"
                    data-services="' . $row->services . '"
                    data-cost="' . $row->cost . '"  data-confirmation_status="' . $row->confirmation_status . '"
                    data-cancellation_status="' . $row->cancellation_status . '" data-user ="' . $row->user_id . '"
                        class="edit btn tooltipped "  data-placement="right" title="Editer"  data-toggle="modal"
                       data-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';

                        $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"
                            class="delete_booking btn tooltipped" data-placement="right" title="Delete" data-toggle="url" >
                            <i class="fas fa-trash text-danger"></i> </a>';



                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $users = User::all();
        return view("admin.bookings.bookings")
            ->with('users', $users);
    }
    public function store(Request $request)
    {    $validation = Helper::validateRequest($request, [
        'name' => ['required', 'string'],
        'services' => ['required', 'string'],
        'cost' => ['required', 'numeric'],
        'confirmation_status' => ['required', 'boolean'],
        'cancellation_status' => ['required', 'boolean'],
        'user' => ['required', 'integer', Rule::exists('users','id')],
    ]);

        if ($validation != null) {
            Alert::error('Erreur', $validation);
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $booking = new Booking();
            $booking->name = $request->name;
            $booking->services = $request->services;
            $booking->cost = $request->cost;
            $booking->confirmation_status = $request->confirmation_status;
            $booking->cancellation_status = $request->cancellation_status;
            $booking->user_id = $request->user;
            $booking->save();
            DB::commit();
            Alert::success('Success', "Your booking has been added successfully !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Your booking was rejected !")->persistent("ok");
            return redirect()->back();
        }
    }

    public function update(Request $request, Booking $booking)
    {
        DB::beginTransaction();
        try {
            $booking->name = $request->name;
            $booking->services = $request->services;
            $booking->cost = $request->cost;
            $booking->confirmation_status = $request->confirmation_status;
            $booking->cancellation_status = $request->cancellation_status;
            $booking->user_id = $request->user;
            $booking->save();
            DB::commit();
            Alert::success('Success', "Your booking has been updated successfully!")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Your booking update failed!")->persistent("ok");
            return redirect()->back();
        }
    }
    public function destroy(Booking $booking)
    {
        $review = Review::query()->where("booking_id", $booking->id)->count();
        if ($review > 0) {
            return Response::json(["error" => true, "message" => "Booking ne peut pas etre supprimé , car il possède des Reviews"], 200);
        }
        DB::beginTransaction();
        try {

            $booking->delete();
            DB::commit();
            Alert::success('Success', "Le booking a été supprimé avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Le booking n'a pas été supprimé !")->persistent("ok");
            return redirect()->back();
        }
    }

}
