<?php
namespace Omea\GestionTelco\EvenementsBundle\EvenementManager\Handler;

/**
 * Prise en charge des événements FairUse
 *
 * @author hlataoui
 */
class AntiFraudeHandler implements EvenementHandlerInterface
{
        /** 
	 * @return boolean indique si le handler accept
	 */
	public function accept($eventCode)
        {
            return 'CODEANTIFRAUDEICI;)' === $eventCode;
        }

	/**
	 * Prise en charhe de l'événement
	 * 
	 * @param  EventInterface $event
	 * @return void
	 */
	public function handle(EventInterface $event)
        {
            // prise en charge
        }
}

