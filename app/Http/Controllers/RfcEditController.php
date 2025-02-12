<?php

namespace App\Http\Controllers;

use App\Http\Requests\RfcRequest;
use App\Models\Rfc;

final readonly class RfcEditController
{
    public function edit(Rfc $rfc)
    {
        return view('rfc-form', [
            'rfc' => $rfc,
            'action' => action([self::class, 'update'], ['rfc' => $rfc, 'back' => request()->get('back')]),
        ]);
    }

    public function update(Rfc $rfc, RfcRequest $request)
    {
        $rfc->update($request->validated());

        flash('Success');

        if ($back = $request->get('back')) {
            return redirect()->to($back);
        }

        return redirect()->action([self::class, 'edit'], $rfc);
    }
}
