<?php

class Container
{
    private $configuration;

    private $pdo;

    private $taak;

    public function __construct(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPDO()
    {
        if ($this->pdo === null) {
            $this->pdo = new PDO(
                $this->configuration['dbdsn'],
                $this->configuration['dbuser'],
                $this->configuration['dbpasswd']
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    /**
     * @return ApiActions
     */
    public function getApiActions()
    {
       if ($this->taak === null) $this->taak = new ApiActions($this->getPDO());
       return $this->taak;
    }


}
