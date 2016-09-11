/* Conversion Menu */

/**
 * Highlight Menu Item
 * @param string itemID The ID of the item to highlight
 */
function highlight(itemID)
  {
  $("#"+itemID).css("background", "limegreen");
  }

/**
 * Unhighlight Menu Item
 * @param string itemID The ID of the item to remove highlight
 */
function unhighlight(itemID)
  {
  $("#"+itemID).css("background", "");
  }
