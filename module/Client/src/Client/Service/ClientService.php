<?php
namespace Client\Service;

use Doctrine\ORM\EntityManager;

class ClientService extends AbstractService
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->em = $em;
    }

    /**
     * @param array $data
     * @param bool $flush
     * @return mixed
     * @throws \Doctrine\DBAL\ConnectionException
     * @throws \Exception
     */
    public function store(array $data, $flush = true)
    {

        //verificando o email
        $email = $this->em->getRepository('Client\Entity\Client')->findOneByClientEmail($data['client_email']);
        if ($email) {
            throw new \Exception("Já existe um cadastro com o e-mail '{$email->getClientEmail()}'");
        }

        //verificando o CPF
        $cpf = $this->em->getRepository('Client\Entity\Client')->findOneByClientCpf(str_replace(".", "", str_replace("-", "", $data['client_cpf'])));
        if ($cpf) {
            throw new \Exception("Já existe um cadastro com o cpf '{$data['client_cpf']}'");
        }

        //inciando a transação
        $this->em->getConnection()->beginTransaction();

        try {

            $this->entity = 'Client\Entity\User';
            $data['user_username'] = $data['client_email'];
            $data['user_status'] = 0;
            $user = parent::store($data, false);

            $this->entity = 'Client\Entity\Client';
            $data['user'] = $user;
            $client = parent::store($data, false);

            $this->em->flush();
            $this->em->getConnection()->commit();

            //TODO implementar o envio do e-mail depois do cadastro

            return $client;

        } catch (\Exception $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }

    }
}