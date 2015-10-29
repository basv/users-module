<?php namespace Anomaly\UsersModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class UsersController
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\UsersModule\Http\Controller
 */
class UsersController extends PublicController
{

    /**
     * Logout the active user.
     *
     * @param UserAuthenticator $authenticator
     * @param Guard             $auth
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(UserAuthenticator $authenticator, Guard $auth)
    {
        if (!$auth->guest()) {
            $authenticator->logout();
        }

        return $this->response->redirectTo($this->request->get('redirect', '/'));
    }
}
