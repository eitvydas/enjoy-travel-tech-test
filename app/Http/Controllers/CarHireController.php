<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarHire;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CarHireController extends Controller
{
    public function getAvailableCars() {

        // There are 2 custom attributes added to User model that return a boolean value called 'is_senior_driver' and 'is_young_driver'
        // Test Young/Senior drivers and use the data accordingly (i.e. Add to the total price when generating the quote)
//        $user = User::where('id', 1)->first(); // Young
//        $user = User::where('id', 4)->first(); // Senior
//        $user = User::where('id', 3)->first(); // None
//        dd($user->is_senior_driver, $user->isYoungDriver);

        try {

            if(!Car::where('available', true)->exists()) {
                return response()->json([
                    'message' => 'There are no cars available for hire at this moment.',
                    'data' => null
                ]);
            }

            return response()->json([
                'message' => 'Retrieved the records successfully.',
                'data' => Car::where('available', true)->get()
            ]);
        } catch (\Exception $e) {
            // Log the error and notify development department if required
//            Log::error('There was an error trying to retrieve available cars: ' . $e->getMessage());
            return response()->json([
                'message' => 'There was an error with your request. Please try again or contact our customer services.',
                'data' => null
            ], 200);
        }
    }

    public function updateCarHire(Request $request, $hireId) {
        $hire = CarHire::where('id', $hireId)->first();
        if(!$hire) {
            return response()->json('There was an error retrieving car hire data. Please try again or contact our customer services.', 500);
        }

        try {

            if($request->has('car_id')) {
                // Check if the car is available
                $car = Car::where('id', $request->get('car_id'))->where('available', true)->exists();

                if($car) {
                    $hire->car_id = $request->get('car_id');
                }
            }

            if($request->has('hire_start_date')) {
                $hire->hire_start_date = $request->get('hire_start_date');
            }

            if($request->has('hire_end_date')) {
                $hire->hire_end_date = $request->get('hire_end_date');
            }

            $hire->save();

            return response()->json([
                'message' => 'The car hire record has been updated successfully.',
                'data' => $hire
            ], 200);

        } catch (\Exception $e) {
            // Log the error and notify development department if required
//            Log::error('There was an error trying to update car_hire record: ' . $e->getMessage());
            return response()->json([
                'message' => 'There was an error with your request. Please try again or contact our customer services.',
                'data' => null
            ], 500);
        }
    }

    public function deleteCarHire($hireId) {
        $hire = CarHire::where('id', $hireId)->first();
        if(!$hire) {
            return response()->json([
                'message' => 'There was an error retrieving car hire data. Please try again or contact our customer services.',
                'data' => null
            ], 500);
        }

        try {
            $hire->delete();

            return response()->json([
                'message' => 'The car hire record has been deleted successfully.',
                'data' => null
            ]);
        } catch (\Exception $e) {
            // Log the error and notify development department if required
//            Log::error('There was an error trying to delete the car_hire record: ' . $e->getMessage());
            return response()->json([
                'message' => 'There was an error with your request. Please try again or contact our customer services.',
                'data' => null
            ], 500);
        }
    }
}
