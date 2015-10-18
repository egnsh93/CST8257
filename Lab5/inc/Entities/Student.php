<?php

class Student {
	protected $username;
	protected $phone;
	protected $postal;
	protected $password;
	protected $courses;

    /**
     * Initializes a student with:
     * username
     * phone
     * postal code
     * password
     * list of courses
     */
	public function __construct($username, $phone, $postal, $password, $courses)
	{
		$this->username = $username;
		$this->phone = $phone;
		$this->postal = $postal;
		$this->password = $password;
		$this->courses = $courses;
	}

    /**
     * Gets the value of username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Gets the value of phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Gets the value of postal.
     *
     * @return string
     */
    public function getPostal()
    {
        return $this->postal;
    }

    /**
     * Gets the value of password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Gets the value of courses.
     *
     * @return array
     */
    public function getCourses()
    {
        return $this->courses;
    }
}

?>