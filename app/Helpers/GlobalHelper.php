<?php

namespace App\Helpers;

class GlobalHelper
{
    /**
     * Get the number of reviews of a product.
     *
     * @param \App\Models\Product $product The product to get the number of reviews for.
     * @return int The number of reviews of the product.
     */
    static function productReviewCount($product)
    {
        return $product->reviews->count();
    }

    /**
     * Display rating stars and count in a span element.
     *
     * @param float $rating The product rating.
     * @param int $reviews The number of product reviews.
     * @return string The HTML element containing the rating.
     */
    static function displayReviewStars($rating, $reviews)
    {
        $stars = '';
        $fullStars = floor($rating);
        $halfStar = $rating - $fullStars >= 0.5;

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                $stars .= '<i class="bi bi-star-fill"></i>';
            } elseif ($halfStar && $i == $fullStars + 1) {
                $stars .= '<i class="bi bi-star-half"></i>';
                $halfStar = false;
            } else {
                $stars .= '<i class="bi bi-star"></i>';
            }
        }

        return '<small class="text-warning">' . $stars . '</small> <span class="text-muted small">' . $rating . '(' . $reviews . ')</span>';
    }
}
