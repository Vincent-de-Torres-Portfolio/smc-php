<?php

/*
 * Q: Explain the class BaseContact.
 * Class BaseContact is an abstract class defining the blueprint for contact objects.
 * It contains abstract methods get_name() and set_name($name) to get and set the name of the contact, respectively.
 * It also has a public property $phone_number to store the phone number of the contact.
 * The __toString() method is implemented to return the name and phone number of the contact if available.
 */

abstract class BaseContact
{
    abstract public function get_name();

    abstract public function set_name($name);

    public $phone_number;

    public function __toString()
    {
        $s = '';
        $s .= $this->get_name();
        if ($this->phone_number) {
            if (strlen($s) > 0) {
                $s .= ": ";
            } else {
                $s .= "Someone's Phone Number: ";
            }
            $s .= $this->phone_number;
        }
        return $s;
    }
}

/*
 * Q: What is an extends class ?
 * 'extends' is a keyword in PHP used to create a child class that inherits properties and methods from a parent class.
 */

class PersonContact extends BaseContact
{
    public $first_name;
    public $last_name;

    public function __construct($first_name = null, $last_name = null)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function get_name()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function set_name($name)
    {
        $split_name = explode(" ", $name, 2);
        $length = count($split_name);
        $rv = true;
        if ($length === 0) {
            $rv = false;
        } elseif ($length === 1) {
            $this->first_name = $this->last_name = $split_name[0];
        } else {
            $this->first_name = $split_name[0];
            $this->last_name = $split_name[1];
        }
        return $rv;
    }
}





class OrganizationContact extends BaseContact
{
    public $name;

    /*
 * What is the construct for?
 * The constructor (__construct()) method is used to initialize the object's properties upon instantiation.
 * In the case of PersonContact class, it initializes the first_name and last_name properties.
 */
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /*
 * What does the get and set methods do?
 * The get_name() method retrieves the name of the contact, while the set_name($name) method sets the name of the contact.
 *
 */

    public function get_name()
    {
        return $this->name;
    }

    public function set_name($name)
    {
        $this->name = $name;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Object Oriented Programming - Simple Class</title>
</head>
<body>
<strong>Person Contact, Empty Constructor, Two Names</strong> <br>
<?php
// Example of using the "new" keyword
$angelo = new PersonContact;
$angelo->set_name("Angelo Roncalli");
$angelo->phone_number = "777-777-7777";
?>
<p><?php print $angelo ?></p>

<strong>Person Contact, Empty Constructor, Three Names</strong> <br>
<?php
$john = new PersonContact;
$john->set_name("John Giuseppe Roncalli");
$john->phone_number = "777-777-7777";
?>
<p><?php print $john ?></p>

<strong>Person Contact, Parameterized Constructor</strong> <br>
<?php
$mary = new PersonContact("Mary", "Roncalli");
$mary->phone_number = "777-777-7777";
?>
<p><?php print $mary ?></p>

<strong>Organization Contact, Empty Constructor</strong> <br>
<?php
$parish = new OrganizationContact;
$parish->set_name("Parish");
$parish->phone_number = "777-777-7777";
?>
<p><?php print $parish ?></p>

<strong>Organization Contact, Parameterized Constructor</strong> <br>
<?php
$parish = new OrganizationContact("Parish");
$parish->phone_number = "777-777-7777";
?>
<p><?php print $parish ?></p>
</body>
</html>
