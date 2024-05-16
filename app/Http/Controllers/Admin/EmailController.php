<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailUpdateRequest;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $email = Email::orderBy('id','desc')->first();

        return view('admin.email.create', compact('email'));
    }

    /**
     * @param \App\Http\Requests\EmailUpdateRequest $request
     * @param \App\Models\Email $email
     * @return \Illuminate\Http\Response
     */
    public function update(EmailUpdateRequest $request, Email $email)
    {
        $email->update($request->validated());

        return redirect()->route('admin.email.index');
    }
}
