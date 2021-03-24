<?php

namespace App\Services;

use App\Repository\QuoteRepository;
use cebe\markdown\Markdown;

class QuoteService {

    private $parser;
    private $quoteRepo;

    public function __construct(QuoteRepository $quoteRepo, Markdown $parser)
    {
        $this->quoteRepo = $quoteRepo;
        $this->parser = $parser;
    }

    public function getQuotes():array{

        $quotes = $this->quoteRepo->findAll();

        $parseQuotes = [];

        foreach($quotes as $quote){
            $parseQuotes[] = [
                'id' => $quote->getId(),
                'title' => $quote->getTitle(),
                'content' => $this->parser->parse($quote->getContent()),
                'position' =>  $quote->getPosition(),
                'created_at' =>  $quote->getCreatedAt(),
            ];
        }

        return $parseQuotes;
    }

    public function getQuote($id):array{

        $quote = $this->quoteRepo->findBy(['id'=>$id])[0];

        $parseQuote = [
            'id' => $quote->getId(),
            'title' => $quote->getTitle(),
            'content' => $this->parser->parse($quote->getContent()),
            'position' =>  $quote->getPosition(),
            'created_at' =>  $quote->getCreatedAt(),
        ];


        return $parseQuote;
    }

}