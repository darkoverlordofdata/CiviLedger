USE joomla;

INSERT INTO civicrm_component
	(name,namespace)
VALUES 
	("CiviLedger","CRM_Ledger");

SELECT @domain_id := id FROM civicrm_domain where name = 'Default Domain Name';

INSERT INTO civicrm_navigation 
	(domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES     
    (@domain_id,"Ledger","Ledger",NULL,"access CiviLedger","OR",NULL,1,NULL,90);
SET @ledger_id:=LAST_INSERT_ID();


INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Dashboard","Dashboard","civicrm/ledger&reset=1","access CiviMember","OR",@ledger_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (domain_id,"Entries","Entries","","access CiviMember","OR",@ledger_id,1,NULL,1);
SET @entries_id:=LAST_INSERT_ID();


INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"All","All Entries","civicrm/ledger/entry/show/all&reset=1","access CiviMember","OR",@entries_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Receipts","Receipt Entries","civicrm/ledger/entry/show/receipt&reset=1","access CiviMember","OR",@entries_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Payments","Payment Entries","civicrm/ledger/entry/show/payment&reset=1","access CiviMember","OR",@entries_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Journals","Journal Entries","civicrm/ledger/entry/show/journal&reset=1","access CiviMember","OR",@entries_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Contras","Contra Entries","civicrm/ledger/entry/show/contra&reset=1","access CiviMember","OR",@entries_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Reports","Reports","civicrm/ledger/report&reset=1","access CiviMember","OR",@ledger_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Settings","Settings","civicrm/ledger/setting&reset=1","access CiviMember","OR",@ledger_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Administer","Administer","civicrm/ledger/admin&reset=1","access CiviMember","OR",@ledger_id,1,NULL,1);

INSERT INTO civicrm_navigation
    (domain_id,label,name,url,permission,permission_operator,parent_id,is_active,has_separator,weight)
VALUES    
    (@domain_id,"Help","Help","civicrm/ntledger/help&reset=1","access CiviMember","OR",@ledger_id,1,NULL,1);

--
--	Fiscal Calendar
--
DROP TABLE IF EXISTS `webzash_ledger_calendar`;

CREATE TABLE `webzash_ledger_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `opened` int(1) NOT NULL DEFAULT '0',
  `closed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

