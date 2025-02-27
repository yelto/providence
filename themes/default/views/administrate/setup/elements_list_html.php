<?php
/* ----------------------------------------------------------------------
 * app/views/admin/access/elements_list_html.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2009-2016 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */

$va_element_list = $this->getVar('element_list');
$va_attribute_types = $this->getVar('attribute_types');
?>
<script language="JavaScript" type="text/javascript">
/* <![CDATA[ */
	$(document).ready(function(){
		$('#caItemList').caFormatListTable();
	});
/* ]]> */
</script>
<div class="sectionBox">
	<?php
		print caFormControlBox(
			'<div class="list-filter">'._t('Filter').': <input type="text" name="filter" value="" onkeyup="$(\'#caItemList\').caFilterTable(this.value); return false;" size="20"/></div>',
			'',
			caNavHeaderButton($this->request, __CA_NAV_ICON_ADD__, _t("New"), 'administrate/setup', 'Elements', 'Edit', array('element_id' => 0))
		);
	?>

	<table id="caItemList" class="listtable">
		<thead>
		<tr>
			<th>
				<?php _p('Label'); ?>
			</th>
			<th>
				<?php _p('Element code'); ?>
			</th>
			<th>
				<?php _p('Type'); ?>
			</th>
			<th>
				<?php _p('Applies to'); ?>
			</th>
			<th>
				<?php _p('Usage in UI'); ?>
			</th>
			<th class="{sorter: false} list-header-nosort listtableEdit"> </th>
		</tr>
		</thead>
		<tbody>
<?php
	foreach($va_element_list as $va_element) {
?>
		<tr>
			<td>
				<?= $va_element['display_label']; ?>
			</td>
			<td>
				<?= $va_element['element_code']; ?>
			</td>
			<td>
				<?= $va_attribute_types[$va_element['datatype']]; ?>
			</td>
			<td>
<?php
	if (is_array($va_element['restrictions']) && sizeof($va_element['restrictions'])) {
?>
				<table>
<?php
		foreach($va_element['restrictions'] as $vs_table => $va_type_list) {
			foreach($va_type_list as $vn_type_id => $vs_type_name) {
				print ucfirst($vs_table)." [{$vs_type_name}]<br/>\n";
			}
		}
?>
				</table>
<?php
	}
?>
			</td>
			<td>
<?php
	if (is_array($va_element['ui_counts']) && sizeof($va_element['ui_counts'])) {
?>
				<table>
<?php
		foreach($va_element['ui_counts'] as $vs_table => $vn_count) {
			print ucfirst($vs_table)." ({$vn_count})<br/>\n";
		}
?>
				</table>
<?php
	}
?>
			</td>
			<td class="listtableEditDelete">
				<?= caNavButton($this->request, __CA_NAV_ICON_EDIT__, _t("Edit"), 'editIcon', 'administrate/setup', 'Elements', 'Edit', array('element_id' => $va_element['element_id']), array(), array('icon_position' => __CA_NAV_ICON_ICON_POS_LEFT__, 'use_class' => 'list-button', 'no_background' => true, 'dont_show_content' => true)); ?>
				<?= caNavButton($this->request, __CA_NAV_ICON_DELETE__, _t("Delete"), 'deleteIcon', 'administrate/setup', 'Elements', 'Delete', array('element_id' => $va_element['element_id']), array(), array('icon_position' => __CA_NAV_ICON_ICON_POS_LEFT__, 'use_class' => 'list-button', 'no_background' => true, 'dont_show_content' => true)); ?>
			
			</td>
		</tr>
<?php
		TooltipManager::add('.editIcon', _t("Edit"));
	}
?>
		</tbody>
	</table>
</div>
<div class="editorBottomPadding"><!-- empty --></div>
