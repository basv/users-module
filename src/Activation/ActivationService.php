<?php namespace Anomaly\Streams\Addon\Module\Users\Activation;

use Anomaly\Streams\Platform\Traits\CommandableTrait;
use Anomaly\Streams\Addon\Module\Users\User\Contract\UserInterface;
use Anomaly\Streams\Addon\Module\Users\Activation\Command\ForceActivationCommand;
use Anomaly\Streams\Addon\Module\Users\Activation\Command\CreateActivationCommand;
use Anomaly\Streams\Addon\Module\Users\Activation\Command\RemoveActivationCommand;
use Anomaly\Streams\Addon\Module\Users\Activation\Command\CompleteActivationCommand;
use Anomaly\Streams\Addon\Module\Users\Activation\Command\CheckIfActivationExistsCommand;

/**
 * Class ActivationService
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\Streams\Addon\Module\Users\Activation
 */
class ActivationService
{

    use CommandableTrait;

    /**
     * Create a new activation for a user.
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function create(UserInterface $user)
    {
        $command = new CreateActivationCommand($user->getUserId());

        return $this->execute($command);
    }

    /**
     * Force the completed activation for a user.
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function force(UserInterface $user)
    {
        $command = new ForceActivationCommand($user->getUserId());

        return $this->execute($command);
    }

    /**
     * Check if an activation exists for a user.
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function exists(UserInterface $user)
    {
        $command = new CheckIfActivationExistsCommand($user->getUserId());

        return $this->execute($command);
    }

    /**
     * Complete the activation for a user by it's code.
     *
     * @param UserInterface $user
     * @param               $code
     * @return mixed
     */
    public function complete(UserInterface $user, $code)
    {
        $command = new CompleteActivationCommand($user->getUserId(), $code);

        return $this->execute($command);
    }

    /**
     * Remove the activation codes for a user.
     *
     * @param UserInterface $user
     * @return mixed
     */
    public function remove(UserInterface $user)
    {
        $command = new RemoveActivationCommand($user->getAuthIdentifier());

        return $this->execute($command);
    }

}
 