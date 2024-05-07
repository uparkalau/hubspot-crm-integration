<?php
/**
 * InputFieldDefinition
 *
 * PHP version 5
 *
 * @category Class
 * @package  HubSpot\Client\Automation\Actions
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Custom Workflow Actions
 *
 * Create custom workflow actions
 *
 * The version of the OpenAPI document: v4
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace HubSpot\Client\Automation\Actions\Model;

use \ArrayAccess;
use \HubSpot\Client\Automation\Actions\ObjectSerializer;

/**
 * InputFieldDefinition Class Doc Comment
 *
 * @category Class
 * @description Configuration for an input field on the custom action
 * @package  HubSpot\Client\Automation\Actions
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class InputFieldDefinition implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'InputFieldDefinition';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'type_definition' => '\HubSpot\Client\Automation\Actions\Model\FieldTypeDefinition',
        'supported_value_types' => 'string[]',
        'is_required' => 'bool'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPIFormats = [
        'type_definition' => null,
        'supported_value_types' => null,
        'is_required' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'type_definition' => 'typeDefinition',
        'supported_value_types' => 'supportedValueTypes',
        'is_required' => 'isRequired'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'type_definition' => 'setTypeDefinition',
        'supported_value_types' => 'setSupportedValueTypes',
        'is_required' => 'setIsRequired'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'type_definition' => 'getTypeDefinition',
        'supported_value_types' => 'getSupportedValueTypes',
        'is_required' => 'getIsRequired'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const SUPPORTED_VALUE_TYPES_STATIC_VALUE = 'STATIC_VALUE';
    const SUPPORTED_VALUE_TYPES_OBJECT_PROPERTY = 'OBJECT_PROPERTY';
    const SUPPORTED_VALUE_TYPES_FIELD_DATA = 'FIELD_DATA';
    

    
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSupportedValueTypesAllowableValues()
    {
        return [
            self::SUPPORTED_VALUE_TYPES_STATIC_VALUE,
            self::SUPPORTED_VALUE_TYPES_OBJECT_PROPERTY,
            self::SUPPORTED_VALUE_TYPES_FIELD_DATA,
        ];
    }
    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['type_definition'] = isset($data['type_definition']) ? $data['type_definition'] : null;
        $this->container['supported_value_types'] = isset($data['supported_value_types']) ? $data['supported_value_types'] : null;
        $this->container['is_required'] = isset($data['is_required']) ? $data['is_required'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['type_definition'] === null) {
            $invalidProperties[] = "'type_definition' can't be null";
        }
        if ($this->container['is_required'] === null) {
            $invalidProperties[] = "'is_required' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets type_definition
     *
     * @return \HubSpot\Client\Automation\Actions\Model\FieldTypeDefinition
     */
    public function getTypeDefinition()
    {
        return $this->container['type_definition'];
    }

    /**
     * Sets type_definition
     *
     * @param \HubSpot\Client\Automation\Actions\Model\FieldTypeDefinition $type_definition type_definition
     *
     * @return $this
     */
    public function setTypeDefinition($type_definition)
    {
        $this->container['type_definition'] = $type_definition;

        return $this;
    }

    /**
     * Gets supported_value_types
     *
     * @return string[]|null
     */
    public function getSupportedValueTypes()
    {
        return $this->container['supported_value_types'];
    }

    /**
     * Sets supported_value_types
     *
     * @param string[]|null $supported_value_types Controls what kind of input a customer can use to specify the field value. Must contain exactly one of `STATIC_VALUE` or `OBJECT_PROPERTY`. If `STATIC_VALUE`, the customer will be able to choose a value when configuring the custom action; if `OBJECT_PROPERTY`, the customer will be able to choose a property from the enrolled workflow object that the field value will be copied from. In the future we may support more than one input control type here.
     *
     * @return $this
     */
    public function setSupportedValueTypes($supported_value_types)
    {
        $allowedValues = $this->getSupportedValueTypesAllowableValues();
        if (!is_null($supported_value_types) && array_diff($supported_value_types, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'supported_value_types', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['supported_value_types'] = $supported_value_types;

        return $this;
    }

    /**
     * Gets is_required
     *
     * @return bool
     */
    public function getIsRequired()
    {
        return $this->container['is_required'];
    }

    /**
     * Sets is_required
     *
     * @param bool $is_required Whether the field is required for the custom action to be valid
     *
     * @return $this
     */
    public function setIsRequired($is_required)
    {
        $this->container['is_required'] = $is_required;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}

