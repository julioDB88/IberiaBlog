<?php

namespace App\Http\Controllers;

use App\Mail\Invitation as MailInvitation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, Invitation $invitation)
    {
        if (!$request->hasValidSignature()) {
            abort(404);
        }
        try {
            DB::transaction(function () use ($invitation) {
                $user=User::create(['name' => 'Guest', 'email' => $invitation->email, 'password' => Hash::make($invitation->password), 'role_id' => 1]);
                $this->destroy($invitation);
                $user->sendEmailVerificationNotification();
            });
        } catch (\Throwable $th) {

            abort(500);
        }

        return redirect()->route('login')->with('editor',__('We have sent you a verification email, please verify your email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email|unique:invitations,email',
            'password' => 'required|string'
        ]);

        $invi = Invitation::create($request->all())->id;

        Mail::to($request->email)->send(new MailInvitation($invi));
        return redirect()->back()->with('success', 'Invitation sended succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $invits = Invitation::all();
        return view('pages.invitations', compact('invits'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        $invitation->delete();   //
        return redirect()->back()->with('success',trans('invitation.destroyed'));
    }
}
