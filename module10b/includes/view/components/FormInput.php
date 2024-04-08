<?php
/**
 * Generates an SVG input container with specified parameters.
 *
 * @param string $placeholder The placeholder text for the input.
 * @param string $svgFilename The filename of the SVG icon.
 * @param string|null $size (Optional) Size of the input container: 'block-centered', 'px-width', or null (default).
 * @param bool $isLabeled (Optional) Indicates whether the input should have a label. Default is false.
 * @param string $typeName (Optional) The type attribute for the input element. Default is 'text'.
 * @param bool $isError (Optional) Indicates whether the input is in an error state. Default is false.
 * @param string|null $stickyValue (Optional) The sticky value for the input. Default is null.
 */
function generateInput($placeholder, $inputId, $name = null, $classPrefix = 'form'): string
{
    // Generate lowercase name from placeholder, replacing spaces and special characters with underscores
    $name = $name ?: strtolower(preg_replace('/[^a-zA-Z0-9]+/', '_', $placeholder));

    $html = '<input class="' . $classPrefix . '-input ' . $classPrefix . '-input" id="' . $inputId . '" type="text" name="' . $name . '" placeholder="' . htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8') . '">';

    return $html;
}

function generateRadioGroup($labelText, $inputId, $name, $options, $classPrefix = 'form'): string
{
    $html = '<label class="' . $classPrefix . '-label ' . $classPrefix . '-label" for="' . $inputId . '">' . $labelText . '</label>';
    $html .= '<div id="' . $inputId . '" class="' . $classPrefix . '-radio-group">';

    foreach ($options as $option) {
        $html .= '<span>';
        $html .= '<input class="' . $classPrefix . '-radio ' . $classPrefix . '-radio" type="radio" name="' . $name . '" value="' . htmlspecialchars($option['value'], ENT_QUOTES, 'UTF-8') . '">' . $option['label'];
        $html .= '</span>';
    }

    $html .= '</div>';

    return $html;
}

?>

