<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Accurateweb\BackboneApplicationBundle\DataAdapter;

/**
 * A data adapter for Backbone.Collection
 *
 * @package AccurateCommerce\DataAdapter
 */
class BackboneCollectionAdapter implements \Iterator
{
  private $objects = array();

  /**
   * Append a model to the collection
   *
   * @param BackboneModelAdapterInterface $object A Backbone.Model adapter instance to append
   */
  public function append(BackboneModelAdapterInterface $object)
  {
    $this->objects[] = $object;
  }

  /**
   * Returns TRUE if collection is empty, FALSE otherwise
   *
   * @return bool
   */
  public function isEmpty()
  {
    return empty($this->objects);
  }

  /**
   * Converts collection to array
   *
   * @return array
   */
  public function toArray()
  {
    $values = array();
    foreach ($this->objects as $object)
    {
      /**
       * @var $object BackboneModelAdapterInterface
       */
      $values[] = $object->getModelAttributes();
    }

    return $values;
  }
  
  /**
   * 
   * @param BackboneModelAdapterInterface[] $models
   *
   * @return BackboneCollectionAdapter
   */
  public static function createFromModelArray($models)
  {
    $collection = new BackboneCollectionAdapter();
    
    foreach ($models as $model)
    {
      $collection->append($model);
    }
    
    return $collection;
  }

  /**
   * @inheritdoc
   */
  public function current()
  {
    return current($this->objects);
  }

  /**
   * @inheritdoc
   */
  public function key()
  {
    return key($this->objects);
  }

  /**
   * @inheritdoc
   */
  public function next()
  {
    return next($this->objects);
  }

  /**
   * @inheritdoc
   */
  public function rewind()
  {
    return reset($this->objects);
  }

  /**
   * @inheritdoc
   */
  public function valid()
  {
    return null !== key($this->objects);
  }

  /**
   * Create a Backbone.Collection adapter using a specified Backbone.Model adapter for each
   * given item
   *
   * @param array|\Iterator $objects
   * @param String $adapterClass Adapter class FQCN
   * 
   * @return BackboneCollectionAdapter
   */
  public static function createAdaptedCollection($objects, $adapterClass)
  {
    $collection = new BackboneCollectionAdapter();
    
    foreach ($objects as $model)
    {
      $collection->append(new $adapterClass($model));
    }
    
    return $collection;
  }

  /**
   * Serializes collection to JSON compatible to be passed to Backbone.Collection constructor
   *
   * @return string Collection data as JSON string
   */
  public function serialize()
  {
    return sprintf('%s', json_encode($this->toArray()));
  }
}
