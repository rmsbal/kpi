<?php

namespace Kanboard\Plugin\KPI\Service;

class ScoreEngine
{
    /**
     * Standard KPI calculation
     */
    public function calculate(float $actual, float $target, float $weight): array
    {
        if ($target <= 0) {
            return [
                'percentage' => 0,
                'weighted_score' => 0,
                'rating' => 'N/A'
            ];
        }

        $percentage = ($actual / $target) * 100;

        // Prevent excessive scores
        $percentage = min($percentage, 120);

        $weighted = ($percentage * $weight) / 100;

        return [
            'percentage' => round($percentage,2),
            'weighted_score' => round($weighted,2),
            'rating' => $this->rating($percentage)
        ];
    }

    protected function rating(float $score): string
    {
        if ($score >= 100) return 'Outstanding';
        if ($score >= 90) return 'Excellent';
        if ($score >= 80) return 'Very Good';
        if ($score >= 70) return 'Good';
        if ($score >= 60) return 'Fair';

        return 'Poor';
    }
}