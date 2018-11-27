<?php

namespace App\Listener;

use Doctrine\Common\EventSubscriber;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;

class ImageCacheSubscriber implements EventSubscriber
{
	/**
 	* @var CacheManager
 	*/
	private $cacheManager;

	/**
	* @var UploaderHelper
	*/
	private $uploaderHelper;
	
	function __construct(CacheManager $cacheManager, UploaderHelper $uploaderHelper)
	{
		$this->cacheManager = $cacheManager;
		$this->uploaderHelper = $uploaderHelper;
	}

	public function getSubscribedEvents()
	{
		return [
			'preRemove',
			'preUpdate'
		];
	}

	public function preRemove(LifecycleEventArgs $args){
		$entity = $args->getEntity();
		if (!$entity instanceof Articles){
			return;
		}
		$this->$cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));
	}

	public function preUpdate(PreUpdateEventArgs $args){
		$entity = $args->getEntity();
		if (!$entity instanceof Articles){
			return;
		}
		if ($entity->getImageFile() instanceof UploadedFile){
                $this->$cacheManager->remove($this->uploaderHelper->asset($entity,'imageFile'));
        }
	}
}