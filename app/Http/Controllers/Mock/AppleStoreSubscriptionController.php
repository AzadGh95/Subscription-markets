<?php

namespace App\Http\Controllers\Mock;

use App\Http\Controllers\Controller;

class AppleStoreSubscriptionController extends Controller
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
            'subscription' => $array[rand(0, 1)],
        ];
    }
}
