<?php
namespace Omea\GestionTelco\EvenementsBundle\EventManager;

use Omea\GestionTelco\EvenementsBundle\EvenementManager\Handler\EvenementHandlerInterface;
use Omea\GestionTelco\EvenementsBundle\EvenementManager\EvenementInterface;

/**
 * Orchestarteur des événements
 */
class EvenementManager
{
	private $handlers;


	public function __construct()
	{
		$this->handlers = new \ArrayIterator();
	}

	public function addHandler(EvenementHandlerInterface $handler)
	{
		$this->handlers->append($handler);
	}

	public function handle(EvenementInterface $event)
	{
		$accepted = false;
		$handlers = $this->handlers;
		$eventCode = $event->getCode();

		// Trouver un gestionnaire capable de prendre en compte l'événement
		while($handlers->valid() && false === $accepted) {

			if ($handlers->current()->accept($eventCode) === false  ) {
				$handlers->next();
			} else {
				$accepted = true;
			}

		}

		if ($accepted === true) {
			$handlers->current()->handle($event);
		} else {
			throw new \Exception(sprintf(
				"Cannot handle event %s with code %s",
				get_class($event),
				$eventCode
			));
		}
	}
}