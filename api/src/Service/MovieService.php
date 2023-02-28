<?php

namespace App\Service;

use App\Repository\MoviesRepository;

class MovieService 
{
    private MoviesRepository $moviesRepository;

    public function __construct(MoviesRepository $moviesRepository)
    {
        $this->moviesRepository = $moviesRepository;
    }


}