<?php

namespace App\Config;

enum MessageState: string
{
    case New = 'NEW';
    case Read = 'READ';
    case Answered = 'ANSWERED';
}