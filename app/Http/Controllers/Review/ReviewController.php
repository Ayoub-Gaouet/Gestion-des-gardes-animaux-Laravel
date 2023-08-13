<?php

namespace App\Http\Controllers\Review;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::eloquent(Review::query()->with("booking.user"))
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "";

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-rating="' . $row->rating . '"
                     data-comment="' . $row->comment . '"
                    data-booking_id="' . $row->booking_id . '"
                        class="edit btn tooltipped "  data-placement="right" title="Editer"  data-toggle="modal"
                       data-target="#updateModal">
                            <i class="fas fa-edit text-warning"></i> </a>';

                    $btn .= '<a href="javascript:void(0)"  data-id="' . $row->id . '"
                            class="delete_review btn tooltipped" data-placement="right" title="Delete" data-toggle="url" >
                            <i class="fas fa-trash text-danger"></i> </a>';



                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $bookings = Booking::all();
        return view("admin.reviews.reviews")
            ->with('bookings', $bookings);
    }
    public function store(Request $request)
    {   $validation = Helper::validateRequest($request, [
        'rating' => ['required', 'numeric'],
        'comment' => ['required', 'string'],
        'booking' => ['required', 'integer', Rule::exists('bookings','id')],
    ]);

        if ($validation != null) {
            Alert::error('Erreur', $validation);
            return redirect()->back();
        }
        DB::beginTransaction();
        try {
            $review = new Review();
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->booking_id = $request->booking;
            $review->save();
            DB::commit();
            Alert::success('Success', "Your review has been added successfully !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Your review was rejected !")->persistent("ok");
            return redirect()->back();
        }
    }
    public function update(Request $request, Review $review)
    {
        DB::beginTransaction();
        try {
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            $review->booking_id = $request->booking;
            $review->save();
            DB::commit();
            Alert::success('Success', "Your review has been updated successfully!")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Your review update failed!")->persistent("ok");
            return redirect()->back();
        }
    }
    public function destroy(Review $review)
    {
        DB::beginTransaction();
        try {

            $review->delete();
            DB::commit();
            Alert::success('Success', "Le review a été supprimé avec succès !")->persistent("ok");
            return redirect()->back();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            Alert::warning('Error', "Le review n'a pas été supprimé !")->persistent("ok");
            return redirect()->back();
        }
    }
}
