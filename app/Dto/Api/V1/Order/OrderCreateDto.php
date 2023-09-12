<?php
namespace App\Dto\Api\V1\Order;

final class OrderCreateDto
{
    protected string $user_name;
    protected string $phone;
    protected string $provider;
    protected string $city;
    protected string $department;
    protected int $payment;
    protected ?string $delivery_address;
    protected ?string $comment;
    protected ?string $email;

    /**
     * OrderCreateDto constructor.
     * @param string $user_name
     * @param string $phone
     * @param string $provider
     * @param string $city
     * @param string $department
     * @param int $payment
     * @param string|null $delivery_address
     * @param string|null $comment
     * @param string|null $email
     */
    public function __construct(string $user_name, string $phone, string $provider, string $city, string $department, int $payment, ?string $delivery_address, ?string $comment, ?string $email)
    {
        $this->user_name = $user_name;
        $this->phone = $phone;
        $this->provider = $provider;
        $this->city = $city;
        $this->department = $department;
        $this->payment = $payment;
        $this->delivery_address = $delivery_address;
        $this->comment = $comment;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getProvider(): string
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @return int
     */
    public function getPayment(): int
    {
        return $this->payment;
    }

    /**
     * @return string|null
     */
    public function getDeliveryAddress(): ?string
    {
        return $this->delivery_address;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
}
