<?php

    $html = '<div id="myElement">Original text</div>';

    // Create a DOMDocument object
    $dom = new DOMDocument();
    @$dom->loadHTML($html); // @ suppresses warnings for malformed HTML

    // Find element by ID
    $element = $dom->getElementById('myElement');

    if ($element) {
        // Get text content (similar to innerText)
        $textContent = $element->textContent;
        echo "Current content: " . $textContent . "\n";
        
        // Set new text content (similar to innerText = ...)
        $element->textContent = "skap";
        
        // Save the modified HTML
        $modifiedHtml = $dom->saveHTML();
        echo $modifiedHtml;
    } else {
        echo "Element not found";
}

?>