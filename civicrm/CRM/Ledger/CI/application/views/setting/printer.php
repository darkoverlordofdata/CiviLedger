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

	echo form_open('setting/printer');

    echo '<div id="left-col">';
	echo "<p>";
	echo form_fieldset('Paper Size', array('class' => "fieldset-auto-width"));

	echo "<p>";
	echo form_label('Height', 'paper_height');
	echo " ";
	echo form_input($paper_height);
	echo " inches";
	echo "</p>";

	echo "<p>";
	echo "&nbsp;";
	echo form_label('Width', 'paper_width');
	echo " ";
	echo form_input($paper_width);
	echo " inches";
	echo "</p>";

	echo form_fieldset_close();
	echo "</p>";

	echo "<p>";
	echo form_fieldset('Paper Margin', array('class' => "fieldset-auto-width"));

	echo "<p>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo form_label('Top', 'margin_top');
	echo " ";
	echo form_input($margin_top);
	echo " inches";
	echo "</p>";

	echo "<p>";
	echo form_label('Bottom', 'margin_bottom');
	echo " ";
	echo form_input($margin_bottom);
	echo " inches";
	echo "</p>";

	echo "<p>";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo form_label('Left', 'margin_left');
	echo " ";
	echo form_input($margin_left);
	echo " inches";
	echo "</p>";

	echo "<p>";
	echo "&nbsp;&nbsp;&nbsp;";
	echo form_label('Right', 'margin_right');
	echo " ";
	echo form_input($margin_right);
	echo " inches";
	echo "</p>";

	echo form_fieldset_close();
	echo "</p>";
    echo "<p>";
    echo form_submit('submit', 'Update');
    echo " ";
    echo anchor('setting', 'Back', array('title' => 'Back to settings'));
    echo "</p>";
    

    echo '</div>';
    echo '<div id="right-col">';
	echo "<p>";
	echo form_fieldset('Orientation', array('class' => "fieldset-auto-width"));

	echo "<p>";
	echo form_radio($orientation_potrait);
	echo " Potrait";
	echo form_radio($orientation_landscape);
	echo " Landscape";
	echo "</p>";

	echo form_fieldset_close();
	echo "</p>";

	echo "<p>";
	echo form_fieldset('Output Format', array('class' => "fieldset-auto-width"));

	echo "<p>";
	echo form_radio($output_format_html);
	echo " HTML";
	echo form_radio($output_format_text);
	echo " Text";
	echo "</p>";

	echo form_fieldset_close();
	echo "</p>";

    echo '</div>';

	echo form_close();

