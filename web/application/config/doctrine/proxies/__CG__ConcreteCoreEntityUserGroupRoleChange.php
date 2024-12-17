<?php

namespace DoctrineProxies\__CG__\Concrete\Core\Entity\User;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class GroupRoleChange extends \Concrete\Core\Entity\User\GroupRoleChange implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'notifications', 'gID', 'grID', 'user', 'requested'];
        }

        return ['__isInitialized__', 'id', 'notifications', 'gID', 'grID', 'user', 'requested'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (GroupRoleChange $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load(): void
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized(): bool
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized): void
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(?\Closure $initializer = null): void
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer(): ?\Closure
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(?\Closure $cloner = null): void
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner(): ?\Closure
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties(): array
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getGroup()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGroup', []);

        return parent::getGroup();
    }

    /**
     * {@inheritDoc}
     */
    public function getRole()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRole', []);

        return parent::getRole();
    }

    /**
     * {@inheritDoc}
     */
    public function getGID(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGID', []);

        return parent::getGID();
    }

    /**
     * {@inheritDoc}
     */
    public function setGID(int $gID): \Concrete\Core\Entity\User\GroupRoleChange
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGID', [$gID]);

        return parent::setGID($gID);
    }

    /**
     * {@inheritDoc}
     */
    public function getGrID(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGrID', []);

        return parent::getGrID();
    }

    /**
     * {@inheritDoc}
     */
    public function setGrID(int $grID): \Concrete\Core\Entity\User\GroupRoleChange
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGrID', [$grID]);

        return parent::setGrID($grID);
    }

    /**
     * {@inheritDoc}
     */
    public function getUser(): ?\Concrete\Core\Entity\User\User
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(\Concrete\Core\Entity\User\User $user): \Concrete\Core\Entity\User\GroupRoleChange
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUser', [$user]);

        return parent::setUser($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getRequested(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRequested', []);

        return parent::getRequested();
    }

    /**
     * {@inheritDoc}
     */
    public function setRequested(\DateTime $requested): \Concrete\Core\Entity\User\GroupRoleChange
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRequested', [$requested]);

        return parent::setRequested($requested);
    }

    /**
     * {@inheritDoc}
     */
    public function getNotificationDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotificationDate', []);

        return parent::getNotificationDate();
    }

    /**
     * {@inheritDoc}
     */
    public function getUsersToExcludeFromNotification()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsersToExcludeFromNotification', []);

        return parent::getUsersToExcludeFromNotification();
    }

    /**
     * {@inheritDoc}
     */
    public function getNotifications(): \Doctrine\Common\Collections\Collection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNotifications', []);

        return parent::getNotifications();
    }

}
