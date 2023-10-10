<?php
  
namespace App\Enums;
 
enum BookingStatus:string {
    case Open = 'open';
    case Close = 'close';
    case Pendig = 'pending';
}
