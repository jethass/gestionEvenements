<?php
namespace Omea\GestionTelco\PatesBundle\Manager;

use Doctrine\ORM\EntityManager;
use Omea\Domain\Main\Article;
use Omea\Domain\Main\Commandes;
use Omea\Domain\Main\Transaction;
use Omea\Domain\Main\TransactionSap;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrderManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * The entity manager must have access to MAIN_VM database !
     *
     * @param EntityManager $em
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * Create an order
     *
     * @param integer $clientId (= ID_CLIENT)
     * @param integer $distributorId (= ID_DIS)
     * @param integer $providerId (= ID_MAG)
     * @param integer $articleId (= ID_ART)
     * @param boolean $isReady (= TRANS_TRAITE)
     *
     * @return boolean
     * @throws NotFoundHttpException
     */
    public function create($clientId, $distributorId, $providerId, $articleId, $isReady)
    {
        // Check the clientId
        $client = $this->getClient($clientId);

        // Check the distributorId and the providerId
        $distributor = $this->getDistributor($distributorId, $providerId);

        // Check the stockMsisdn
        $stockMsisdn = $this->getStockMsisdn($clientId);

        // Check the articleId
        $FemtoArticle = $this->getArticle($articleId);
        $article = $this->getArticle($stockMsisdn->getIdArt());

        // Check the forfait
        $forfait = $this->getForfait($article);

        // Create the transaction
        $transaction = new Transaction();
        $transaction->setClient($client);
        $transaction->setDistributeur($distributor);
        $transaction->setMontantTotal($FemtoArticle->getMontant());
        $transaction->setDateTrans(new \DateTime());

        if ($isReady) {
            $transaction->setTransTraite(new \DateTime());
        }

        $transaction->setNomLiv($client->getNom());
        $transaction->setPrenomLiv($client->getPrenom());
        $transaction->setCiviliteLiv($client->getCivilite());
        $transaction->setAdrLiv($client->getAdresse());
        $transaction->setNumeroRue($client->getNumeroRue());
        $transaction->setAdrComplLiv($client->getAdresseComplement());
        $transaction->setCodposLiv($client->getCodePos());
        $transaction->setVilleLiv($client->getVille());

        $this->em->persist($transaction);
        $this->em->flush();

        // Create the transactionSAP
        $transactionSAP = new TransactionSap();
        $transactionSAP->setTransaction($transaction);
        $sapNivSubOffre = $this->em->getRepository('Omea\Domain\Main\SapNivSubOffre')->find($forfait->getIdNivSub());
        $transactionSAP->setSapNivSubOffre($sapNivSubOffre);
        $sapHierarchieOffre = $this->em->getRepository('Omea\Domain\Main\SapHierarchieOffre')->find($forfait->getIdHierOffre());
        $transactionSAP->setSapHierarchieOffre($sapHierarchieOffre);
        $transactionSAP->setIsTraiteSap(0);
        $transactionSAP->setIsValideSap(0);
        $transactionSAP->setIsTraite(0);

        $this->em->persist($transactionSAP);
        $this->em->flush();

        // Create the order
        $order = new Commandes();
        $order->setTransaction($transaction);
        $order->setArticle($FemtoArticle);
        $order->setPrixFacture($FemtoArticle->getMontant());

        $this->em->persist($order);
        $this->em->flush($order);

        return $transaction;
    }

    /**
     * Get a Client by it's id
     *
     * @param integer $clientId
     * @return object Client
     * @throws NotFoundHttpException
     */
    private function getClient($clientId)
    {
        $client = $this->em->getRepository('Omea\Domain\Main\Client')->find($clientId);

        if (!$client) {
            throw new \LogicException('Client not found');
        }

        return $client;
    }

    /**
     * Get a Distributeurs by a idDis and idMag
     *
     * @param integer $distributorId
     * @param integer $providerId
     * @return object Distributeurs
     * @throws NotFoundHttpException
     */
    private function getDistributor($distributorId, $providerId)
    {
        $distributor = $this->em->getRepository('Omea\Domain\Main\Distributeurs')->findOneBy(
            array(
                'idDis' => $distributorId,
                'idMag' => $providerId
            )
        );

        if (!$distributor) {
            throw new \LogicException('Distributor not found');
        }

        return $distributor;
    }

    /**
     * Get a StockMsisdn by a clientId
     *
     * @param integer $clientId
     * @return object
     * @throws NotFoundHttpException
     */
    private function getStockMsisdn($clientId)
    {
        $stockMsisdn = $this->em->getRepository('Omea\Domain\Main\StockMsisdn')->findOneBy(
            array(
                'idClient' => $clientId
            )
        );

        if (!$stockMsisdn) {
            throw new \LogicException('Stock Msisdn not found');
        }

        return $stockMsisdn;
    }

    /**
     * Get an Article by it's id
     *
     * @param integer $articleId
     * @return object Article
     * @throws NotFoundHttpException
     */
    private function getArticle($articleId)
    {
        $article = $this->em->getRepository('Omea\Domain\Main\Article')->find($articleId);

        if (!$article) {
            throw new \LogicException('Article not found');
        }

        return $article;
    }

    /**
     * Get a Forfait by an Article
     *
     * @param Article $article
     * @return object Forfait
     * @throws NotFoundHttpException
     */
    private function getForfait(Article $article)
    {
        $forfaits = $article->getForfait();
        if (!$forfaits || !$forfaits->first()) {
            throw new \LogicException('Forfait not found');
        }
        return $forfaits->first();
    }
}
