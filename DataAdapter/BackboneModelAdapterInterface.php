<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */
namespace Accurateweb\BackboneApplicationBundle\DataAdapter;

/**
 * Backbone.Model adapter interface
 *
 * @package Accurateweb\BackboneApplicationBundle\DataAdapter
 */
interface BackboneModelAdapterInterface
{
  /**
   * Returns Backbone.Model name to be associated with
   *
   * @return string
   */
  public function getModelName();

  /**
   * Returns Backbone.Model Id as defined in idAttribute
   *
   * @return mixed
   */
  public function getModelId();

  /**
   * Returns an array of attributes to be passed to Backbone.Model instance
   *
   * @return array
   */
  public function getModelAttributes();
}