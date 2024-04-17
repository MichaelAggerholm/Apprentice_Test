<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart
{
    // TODO: test før brug af denne, da Stripe ser ud til at omregne fra cents
//    public function centsToPrice($cents) {
//        return number_format($cents / 100, 2);
//    }

    public static function unitPrice($item) {
        return $item['book']['price'] * $item['quantity'];
    }

    public static function totalAmount() {
        $total = 0;

        if (session()->has('cart')) {
            foreach (session('cart') as $item) {
                $total += self::unitPrice($item);
            }
        }

        return $total;
    }
}
