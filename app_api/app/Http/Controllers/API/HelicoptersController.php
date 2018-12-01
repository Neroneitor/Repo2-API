<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Helicopter;
use Validator;
class HelicoptersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helicopters  = Helicopter::all();
        return $this->sendResponse($helicopters ->toArray(), 'Helicopters retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required',
            'speed' => 'required',
            'color' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $helicopters  = Helicopter::create($input);
        return $this->sendResponse($helicopters ->toArray(), 'Helicopter created successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $helicopters  = Helicopter::find($id);
        if (is_null($helicopters  )) {
            return $this->sendError('Helicopter not found.');
        }
        return $this->sendResponse($helicopters  ->toArray(), 'Helicopter retrieved successfully.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Helicopter $helicopters )
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'type' => 'required',
            'name' => 'required',
            'speed' => 'required',
            'color' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $helicopters ->name = $input['type'];
        $helicopters ->detail = $input['name'];
        $helicopters ->name = $input['speed'];
        $helicopters ->detail = $input['color'];
        $helicopters ->save();
        return $this->sendResponse($helicopters ->toArray(), 'Helicopter updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helicopter $helicopters )
    {
        $helicopters ->delete();
        return $this->sendResponse($helicopters ->toArray(), 'Helicopter deleted successfully.');
    }
}
