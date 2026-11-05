<?php

class Post
{
    private int $id;
    private int $authorId;
    private string $caption;
    private string $imageUrl;
    private string $createdAt;
    private Like $likes;
    private array $comments;

    public function __construct(int $id, int $authorId, string $caption, string $imageUrl, string $createdAt)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->caption = $caption;
        $this->imageUrl = $imageUrl;
        $this->createdAt = $createdAt;
        $this->likes = LikeRepository::getLikesByPostId($id);
        $this->comments = CommentRepository::getCommentsByPostId($id);
    }
    // Getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getAuthor(): User
    {
        return UserRepository::getUserById($this->authorId);
    }
    public function getCaption(): string
    {
        return $this->caption;
    }
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getLikes(): Like
    {
        return $this->likes;
    }
    public function getComments(): array
    {
        return $this->comments;
    }

}