<?php

namespace App\config;

use App\app\controller\FrontController;
use App\app\controller\BackController;
use App\app\controller\ErrorController;

class Router
{
	private $frontController;
	private $backController;
	private $errorController;

	public function __construct()
	{
		$this->frontController = new FrontController();
		$this->backController = new BackController();
		$this->errorController = new ErrorController();
	}

	/** Set page
	 *
	 */
	public function run()
	{
		try {
			if (isset($_GET['page'])) {
				if ($_GET['page'] === 'admin') {
					if (isset($_SESSION['level']) && $_SESSION['level'] === '2') {
						if (isset($_GET['action'])) {
							if ($_GET['action'] === 'addAccount') {
								$this->backController->addAccount($_POST);
							} else if ($_GET['action'] === 'addEpisode') {
								$this->backController->addEpisode($_POST);
							} else if (isset($_GET['id'])) {
								switch ($_GET['action']) {
									case 'editEpisode':
										$this->backController->editEpisode($_POST);
										break;
									case 'deleteEpisode':
										$this->backController->deleteEpisode($_POST);
										break;
									case 'approveComment':
										$this->backController->approveComment($_POST);
										break;
									case 'deleteComment':
										$this->backController->deleteComment($_POST);
										break;
									case 'editAccount':
										$this->backController->editAccount($_POST);
										break;
									case 'deleteAccount':
										$this->backController->deleteAccount($_POST);
										break;
									default:
										$this->errorController->notFound();
										break;
								}
							} else {
								$this->backController->admin();
							}
						} else {
							$this->backController->admin();
						}
					} else {
						$this->frontController->home();
					}
				} else {
					switch ($_GET['page']) {
						case 'home':
							$this->frontController->home();
							break;
						case 'episodes':
							$this->frontController->episodes();
							break;
						case 'connection':
							$this->frontController->connection($_POST);
							break;
						case 'disconnect':
							$this->frontController->disconnect();
							break;
						default:
							$this->errorController->notFound();
							break;
					}
				}
			} else {
				$this->frontController->home();
			}
		} catch (\Exception $error) {
			$this->errorController->error($error);
		}
	}
}