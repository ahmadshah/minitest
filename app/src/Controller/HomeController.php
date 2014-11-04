<?php namespace Kraken\Controller;

use Kraken\Model\User;

class HomeController extends Controller
{
    public function showWelcome()
    {
       if ( ! $this->getUser()) {
            return $this->kraken->redirect('/home');
       }
    }

    public function showHome()
    {
        $user = $this->getUser();
    }

    protected function getUser()
    {
        if (isset($_SESSION['userId'])) {
            return $_SESSION['userId'];
        }

        return false;
    }
}
