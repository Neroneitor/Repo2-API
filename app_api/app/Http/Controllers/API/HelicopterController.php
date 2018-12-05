<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Helicopter;
use Validator;
class HelicopterController extends BaseController
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
        $helicopters ->type = $input['type'];
        $helicopters ->name = $input['name'];
        $helicopters ->speed = $input['speed'];
        $helicopters ->color = $input['color'];
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
    public function getGuzzleRequest()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://jsonplaceholder.typicode.com/users');
        $response = $request->getBody();
       //dd($response);
        echo gettype($response);
        return ($response);

    }
    public function getUser()
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://randomuser.me/api/?results=25');
        $response = $request->getBody();
        echo gettype ($response);
        //return $this->sendResponse($helicopters, 'List User');
        // dd($response);
        return ($response);
    }


    public function getUserGit()
    {
    $client = new \GuzzleHttp\Client();
    $res = $client->request('GET', 'https://api.github.com/user', 
    ['auth' => ['Neroneitor', 'Neroneitor1234']]);
    echo $res->getStatusCode();
    // "200"
    //echo $request->getHeader('content-type');
    // 'application/json; charset=utf8'
    echo $res->getBody();
    // {"type":"User"...'

    }
}
