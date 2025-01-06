<?php 

class UserToken extends UserTokenHandler {
    private int $userId;
    private string $hashedAgent;
    private string $lastAddress;
    private string $createdAt;
    private string $expiresAt;
    private string $hashedToken;

    public function __construct(string $userId)
    {
        $this->userId = $userId;
        $this->hashedAgent = hash("sha256", $_SERVER["HTTP_USER_AGENT"]);
        $this->lastAddress = $_SERVER["REMOTE_ADDR"];
        $this->createdAt = (new DateTime())->format('Y-m-d H:i:s');
        $this->expiresAt = (new DateTime('+30 days'))->format('Y-m-d H:i:s');
        $this->hashedToken = $this->generateToken();
    }

    private function generateToken(): string {
        $newToken = bin2hex(random_bytes(32));
        return hash("sha256", $this->setCookie($newToken));
    }

    private function setCookie(string $token): string {
        setcookie("keep", $token, [
            "expires" => (new DateTime('+30 days'))->getTimestamp(),
            "path" => "/",
            "httponly" => true,
            "secure" => false, // Enable with https
            "samesite" => "Strict" // Anti csrf
        ]);
        return $token;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getHashedAgent()
    {
        return $this->hashedAgent;
    }

    public function getLastAddress()
    {
        return $this->lastAddress;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function getHashedToken()
    {
        return $this->hashedToken;
    }
}