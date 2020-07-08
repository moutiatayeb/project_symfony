<?php

namespace App\service;
use App\Repository\CondidatRepository;
use App\Repository\QuestionRepository;
use Doctrine\DBAL\Driver\Connection;

class ResultService
{
    private $condidatRepository;
    private $questionRepository;

    public function __construct(CondidatRepository $condidatRepository, QuestionRepository $questionRepository)
    {
        $this->condidatRepository = $condidatRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Finds all countries
     */
    public function CalculeResult()
    {
        return '80';
    }
}