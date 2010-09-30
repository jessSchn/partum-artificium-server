<?php

/**
 * forum actions.
 *
 * @package    partum-artificium-server
 * @subpackage forum
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class forumActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partum_artificium_forums = Doctrine::getTable('PartumArtificiumForum')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $q = Doctrine_Query::create()
      ->from('PartumArtificiumForum f')
      ->where('f.slug = ?', $request->getParameter('forum_slug'));

    $this->partum_artificium_forum = $q->fetchOne();
    $this->partum_artificium_threads = $this->partum_artificium_forum->getPartumArtificiumForumThread();
    $this->forward404Unless($this->partum_artificium_forum);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PartumArtificiumForumForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PartumArtificiumForumForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($partum_artificium_forum = Doctrine::getTable('PartumArtificiumForum')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_forum does not exist (%s).', $request->getParameter('id')));
    $this->form = new PartumArtificiumForumForm($partum_artificium_forum);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($partum_artificium_forum = Doctrine::getTable('PartumArtificiumForum')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_forum does not exist (%s).', $request->getParameter('id')));
    $this->form = new PartumArtificiumForumForm($partum_artificium_forum);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($partum_artificium_forum = Doctrine::getTable('PartumArtificiumForum')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_forum does not exist (%s).', $request->getParameter('id')));
    $partum_artificium_forum->delete();

    $this->redirect('forum/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $partum_artificium_forum = $form->save();

      $this->redirect('forum/edit?id='.$partum_artificium_forum->getId());
    }
  }
}
