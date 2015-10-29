<?php namespace Anomaly\UsersModule\Role;

use Anomaly\Streams\Platform\Model\Users\UsersRolesEntryModel;
use Anomaly\UsersModule\Role\Contract\RoleInterface;
use Anomaly\UsersModule\User\UserCollection;

/**
 * Class RoleModel
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\UsersModule\RoleInterface
 */
class RoleModel extends UsersRolesEntryModel implements RoleInterface
{

    /**
     * The cache minutes.
     *
     * @var int
     */
    protected $cacheMinutes = 99999;

    /**
     * Get the role slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the role name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the role's permissions.
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * Return if a role as access to a the permission.
     *
     * @param string $permission
     * @return mixed
     */
    public function hasPermission($permission)
    {
        if ($this->getSlug() == 'admin') {
            return true;
        }

        if (!$this->getPermissions()) {
            return false;
        }

        if (array_get($this->getPermissions(), $permission) === true) {
            return true;
        }

        return false;
    }

    /**
     * Merge provided permissions onto existing ones.
     *
     * @param array $permissions
     * @return $this
     */
    public function mergePermissions(array $permissions)
    {
        $this->permissions = array_merge($this->getPermissions(), $permissions);

        return $this;
    }

    /**
     * Get the related users.
     *
     * @return UserCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Return the users relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(
            'Anomaly\UsersModule\User\UserModel',
            'users_users_roles',
            'related_id',
            'entry_id'
        );
    }
}
