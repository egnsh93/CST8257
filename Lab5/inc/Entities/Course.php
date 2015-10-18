<?php

class Course {
	protected $id;
	protected $name;
	protected $hours;

    /**
     * Initializes a course with an id, name, and weekly hours
     */
	public function __construct($id, $name, $hours)
	{
		$this->id = $id;
		$this->name = $name;
		$this->hours = $hours;
	}

    /**
     * Gets the value of id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the value of name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the value of hours.
     *
     * @return string
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Appends a course id, name and hours into a single string
     * 
     * @return string
     */
    public function toString() {
        return $this->getId() . " " . $this->getName() . " " . $this->getHours() . " hrs/w";
    }
}

?>