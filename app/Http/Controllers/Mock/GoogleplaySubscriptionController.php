<?php

namespace App\Http\Controllers\Mock;

use App\Http\Controllers\Controller;

class GoogleplaySubscriptionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = 1)
    {
        $array = ['active', 'expired'];

        return [
            'status' => $array[rand(0, 1)],
        ];
    }
}
