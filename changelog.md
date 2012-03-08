CiviLedger Version 0.1 - 2/15 thru 3/5/2012
---
* Fork Webzash 1.5
* Import UCOA Chart of Accounts version 3, using account# value for row ID's.
* Converted to CodeIgniter 2.10 library
* Integrate with CiviCRM as a 'bolt-on'
	* remove headers and footers from templates
	* map redirects to civicrm uri requests
	* update civicrm tables:
		* civicrm component
		* civicrm navigation
	* rebuild menu from CRM/Ledger/xml/Menu
	* use the logged on Joomla user as the Webzash user
	* use the Joomla default database  
* various UI tweaks
	* for new fields
	* right align numeric columns on reports
	* add links to Dashboard page
* Add fiscal calendar:
	* settings start and end dates now refer to account, not year.
	* table webzash calendar
	* library class Fiscalcalendar
	* Calendar model
	* Add posting period to ledger entries
	* admin/calendar transaction paths: 
		* open	 - open period
		* close	 - close period
		* create - create calendar 
		* delete - delete calendar
		* index	 - list calendar

CiviLedger Version 0.1.1 - 3/7 
---
* Add UCOA reporting fields to table webzash_ledgers
* Add new fields & id to ui: group/add, group/edit, ledger/add, ledger/edit 
* Fix - printpreview version of balancesheet - group amounts not in bold
* Change jQuery references to '$' to 'cj' compatability version used in Joomla