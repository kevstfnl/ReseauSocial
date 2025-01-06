<?php
class Review {
    private int $id;
    private int $userId;
    private int $postId;
    private bool $positive;

    public function __construct(int $userId, int $postId, bool $positive, int $id = -1)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->positive = $positive;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getPostId()
    {
        return $this->postId;
    }

    public function getPositive()
    {
        return $this->positive;
    }

    public function setPositive($positive)
    {
        $this->positive = $positive;

        return $this;
    }
}