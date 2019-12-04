<?php


namespace Wog\Model;


class UserModel implements \JsonSerializable
{
    /**
     * @var string
     */
    private $email,
        /**
         * @var string
         */
        $password,
        /**
         * @var string
         */
        $surname,
        /**
         * @var string
         */
        $first_Name,
        /**
         * @var string
         */
        $last_Name,
        /**
         * @var string
         */
        $phone,
        /**
         * @var string
         */
        $adress,
        /**
         * @var string
         */
        $city,
        /**
         * @var string
         */
        $zip,
        /**
         * @var string
         */
        $token;

    function __construct(\stdClass $data =null)
    {
        if (null === $data) {
            return;
        }
        foreach ($this as $key => $value) {
            if (property_exists($data, $key)) {
                $this->$key = $data->$key;
            }
        }
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return string
     */
    public function setEmail(string $email): string
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return string
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return string
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->first_Name;
    }

    /**
     * @param string $first_Name
     * @return string
     */
    public function setFirstName(string $first_Name): self
    {
        $this->first_Name = $first_Name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->last_Name;
    }

    /**
     * @param string $last_Name
     * @return string
     */
    public function setLastName(string $last_Name): self
    {
        $this->last_Name = $last_Name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return string
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     * @return string
     */
    public function setAdress(string $adress): self
    {
        $this->adress = $adress;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return string
     */
    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return string
     */
    public function setZip(string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return string
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
    }


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [

            "Email" => $this->email,
            "Surname" => $this->surname,
            "Firstname" => array_key_exists("first_Name", $this) ? $this->first_Name : $this->first_name,
            "Lastname" => array_key_exists("last_Name", $this) ? $this->last_Name : $this->last_name,
            "Phone" => $this->phone,
            "Adresse" => $this->adress,
            "City " => $this->city,
            "Zip Code" => $this->zip
        ];
    }
}