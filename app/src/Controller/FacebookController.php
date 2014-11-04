<?php namespace Kraken\Controller;

use Kraken\Model\User;

class FacebookController extends Controller
{
    protected $token;

    public function connect()
    {
        $code = $this->kraken->request->get('code');

        if ( ! isset($code)) {
            return $this->kraken->redirect($this->kraken->oauth->getAuthorizationUrl());
        }

        $this->token = $this->kraken->oauth->getAccessToken('authorization_code', ['code' => $code]);

        $oauth = $this->kraken->oauth->getUserDetails($this->token);

        $eloquent = User::where('email', $oauth->email)->first();
        if (is_null($eloquent)) {
            $eloquent = new User;
        }

        $user = $this->save($eloquent, $oauth);
        $_SESSION['userId'] = $user->id;

        return $this->kraken->redirect('/home');
    }

    public function disconnect()
    {
        unset($_SESSION['userId']);

        return $this->kraken->redirect('/');
    }

    protected function save($user, $oauth)
    {
        $user->uid = $oauth->uid;
        $user->email = $oauth->email;
        $user->first_name = $oauth->firstName;
        $user->last_name = $oauth->lastName;
        $user->profile_image = $oauth->imageUrl;
        $user->save();

        return $user;
    }
}
