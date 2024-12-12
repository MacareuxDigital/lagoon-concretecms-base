<?php

namespace DoctrineProxies\__CG__\Concrete\Core\Entity\Permission;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class IpAccessControlRange extends \Concrete\Core\Entity\Permission\IpAccessControlRange implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', 'ipAccessControlRangeID', 'category', 'site', 'ipFrom', 'ipTo', 'type', 'expiration', '' . "\0" . 'Concrete\\Core\\Entity\\Permission\\IpAccessControlRange' . "\0" . 'ipRange'];
        }

        return ['__isInitialized__', 'ipAccessControlRangeID', 'category', 'site', 'ipFrom', 'ipTo', 'type', 'expiration', '' . "\0" . 'Concrete\\Core\\Entity\\Permission\\IpAccessControlRange' . "\0" . 'ipRange'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (IpAccessControlRange $proxy) {
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
    public function getIpAccessControlRangeID()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getIpAccessControlRangeID();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIpAccessControlRangeID', []);

        return parent::getIpAccessControlRangeID();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategory', []);

        return parent::getCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory(\Concrete\Core\Entity\Permission\IpAccessControlCategory $value)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategory', [$value]);

        return parent::setCategory($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getSite()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSite', []);

        return parent::getSite();
    }

    /**
     * {@inheritDoc}
     */
    public function setSite(?\Concrete\Core\Entity\Site\Site $value = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSite', [$value]);

        return parent::setSite($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getIpRange()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIpRange', []);

        return parent::getIpRange();
    }

    /**
     * {@inheritDoc}
     */
    public function setIpRange(\IPLib\Range\RangeInterface $value)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIpRange', [$value]);

        return parent::setIpRange($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', []);

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setType($value)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', [$value]);

        return parent::setType($value);
    }

    /**
     * {@inheritDoc}
     */
    public function getExpiration()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExpiration', []);

        return parent::getExpiration();
    }

    /**
     * {@inheritDoc}
     */
    public function setExpiration(?\DateTime $value = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setExpiration', [$value]);

        return parent::setExpiration($value);
    }

}