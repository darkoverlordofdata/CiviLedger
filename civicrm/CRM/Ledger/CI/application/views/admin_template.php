<?php
/*
+--------------------------------------------------------------------+
| CiviLedger version 0.1
+--------------------------------------------------------------------+
| Copyright DarkOverlordOfData (c) 2012
+--------------------------------------------------------------------+
|                                                                    |
| This file is a part of CiviLedger.                                 |
|                                                                    |
| CiviLedger is free software; you can copy, modify, and distribute  |
| it under the terms of the GNU General Public License Version 3     |
|                                                                    |
+--------------------------------------------------------------------+
*/
/**
 * 
 * @package Ledger
 * @copyright DarkOverlordOfData (c) 2012
 *
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$doc = JFactory::getDocument();

$doc->addStyleSheet(asset_url() . 'css/style.css');
$doc->addStyleSheet(asset_url() . 'css/tables.css');
$doc->addStyleSheet(asset_url() . 'css/custom.css');
$doc->addStyleSheet(asset_url() . 'css/menu.css');
$doc->addStyleSheet(asset_url() . 'css/jquery.datepick.css');
$doc->addStyleSheet(asset_url() . 'css/thickbox.css');

$doc->addScript(asset_url() . 'js/jquery.min.js">');
$doc->addScript(asset_url() . 'js/jquery.datepick.js');
$doc->addScript(asset_url() . 'js/custom.js');
$doc->addScript(asset_url() . 'js/hoverIntent.js');
$doc->addScript(asset_url() . 'js/superfish.js');
$doc->addScript(asset_url() . 'js/supersubs.js');
$doc->addScript(asset_url() . 'js/thickbox-compressed.js');
$doc->addScript(asset_url() . 'js/ezpz_tooltip.min.js');
$doc->addScript(asset_url() . 'js/shortcutslibrary.js');
$doc->addScript(asset_url() . 'js/shortcuts.js');

$doc->addScriptDeclaration('var jsSiteUrl = "' . asset_url() . '"; ');

$doc->addScriptDeclaration(<<<JAVASCRIPT
/* Loading JQuery Superfish menu */
$(document).ready(function(){ 
    $("ul.sf-menu").supersubs({ 
        minWidth:12,
        maxWidth:27,
        extraWidth: 1
    }).superfish(); // call supersubs first, then superfish, so that subs are 
});
JAVASCRIPT
);

?><div id="container">
    <div id="content">
        <div id="sidebar">
            <?php if (isset($page_sidebar)) echo $page_sidebar; ?>
        </div>
        <div id="main">
            <?php if (isset($nav_links)) {
                echo "<div id=\"main-links\">";
                echo "<ul id=\"main-links-nav\">";
                foreach ($nav_links as $link => $title) {
                    if ($title == "Print Preview")
                        echo "<li>" . anchor_popup($link, $title, array('title' => $title, 'class' => 'nav-links-item', 'style' => 'background-image:url(\'' . asset_url() . 'images/buttons/navlink.png\');', 'width' => '1024')) . "</li>";
                    else
                        echo "<li>" . anchor($link, $title, array('title' => $title, 'class' => 'nav-links-item', 'style' => 'background-image:url(\'' . asset_url() . 'images/buttons/navlink.png\');')) . "</li>";
                }
                echo "</ul>";
                echo "</div>";
            } ?>
            <div class="clear">
            </div>
            <div id="main-content">
                <?php echo $contents; ?>
                <?php
                $messages = $this->messages->get();
                if (is_array($messages))
                {
                    if (count($messages['success']) > 0)
                    {
                        echo "<div id=\"success-box\">";
                        echo "<ul>";
                        foreach ($messages['success'] as $message) {
                            echo ('<li>' . $message . '</li>');
                        }
                        echo "</ul>";
                        echo "</div>";
                    }
                    if (count($messages['error']) > 0)
                    {
                        echo "<div id=\"error-box\">";
                        echo "<ul>";
                        foreach ($messages['error'] as $message) {
                            if (substr($message, 0, 4) == "<li>")
                                echo ($message);
                            else
                                echo ('<li>' . $message . '</li>');
                        }
                        echo "</ul>";
                        echo "</div>";
                    }
                    if (count($messages['message']) > 0)
                    {
                        echo "<div id=\"message-box\">";
                        echo "<ul>";
                        foreach ($messages['message'] as $message) {
                            echo ('<li>' . $message . '</li>');
                        }
                        echo "</ul>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div id="footer">
    <?php if (isset($page_footer)) echo $page_footer ?>
    <!--<a href="http://webzash.org" target="_blank">Webzash<a/> is licensed under <a href="http://www.gnu.org/licenses/agpl-3.0.txt" target="_blank">GNU Affero General Public License, version 3</a> as published by the Free Software Foundation.-->
</div>
