<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlavourRequest;
use App\Models\Flavour;
use App\Traits\ResponseTraits;
use Exception;
use Illuminate\Http\Request;

class FlavourController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function itemGet()
    {
        try {
            $item = Flavour::orderby('id', 'desc')->paginate(3);
            return response()->json($item);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single($id)
    {
        try {
            $item = Flavour::findorfail($id);
            return response()->json($item);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    public function itemStatus(Request $request)
    {
        try {
            if ($request->status == 1) {
                foreach ($request->item as $value) {
                    Flavour::find($value)->update(['status' => 'true']);
                }
            } elseif ($request->status == 0) {
                foreach ($request->item as $value) {
                    Flavour::find($value)->update(['status' => 'false']);
                }
            } else if ($request->status == 'delete') {
                foreach ($request->item as $value) {
                    Flavour::find($value)->delete();
                }
            } else {
                return 'Opps!! Something went wrong.';
            }
            return response()->json(['status' => true, 'message' => 'success']);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function itemStore(FlavourRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'price' => 'required',
        ]);
        try {
            Flavour::create([
                'name' => $request->name,
                'color' => $request->color,
                'price' => $request->price,
                'status' => $request->status == true ? 'true' : 'false',
            ]);
            return response()->json(['status' => true, 'message' => 'Successful']);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Flavour::findorfail($id);
        $status = $data->status;
        if ($status == 'true') {
            $status = 'false';
        } else {
            $status = 'true';
        }
        $data->status = $status;
        $data->update();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function allItemGet()
    {
        try {
            $item = Flavour::where('status', 'true')->get();
            return response()->json($item);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'price' => 'required',
        ]);
        try {
            Flavour::find($id)->update([
                'name' => $request->name,
                'color' => $request->color,
                'price' => $request->price,
                'status' => $request->status == true ? 'true' : 'false',
            ]);
            return response()->json(['status' => true, 'message' => 'Successful']);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flavour  $flavour
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            Flavour::find($id)->delete();
            return response()->json(['status' => 200, 'message' => 'delete successfull']);
        } catch (Exception $error) {
            return $this->responseError($error->getMessage());
        }
    }
}
