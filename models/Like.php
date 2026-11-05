<?php
class Like
{
    private int $totalLikes;
    private bool $userHasLiked;
    private string $heart;
    private string $emptyheart;

    public function __construct(int $totalLikes, bool $userHasLiked)
    {
        $this->totalLikes = $totalLikes;
        $this->userHasLiked = $userHasLiked;
        $this->heart = "♥";
        $this->emptyheart = "♡";
    }

    // Getters
    public function getTotalLikes(): int
    {
        return $this->totalLikes;
    }

    public function getUserHasLiked(): bool
    {
        return $this->userHasLiked;
    }

    public function getIconLiked(): string
    {
        return $this->userHasLiked ? $this->heart : $this->emptyheart;
    }
}