<?php
class Post extends PostHandler {
    private int $id;
    private int $authorId;
    private int $message;
    private string $createdAt;

    public function __construct(int $authorId, string $message, int $id = -1, string $createdAt = '')
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->message = $message;
        $this->createdAt = $createdAt ? $createdAt : date(DATE_ATOM);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}