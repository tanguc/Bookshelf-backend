<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ApiRegisterController extends Controller
{
    /**
     * Register a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function registerNewUser(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');
        //var_dump($credentials);

        /* $toto = $this->validate($request, [ */
        /*     'name', 'bail|required', */
        /*     'email', 'bailrequired', */
        /*     'password', 'bail|required' */
        /* ]); */

        /* var_dump($toto); */

        //var_dump($credentials);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        //var_dump($validator->fails());

        if (!$validator->fails())
            {
                if (is_null(User::where('email', $credentials['email'])->first()))
                    {
                        $user = new User;

                        $user->email = $credentials['email'];
                        $user->name = $credentials['name'];
                        $user->password = Hash::make($credentials['password']);
                        $user->save();
                        return response()->json(['success' => 'User has been created']);
                    }
                else
                    {
                        return response()->json(['error' => 'Email is already taken']);
                    }
            }
        else
            {
                //var_dump($validator->getMessageBag()->__toString());
                return response()->json(['error' => $validator->getMessageBag()->__toString()]);
            }

        //var_dump($validator->getMessageBag()->all());
        //$user = User::where('email', $credentials['name
        //
    }

    
}