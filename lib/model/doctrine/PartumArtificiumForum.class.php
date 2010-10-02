<?php

/**
 * PartumArtificiumForum
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    partum-artificium-server
 * @subpackage model
 * @author     Alex Brandt <alunduil@alunduil.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class PartumArtificiumForum extends BasePartumArtificiumForum
{
  public function getThreadCount()
  {
    return count($this->getThreads());
  }

  public function getEntryCount()
  {
    $count = 0;
    foreach ($this->getThreads() as $thread) {
      $count += count($thread->getEntries());
    }
    return $count;
  }

  public function getLatestEntry()
  {
    $latest_entry = null;
    foreach ($this->getThreads() as $thread) {
      foreach ($thread->getEntries() as $entry) {
        if (is_null($latest_entry)) $latest_entry = $entry;
        $latest_entry = $entry->getCreatedAt() < $latest_entry->getCreatedAt() ? $entry : $latest_entry;
      }
    }
    return $latest_entry;
  }
}
