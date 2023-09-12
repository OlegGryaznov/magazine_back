<?php


namespace App\Dto\Api\V1\Order;


final class GuestOrderCreateDto
{
    protected string $user_name;
    protected string $phone;
    protected string $provider;
    protected string $city;
    protected string $department;
    protected array $products;
    protected int $payment;
    protected ?string $delivery_address;
    protected ?string $email;
    protected ?string $comment;

    /**
     * GuestOrderCreateDto constructor.
     * @param string $user_name
     * @param string $phone
     * @param string $provider
     * @param string $city
     * @param string $department
     * @param array $products
     * @param int $payment
     * @param string|null $delivery_address
     * @param string|null $email
     * @param string|null $comment
     */
    public function __construct(string $user_name, string $phone, string $provider, string $city, string $department, array $products, int $payment, ?string $delivery_address, ?string $email, ?string $comment)
    {
        $this->user_name = $user_name;
        $this->phone = $phone;
        $this->provider = $provider;
        $this->city = $city;
        $this->department = $department;
        $this->products = $products;
        $this->payment = $payment;
        $this->delivery_address = $delivery_address;
        $this->email = $email;
        $this->comment = $comment;
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
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
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
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }
}
