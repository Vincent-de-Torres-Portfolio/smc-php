<?php
/**
 * Generates an SVG input container with specified parameters.
 *
 * @param string $placeholder The placeholder text for the input.
 * @param string $svgFilename The filename of the SVG icon.
 * @param string|null $size (Optional) Size of the input container: 'block-centered', 'px-width', or null (default).
 * @param bool $isLabeled (Optional) Indicates whether the input should have a label. Default is false.
 * @param string $typeName (Optional) The type attribute for the input element. Default is 'text'.
 */
function generateSvgInputContainer($placeholder, $svgFilename, $size = null, $isLabeled = false, $typeName = 'text', $isError=false,$stickyValue=null): void
{
    // Check if CONSTANTS.php is loaded, and load it if not
    if (!defined('FORMS_ICONS_PATH')) {
        require_once 'CONSTANTS.php';
    }

    if (!$stickyValue){
        $stickyValue='';
    }
    // Get BASE ICON path from CONSTANTS.php
    $baseIconPath = FORMS_ICONS_PATH;

    // Construct SVG path
    $svgPath = $baseIconPath . $svgFilename;

    // Set inline styles based on size parameter
    $containerStyle = '';
    $inputStyle = '';
    if ($size === 'block-centered') {
        $containerStyle = 'text-align: center;';
    } elseif ($size === 'px-width') {
        $inputStyle = 'width: 200px;'; // Adjust the width as needed
    }
    if ($isError === true){
        $inputClass = "input form-input svg-input error";
    }else{
        $inputClass = "input form-input svg-input";
    }
    // Generate lowercase placeholder name
    $lowercasePlaceholder = strtolower(str_replace(' ', '_', $placeholder));
    ?>

    <div class="svg-input-container" style="<?php echo $containerStyle; ?>">
        <?php if ($isLabeled): ?>
            <label for="svg-input" style="display: block; margin-bottom: 8px;"><?php echo $typeName; ?></label>
        <?php endif; ?>
        <div class="input-wrapper">
            <input value='<?php echo htmlspecialchars($stickyValue)?>' class='<?php echo $inputClass ?>' name="<?php echo $lowercasePlaceholder; ?>" id="svg-input" type="<?php echo $typeName; ?>" placeholder="<?php echo $placeholder; ?>" style="<?php echo $inputStyle; ?>" required>
            <?php
            // Read the content of the SVG file and add the svg-icon class attribute
            $svgContent = file_get_contents($svgPath);
            echo '<img class="svg-icon" src="' . htmlspecialchars($svgPath, ENT_QUOTES, 'UTF-8') . '" alt="SVG Icon">';
            ?>
        </div>
    </div>

    <?php
}
?>
