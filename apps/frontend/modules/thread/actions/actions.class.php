<?php

/**
 * thread actions.
 *
 * @package    partum-artificium-server
 * @subpackage thread
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class threadActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partum_artificium_forum_threads = Doctrine::getTable('PartumArtificiumForumThread')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->partum_artificium_forum_thread = Doctrine::getTable('PartumArtificiumForumThread')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->partum_artificium_forum_thread);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PartumArtificiumForumThreadForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PartumArtificiumForumThreadForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($partum_artificium_forum_thread = Doctrine::getTable('PartumArtificiumForumThread')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_forum_thread does not exist (%s).', $request->getParameter('id')));
    $this->form = new PartumArtificiumForumThreadForm($partum_artificium_forum_thread);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($partum_artificium_forum_thread = Doctrine::getTable('PartumArtificiumForumThread')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_forum_thread does not exist (%s).', $request->getParameter('id')));
    $this->form = new PartumArtificiumForumThreadForm($partum_artificium_forum_thread);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($partum_artificium_forum_thread = Doctrine::getTable('PartumArtificiumForumThread')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_forum_thread does not exist (%s).', $request->getParameter('id')));
    $partum_artificium_forum_thread->delete();

    $this->redirect('thread/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $partum_artificium_forum_thread = $form->save();

      $this->redirect('thread/edit?id='.$partum_artificium_forum_thread->getId());
    }
  }
}
