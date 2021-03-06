<?php

/**
 * cotisants actions.
 *
 * @package    simde
 * @subpackage cotisants
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cotisantsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    if($login = $request->getParameter("login")){
      try {
        $ginger = new Ginger(sfConfig::get('app_portail_ginger_key'));
        $this->cotisant = $ginger->getUser($login);
        $this->cotisations = $ginger->getCotisations($login);
      }
      catch (ApiException $ex){
        if($ex->getCode() == 404){
          $this->error = "Utilisateur non trouvé";
        }
        else {
          $this->error = $ex->getCode()." - ".$ex->getMessage();
        }
      }
      
      
      $this->formcotisation = new CotisantsCotiserForm();
      $this->formcotisation->setDefault('login', $login);
      
      if($this->cotisant->is_cotisant){
        $this->cotisant->is_cotisant_texte = "Oui";
        
        // On retire le champ montant
        $this->formcotisation->hideMontant();
      }
      else {
        $this->cotisant->is_cotisant_texte = "Non";
      }
        
    }
  }
  
  public function executeCotisation(sfWebRequest $request) {
    if($login = $request->getParameter("login")){
      if($request->getParameter("type") == "Cotiser"){
        $debut = date("Y-m-d");
        
        $yearend = date("Y");
        if(date("m") > 8){
          $yearend++;
        }
        $fin = "$yearend-08-31";
        
        $montant = intval($request->getParameter("montant"));
        
        try {
          $ginger = new Ginger(sfConfig::get('app_portail_ginger_key'));
          $ginger->addCotisation($login, $debut, $fin, $montant);
        }
        catch (ApiException $ex){
          $this->getUser()->setFlash('error', "Impossible d'enregistrer la cotisation : ".$this->error = $ex->getCode()." - ".$ex->getMessage());
        }
      }
      else if($request->getParameter("type") == "Radier"){
        //TODO
        $this->getUser()->setFlash('error', "Fonctionnalité indisponible");
      }
    }
    $this->redirect('cotisants/edit?login='.$login);
  }
}
