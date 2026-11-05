<?php
class Comment
{
    private int $id;
    private int $authorId;
    private string $comment;
    private string $createdAt;

    public function __construct(int $id, int $authorId, string $comment, string $createdAt)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->comment = $comment;
        $this->createdAt = $createdAt;
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
    public function getComment(): string
    {
        return $this->comment;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}