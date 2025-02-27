<h3 class='relTypes'>
	<?= _t("Search %1", $this->getVar('mode_type_plural'))."<br/>\n"; ?>
</h3>
<?php
	$va_search_history = $this->getVar('search_history');
	$vs_cur_search = $this->getVar("last_search");
	if (is_array($va_search_history) && sizeof($va_search_history) > 0) {
?>

<h3 class="tools"><?= _t("History"); ?>:
	<div>
<?php
		print caFormTag($this->request, 'Index', 'caSearchHistoryForm', 'find/SearchObjects', 'post', 'multipart/form-data', '_top', array('noCSRFToken' => true, 'disableUnsavedChangesWarning' => true)); 
		
		print "<select name='search' class='searchHistorySelect'>\n";
		foreach(array_reverse($va_search_history) as $vs_search => $va_search_info) {
			$SELECTED = ($vs_cur_search == $va_search_info['display']) ? 'SELECTED="1"' : '';
			$vs_display = strip_tags($va_search_info['display']);
			
			print "<option value='".htmlspecialchars($vs_search, ENT_QUOTES, 'UTF-8')."' {$SELECTED}>".$vs_display." (".$va_search_info['hits'].")</option>\n";
		}
		print "</select>\n ";
		print caFormSubmitLink($this->request, caNavIcon(__CA_NAV_ICON_GO__, '18px'), 'button', 'caSearchHistoryForm', null, ['aria-label' => _t('Search by history')]);
		print "</form>\n";
?>
	</div>
</h3>
<?php
	}

	$va_saved_searches = $this->request->user->getSavedSearches($this->getVar('table_name'), $this->getVar('find_type'));
?>
<h3 class="tools"><?= _t("Saved searches"); ?>:
	<div>
<?php
		print caFormTag($this->request, 'doSavedSearch', 'caSavedSearchesForm', $this->request->getModulePath().'/'.$this->request->getController(), 'post', 'multipart/form-data', '_top', array('noCSRFToken' => true, 'disableUnsavedChangesWarning' => true)); 
		
		print "<select name='saved_search_key' class='savedSearchSelect'>\n";
		
		if (sizeof($va_saved_searches) > 0) {
			foreach(array_reverse($va_saved_searches) as $vs_key => $va_search) {
				$vs_search = $va_search['_label'];
				$SELECTED = ($vs_cur_search == $vs_search) ? 'SELECTED="1"' : '';
				$vs_display = strip_tags($vs_search);
				
				print "<option value='".htmlspecialchars($vs_key, ENT_QUOTES, 'UTF-8')."' {$SELECTED}>".$vs_display."</option>\n";
			}
		} else {
			print "<option value='' {$SELECTED}>-</option>\n";
		}
		print "</select>\n ";
		print caFormSubmitLink($this->request, caNavIcon(__CA_NAV_ICON_GO__, '18px'), 'button', 'caSearchSetsForm', null, ['aria-label' => _t('Perform saved search')]);
		print "</form>\n";
?>
	</div>
</h3>
