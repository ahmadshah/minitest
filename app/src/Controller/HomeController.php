<?php namespace Kraken\Controller;

use Kraken\Model\User;

class HomeController extends Controller
{
    public function showWelcome()
    {
       if ($this->getUser() instanceof \Kraken\Model\User) {
            return $this->kraken->redirect('/home');
       }

       return $this->kraken->render('welcome.php');
    }

    public function showHome()
    {
        if ( ! $this->getUser()) {
            return $this->kraken->redirect('/');
        }

        $user = $this->getUser();

        return $this->kraken->render('home.php', ['user' => $user->toArray()]);
    }

    protected function getUser()
    {
        if ( ! isset($_SESSION['userId'])) {
            return false;
        }

        return User::find($_SESSION['userId']);
    }
}
