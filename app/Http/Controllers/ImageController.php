<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function formSubmit(Request $request)
    {

        echo '<pre>';
        var_dump($request->all());
        echo '</pre>';

    	$imageName = time().'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('images'), $imageName);


    	return response()->json(['success'=>'You have successfully upload file.']);
    }
}
