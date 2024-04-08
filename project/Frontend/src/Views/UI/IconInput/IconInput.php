<?php

namespace Classes\UI\Input\IconInput;

class IconInputBuilder {
    private $attributes = array();
    private $placeholder;
    private $svgFilename;
    private $typeName;
    private $size;
    private $isLabeled;
    private $isError;
    private $stickyValue;

    public function __construct() {}

    public function setAttributes($attributes) {
        $this->attributes = $attributes;
        return $this;
    }

    public function setPlaceholder($placeholder) {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setSvgFilename($svgFilename) {
        $this->svgFilename = $svgFilename;
        return $this;
    }

    public function setTypeName($typeName) {
        $this->typeName = $typeName;
        return $this;
    }

    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    public function setIsLabeled($isLabeled) {
        $this->isLabeled = $isLabeled;
        return $this;
    }

    public function setIsError($isError) {
        $this->isError = $isError;
        return $this;
    }

    public function setStickyValue($stickyValue) {
        $this->stickyValue = $stickyValue;
        return $this;
    }

    public function build() {
        return new IconInput($this->attributes, $this->placeholder, $this->svgFilename, $this->typeName, $this->size, $this->isLabeled, $this->isError, $this->stickyValue);
    }
}

class IconInputFactory {
    public static function create($attributes = array(), $placeholder, $svgFilename, $typeName, $size = null, $isLabeled = false, $isError = false, $stickyValue = null) {
        return (new IconInputBuilder())
            ->setAttributes($attributes)
            ->setPlaceholder($placeholder)
            ->setSvgFilename($svgFilename)
            ->setTypeName($typeName)
            ->setSize($size)
            ->setIsLabeled($isLabeled)
            ->setIsError($isError)
            ->setStickyValue($stickyValue)
            ->build();
    }
}

class IconInput {
    private $attributes;
    private $placeholder;
    private $svgFilename;
    private $typeName;
    private $size;
    private $isLabeled;
    private $isError;
    private $stickyValue;

    public function __construct($attributes, $placeholder, $svgFilename, $typeName, $size, $isLabeled, $isError, $stickyValue) {
        $this->attributes = $attributes;
        $this->placeholder = $placeholder;
        $this->svgFilename = $svgFilename;
        $this->typeName = $typeName;
        $this->size = $size;
        $this->isLabeled = $isLabeled;
        $this->isError = $isError;
        $this->stickyValue = $stickyValue;
    }

    public function generate() {
        // Set default values if not provided
        if (!$this->stickyValue) {
            $this->stickyValue = '';
        }

        // Path to the SVG icons directory
        $baseIconPath = "public/assets/icons/forms/";

        // Construct SVG path
        $svgPath = $baseIconPath . $this->svgFilename;

        // Set inline styles based on size parameter
        $containerStyle = '';
        $inputStyle = '';
        if ($this->size === 'block-centered') {
            $containerStyle = 'text-align: center;';
        } elseif ($this->size === 'px-width') {
            $inputStyle = 'width: 200px;'; // Adjust the width as needed
        }

        // Set input classes
        $inputClass = "input form-input svg-input";
        if ($this->isError === true) {
            $inputClass .= " error";
        }

        // Generate lowercase placeholder name
        $lowercasePlaceholder = strtolower(str_replace(' ', '_', $this->placeholder));

        // Generate HTML attributes
        $attributesString = '';
        foreach ($this->attributes as $key => $value) {
            $attributesString .= " $key=\"$value\"";
        }
        ?>

        <div class="svg-input-container" style="<?php echo $containerStyle; ?>">
            <?php if ($this->isLabeled): ?>
                <label for="svg-input" style="display: block; margin-bottom: 8px;"><?php echo $this->typeName; ?></label>
            <?php endif; ?>
            <div class="input-wrapper">
                <input value='<?php echo htmlspecialchars($this->stickyValue) ?>' class='<?php echo $inputClass ?>' name="<?php echo $lowercasePlaceholder; ?>" id="svg-input" type="<?php echo $this->typeName; ?>" placeholder="<?php echo $this->placeholder; ?>" style="<?php echo $inputStyle; ?>" required <?php echo $attributesString; ?>>
                <?php
                // Output the SVG icon
                $svgContent = file_get_contents($svgPath);
                echo '<img class="svg-icon" src="' . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . '" alt="SVG Icon">';
                ?>
            </div>
        </div>

        <?php
    }
}

 /*
 *
 *
 *
 *
 *
 *

$attributes = array(
    'name' => 'username',
    'maxlength' => '20'
);

$placeholder = 'Enter your username';
$svgFilename = 'user.svg';
$size = 'px-width';
$isLabeled = true;
$typeName = 'text';

$iconInput = IconInputFactory::create($attributes, $placeholder, $svgFilename, $typeName, $size, $isLabeled);
$iconInput->generate();
 *
 *
 */
