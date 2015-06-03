<?php
namespace Omea\GestionTelco\EvenementsBundle\EvenementManager\Handler;

interface EvenementHandlerInterface
{
	/** 
	 * @return boolean indique si le handler accept
	 */
	public function accept($eventCode);

	/**
	 * Prise en charhe de l'événement
	 * 
	 * @param  EventInterface $event
	 * @return void
	 */
	public function handle(EventInterface $event); 
}

