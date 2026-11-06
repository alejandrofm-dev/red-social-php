<?php
class Like
{
    private int $totalLikes;
    private bool $userHasLiked;

    public function __construct(int $totalLikes, bool $userHasLiked)
    {
        $this->totalLikes = $totalLikes;
        $this->userHasLiked = $userHasLiked;
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
}