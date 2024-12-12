<?php

namespace DoctrineProxies\__CG__\Concrete\Core\Entity\Board;


/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Board extends \Concrete\Core\Entity\Board\Board implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', 'boardID', 'boardName', 'site', 'data_sources', 'instances', 'permission_assignments', 'template', 'sortBy', 'custom_slot_templates', 'hasCustomSlotTemplates', 'hasCustomWeightingRules', 'overridePermissions', 'package'];
        }

        return ['__isInitialized__', 'boardID', 'boardName', 'site', 'data_sources', 'instances', 'permission_assignments', 'template', 'sortBy', 'custom_slot_templates', 'hasCustomSlotTemplates', 'hasCustomWeightingRules', 'overridePermissions', 'package'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Board $proxy) {
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
    public function getSite()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSite', []);

        return parent::getSite();
    }

    /**
     * {@inheritDoc}
     */
    public function setSite($site): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSite', [$site]);

        parent::setSite($site);
    }

    /**
     * {@inheritDoc}
     */
    public function getBoardID()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getBoardID();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBoardID', []);

        return parent::getBoardID();
    }

    /**
     * {@inheritDoc}
     */
    public function getBoardName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBoardName', []);

        return parent::getBoardName();
    }

    /**
     * {@inheritDoc}
     */
    public function setBoardName($boardName): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBoardName', [$boardName]);

        parent::setBoardName($boardName);
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSources()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDataSources', []);

        return parent::getDataSources();
    }

    /**
     * {@inheritDoc}
     */
    public function setDataSources($data_sources): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDataSources', [$data_sources]);

        parent::setDataSources($data_sources);
    }

    /**
     * {@inheritDoc}
     */
    public function getTemplate(): \Concrete\Core\Entity\Board\Template
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTemplate', []);

        return parent::getTemplate();
    }

    /**
     * {@inheritDoc}
     */
    public function setTemplate($template): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTemplate', [$template]);

        parent::setTemplate($template);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomSlotTemplates()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomSlotTemplates', []);

        return parent::getCustomSlotTemplates();
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomSlotTemplates($custom_slot_templates)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomSlotTemplates', [$custom_slot_templates]);

        return parent::setCustomSlotTemplates($custom_slot_templates);
    }

    /**
     * {@inheritDoc}
     */
    public function hasCustomSlotTemplates()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasCustomSlotTemplates', []);

        return parent::hasCustomSlotTemplates();
    }

    /**
     * {@inheritDoc}
     */
    public function setHasCustomSlotTemplates($hasCustomSlotTemplates)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHasCustomSlotTemplates', [$hasCustomSlotTemplates]);

        return parent::setHasCustomSlotTemplates($hasCustomSlotTemplates);
    }

    /**
     * {@inheritDoc}
     */
    public function hasCustomWeightingRules()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasCustomWeightingRules', []);

        return parent::hasCustomWeightingRules();
    }

    /**
     * {@inheritDoc}
     */
    public function setHasCustomWeightingRules($hasCustomWeightingRules): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHasCustomWeightingRules', [$hasCustomWeightingRules]);

        parent::setHasCustomWeightingRules($hasCustomWeightingRules);
    }

    /**
     * {@inheritDoc}
     */
    public function getInstances()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInstances', []);

        return parent::getInstances();
    }

    /**
     * {@inheritDoc}
     */
    public function setInstances($instances): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInstances', [$instances]);

        parent::setInstances($instances);
    }

    /**
     * {@inheritDoc}
     */
    public function getSortBy()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSortBy', []);

        return parent::getSortBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setSortBy($sortBy)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSortBy', [$sortBy]);

        return parent::setSortBy($sortBy);
    }

    /**
     * {@inheritDoc}
     */
    public function arePermissionsSetToOverride()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'arePermissionsSetToOverride', []);

        return parent::arePermissionsSetToOverride();
    }

    /**
     * {@inheritDoc}
     */
    public function setOverridePermissions($overridePermissions)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOverridePermissions', [$overridePermissions]);

        return parent::setOverridePermissions($overridePermissions);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionObjectIdentifier()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPermissionObjectIdentifier', []);

        return parent::getPermissionObjectIdentifier();
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionAssignmentClassName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPermissionAssignmentClassName', []);

        return parent::getPermissionAssignmentClassName();
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionObjectKeyCategoryHandle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPermissionObjectKeyCategoryHandle', []);

        return parent::getPermissionObjectKeyCategoryHandle();
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionResponseClassName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPermissionResponseClassName', []);

        return parent::getPermissionResponseClassName();
    }

    /**
     * {@inheritDoc}
     */
    public function setChildPermissionsToOverride()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setChildPermissionsToOverride', []);

        return parent::setChildPermissionsToOverride();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function setPermissionsToOverride()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPermissionsToOverride', []);

        return parent::setPermissionsToOverride();
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'jsonSerialize', []);

        return parent::jsonSerialize();
    }

    /**
     * {@inheritDoc}
     */
    public function getExporter()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getExporter', []);

        return parent::getExporter();
    }

    /**
     * {@inheritDoc}
     */
    public function assignPermissions($userOrGroup, $permissions = [], $accessType = 10, $cascadeToChildren = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'assignPermissions', [$userOrGroup, $permissions, $accessType, $cascadeToChildren]);

        return parent::assignPermissions($userOrGroup, $permissions, $accessType, $cascadeToChildren);
    }

    /**
     * {@inheritDoc}
     */
    public function getPackage()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPackage', []);

        return parent::getPackage();
    }

    /**
     * {@inheritDoc}
     */
    public function setPackage($package)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPackage', [$package]);

        return parent::setPackage($package);
    }

    /**
     * {@inheritDoc}
     */
    public function getPackageID()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPackageID', []);

        return parent::getPackageID();
    }

    /**
     * {@inheritDoc}
     */
    public function getPackageHandle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPackageHandle', []);

        return parent::getPackageHandle();
    }

}
