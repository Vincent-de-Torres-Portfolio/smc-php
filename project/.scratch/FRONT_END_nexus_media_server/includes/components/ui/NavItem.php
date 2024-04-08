<?
require_once '../helper/Sanitize.php';
/**
 * NavItem class for representing a navigation item.
 *
 * This class provides a simple way to create and render a navigation item.
 * Each NavItem object has a label, a URL, and an icon.
 *
 * Example usage:
 * $navItem = new NavItem('Home', '/home', 'home-icon.png');  // Create a new NavItem object
 * echo $navItem->render();  // Render the navigation item
 */

class NavItem {
    private $label;
    private $url;
    private $icon;

    /**
     * Constructs a new NavItem object.
     *
     * @param string $label The label of the navigation item.
     * @param string $url The URL of the navigation item.
     * @param string $icon The icon of the navigation item.
     */
    
     public function __construct($label, $url, $icon) {
        // Sanitize and validate the label
        $this->label = Sanitize::sanitize($label, 'string');
        
        if (empty($this->label)) {
            throw new InvalidArgumentException('Label cannot be empty');
        }
    
        // Sanitize and validate the URL
        $this->url = Sanitize::sanitize($url, 'url');
        if (empty($this->url) || !filter_var($this->url, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException('Invalid URL');
        }
    
        // Sanitize the icon
        $this->icon = Sanitize::sanitize($icon, 'string');
        if (empty($this->icon)) {
            throw new InvalidArgumentException('Icon cannot be empty');
        }
    }
    /**
     * Renders the navigation item as HTML.
     *
     * This method returns a string of HTML that represents the navigation item.
     * The returned HTML includes a list item element that contains a link element.
     * The link element in turn contains an image element and the label of the navigation item.
     *
     * @return string The HTML string of the navigation item.
     */
    public function render() {
        if (empty($this->label) || empty($this->url) || empty($this->icon)) {
            throw new RuntimeException('NavItem is not properly initialized');
        }

        return '<li class="side-menu-item"><a href="' . $this->url . '"><img src="' . $this->icon . '" alt="' . $this->label . ' Icon">' . $this->label . '</a></li>';
    }
}