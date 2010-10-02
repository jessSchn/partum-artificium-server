<?php

/**
 * player actions.
 *
 * @package    partum-artificium-server
 * @subpackage player
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class playerActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->partum_artificium_players = Doctrine::getTable('PartumArtificiumPlayer')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->partum_artificium_player = Doctrine::getTable('PartumArtificiumPlayer')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->partum_artificium_player);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PartumArtificiumPlayerForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PartumArtificiumPlayerForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($partum_artificium_player = Doctrine::getTable('PartumArtificiumPlayer')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_player does not exist (%s).', $request->getParameter('id')));
    $this->form = new PartumArtificiumPlayerForm($partum_artificium_player);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($partum_artificium_player = Doctrine::getTable('PartumArtificiumPlayer')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_player does not exist (%s).', $request->getParameter('id')));
    $this->form = new PartumArtificiumPlayerForm($partum_artificium_player);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($partum_artificium_player = Doctrine::getTable('PartumArtificiumPlayer')->find(array($request->getParameter('id'))), sprintf('Object partum_artificium_player does not exist (%s).', $request->getParameter('id')));
    $partum_artificium_player->delete();

    $this->redirect('player/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $partum_artificium_player = $form->save();

      $this->redirect('player/edit?id='.$partum_artificium_player->getId());
    }
  }
}
