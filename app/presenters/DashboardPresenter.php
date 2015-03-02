<?php

namespace App\Presenters;

use App\Model,
	Nette,
	Nette\Application\UI\Form;


class DashboardPresenter extends Nette\Application\UI\Presenter
{
	/** @var Model\Games*/
	private $games;


	public function __construct(Model\Games $games)
	{
		$this->games = $games;
	}


	protected function startup()
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn()) {
			if ($this->getUser()->logoutReason === Nette\Security\IUserStorage::INACTIVITY) {
				$this->flashMessage('You have been signed out due to inactivity. Please sign in again.');
			}
			$this->redirect('Sign:in', array('backlink' => $this->storeRequest()));
		}
	}


	/********************* view default *********************/


	public function renderDefault()
	{
                $this->template->games = $this->games->findAll()
                        ->where('result', 'unfinished')
                        ->order('game_id ASC')
                        ->limit(4);
	}
}
