<?php

namespace App\Data;

use App\Entity\Card;
use App\Entity\CardType;

class SearchData
{
    /**
     * @var string
     */
    public $q = '' ;

    /**
     * @var CardType
     */
    public $type;

    /**
     * @var Card
     */
    public $attribute;

    /**
     * @var Card
     */
    public $race;

    /**
     * @var Card
     */
    public $archetype;

    /**
     * @var Card
     */
    public $level;

    /**
     * @var Card
     */
    public $banlist_info;

    /**
     * @var string
     */
    public $order = '';
    /**
     * @var int
     */
    public $limit = 50;
}