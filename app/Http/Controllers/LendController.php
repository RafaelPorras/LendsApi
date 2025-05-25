<?php

namespace App\Http\Controllers;

use App\Models\Lend;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class LendController extends Controller
{
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Constructor logic here (if needed)
    }

    /**
     * Return a list of lends
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lends = Lend::all();

        return $this->successResponse($lends);
    }

    /**
     * Store a new instance of lend
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        //rules for creating a lend
        $rules = [
            'user_id' => 'required|integer|min:1',
            'copy_id' => 'required|integer|min:1',
            'incident_id' => 'required|integer|min:1',
            'lend_date' => 'required|date|date_format:Y-m-d',
            'real_return_date' => 'date|date_format:Y-m-d',
            'expected_return_date' => 'required|date|date_format:Y-m-d',
            'status' => 'required|in:pending,returned,overdue,renewed',
        ];

        //Validate the request
        $this->validate($request,$rules);

        //Create a new lend
        $lend = Lend::create($request->all());

        //return the new copy
        return $this->successResponse($lend);

    }

    /**
     * Return a specific Lend
     * 
     * @param int $lend The ID of the lend to retrieve
     * @return \Illuminate\Http\Response
     */
    public function show($lend)
    {
        //Find a specific lend
        $lend = Lend::findOrFail($lend);

        //Return the specific lend
        return $this->successResponse($lend);
    }

    /**
     * Update a specific lend
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $lend The Id of the lend to update
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lend)
    {
        //rules for updateing a Lend
         $rules = [
            'user_id' => 'integer|min:1',
            'copy_id' => 'integer|min:1',
            'incident_id' => 'integer|min:1',
            'lend_date' => 'date|date_format:Y-m-d',
            'real_return_date' => 'date|date_format:Y-m-d',
            'expected_return_date' => 'date|date_format:Y-m-d',
            'status' => 'in:pending,returned,overdue,renewed',
        ];

        //validate the request
        $this->validate($request,$rules);

        //Find a specific lend
        $lend = Lend::findOrFail($lend);

        //Update the lend
        $lend->fill($request->all());

        //Checj if the lend has changed
        if($lend->isClean()){
            return $this->errorResponse('At least one value most be change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        //Save the lend
        $lend->save();

        //Return the changed lend
        return $this->successResponse($lend);

    }

    /**
     * Delete an instance of Lends
     * 
     * @param int $lend The ID of the Lend to delete
     * @return Illuminate\Http\Response
     */
    public function destroy($lend)
    {
        //Find a specific lend
        $lend = Lend::FindOrFail($lend);

        //Delete a specifc lend
        $lend->delete();

        //Return the deleted lend
        return $this->successResponse($lend);
    }
    //
}
