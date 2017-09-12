<?php
/**
 * Copyright (c) 2017. Denis N. Ragozin <dragozin@accurateweb.ru>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Accurateweb\BackboneApplicationBundle\Twig;

use Accurateweb\BackboneApplicationBundle\DataAdapter\BackboneCollectionAdapter;
use Accurateweb\BackboneApplicationBundle\DataAdapter\BackboneModelAdapterInterface;

/**
 * BackboneApplicationExtension
 *
 * @package Accurateweb\BackboneApplicationBundle\Twig
 */
class BackboneApplicationExtension extends \Twig_Extension
{
  public function getFunctions()
  {
    return array(
      new \Twig_SimpleFunction(
        'model',
        array($this, 'getClientModel'),
        array('is_safe' => array('html'))
      ),
      new \Twig_SimpleFunction(
        'collection',
        array($this, 'getClientModelCollection'),
        array('is_safe' => array('html'))
      )
    );
  }

  public function getClientModel(BackboneModelAdapterInterface $model)
  {
    $script = sprintf(<<<EOF
<script type="text/javascript">
    if ('undefined' === typeof ObjectCache) {
      ObjectCache = {};
    }
    ObjectCache['%s'] = %s;
</script>  
EOF
,
    $model->getModelName(),
    json_encode($model->getModelAttributes())
    );

    return $script;
  }

  public function getClientModelCollection($collectionName, BackboneCollectionAdapter $modelCollection)
  {
    $script = sprintf(<<<EOF
<script type="text/javascript">
    if ('undefined' === typeof ObjectCache) {
      ObjectCache = {};
    }
    ObjectCache['%s'] = %s;
</script>  
EOF
      ,
      $collectionName,
      $modelCollection->serialize()
    );

    return $script;
  }

  public function getName()
  {
    return 'backbone';
  }
}