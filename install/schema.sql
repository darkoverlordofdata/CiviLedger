-- +--------------------------------------------------------------------+
-- | CiviCRM version 3.4                                                |
-- +--------------------------------------------------------------------+
-- | Copyright CiviCRM LLC (c) 2004-2011                                |
-- +--------------------------------------------------------------------+
-- | This file is a part of CiviCRM.                                    |
-- |                                                                    |
-- | CiviCRM is free software; you can copy, modify, and distribute it  |
-- | under the terms of the GNU Affero General Public License           |
-- | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
-- |                                                                    |
-- | CiviCRM is distributed in the hope that it will be useful, but     |
-- | WITHOUT ANY WARRANTY; without even the implied warranty of         |
-- | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
-- | See the GNU Affero General Public License for more details.        |
-- |                                                                    |
-- | You should have received a copy of the GNU Affero General Public   |
-- | License and the CiviCRM Licensing Exception along                  |
-- | with this program; if not, contact CiviCRM LLC                     |
-- | at info[AT]civicrm[DOT]org. If you have questions about the        |
-- | GNU Affero General Public License or the licensing of CiviCRM,     |
-- | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
-- +--------------------------------------------------------------------+


-- +--------------------------------------------------------------------+
-- | CiviCRM version 3.4                                                |
-- +--------------------------------------------------------------------+
-- | Copyright CiviCRM LLC (c) 2004-2011                                |
-- +--------------------------------------------------------------------+
-- | This file is a part of CiviCRM.                                    |
-- |                                                                    |
-- | CiviCRM is free software; you can copy, modify, and distribute it  |
-- | under the terms of the GNU Affero General Public License           |
-- | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
-- |                                                                    |
-- | CiviCRM is distributed in the hope that it will be useful, but     |
-- | WITHOUT ANY WARRANTY; without even the implied warranty of         |
-- | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
-- | See the GNU Affero General Public License for more details.        |
-- |                                                                    |
-- | You should have received a copy of the GNU Affero General Public   |
-- | License and the CiviCRM Licensing Exception along                  |
-- | with this program; if not, contact CiviCRM LLC                     |
-- | at info[AT]civicrm[DOT]org. If you have questions about the        |
-- | GNU Affero General Public License or the licensing of CiviCRM,     |
-- | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
-- +--------------------------------------------------------------------+
-- /*******************************************************
-- *
-- * Clean up the exisiting tables
-- *
-- *******************************************************/

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS webzash_entry_items;
DROP TABLE IF EXISTS webzash_entries;
DROP TABLE IF EXISTS webzash_ledgers;
DROP TABLE IF EXISTS webzash_entry_types;
DROP TABLE IF EXISTS webzash_tags;
DROP TABLE IF EXISTS webzash_settings;
DROP TABLE IF EXISTS webzash_logs;
DROP TABLE IF EXISTS webzash_groups;

SET FOREIGN_KEY_CHECKS=1;
-- /*******************************************************
-- *
-- * Create new tables
-- *
-- *******************************************************/


-- /*******************************************************
-- *
-- * webzash_groups
-- *
-- * Ledger Group
-- *
-- *******************************************************/
CREATE TABLE webzash_groups (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Group Id',
     parent_id int unsigned NOT NULL   ,
     name varchar(12) NOT NULL   ,
     affects_gross int unsigned    COMMENT 'Affects Gross' 
,
    PRIMARY KEY ( id )
 
 
 
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

-- /*******************************************************
-- *
-- * webzash_logs
-- *
-- * Ledger Log
-- *
-- *******************************************************/
CREATE TABLE webzash_logs (


     id int unsigned NOT NULL AUTO_INCREMENT  ,
     date date NOT NULL   ,
     level int unsigned NOT NULL   ,
     host_ip varchar(25)    ,
     user varchar(25)    ,
     url varchar(255)    ,
     user_agent varchar(100)    ,
     message_title varchar(255)    ,
     message_desc mediumtext     
,
    PRIMARY KEY ( id )
 
 
 
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

-- /*******************************************************
-- *
-- * webzash_settings
-- *
-- * Ledger Settings
-- *
-- *******************************************************/
CREATE TABLE webzash_settings (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Group Id',
     name varchar(100) NOT NULL   ,
     address varchar(255) NOT NULL   ,
     email varchar(100) NOT NULL   ,
     fy_start date    COMMENT 'Fiscal year start date',
     fy_end date    COMMENT 'Fiscal year end date',
     currency_symbol varchar(10) NOT NULL   ,
     timezone varchar(255) NOT NULL   ,
     manage_inventory int unsigned    COMMENT 'Manage Inventory',
     account_locked int unsigned    COMMENT 'Account Locked',
     email_protocol varchar(9) NOT NULL   ,
     email_host varchar(255) NOT NULL   ,
     email_port int unsigned    COMMENT 'Email Port',
     email_username varchar(255) NOT NULL   ,
     email_password varchar(255) NOT NULL   ,
     print_paper_height double    ,
     print_paper_width double    ,
     print_margin_top double    ,
     print_margin_bottom double    ,
     print_margin_left double    ,
     print_margin_right double    ,
     print_orientation varchar(1) NOT NULL   ,
     print_page_format varchar(1) NOT NULL   ,
     database_version int unsigned     
,
    PRIMARY KEY ( id )
 
 
 
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

-- /*******************************************************
-- *
-- * webzash_tags
-- *
-- * Ledger Tag
-- *
-- *******************************************************/
CREATE TABLE webzash_tags (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Tag Id',
     title varchar(50) NOT NULL   ,
     color varchar(6) NOT NULL   ,
     background varchar(6) NOT NULL    
,
    PRIMARY KEY ( id )
 
 
 
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

-- /*******************************************************
-- *
-- * webzash_entry_types
-- *
-- * Ledger Type
-- *
-- *******************************************************/
CREATE TABLE webzash_entry_types (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Type Id',
     label varchar(15) NOT NULL   ,
     name varchar(100) NOT NULL   ,
     description varchar(255) NOT NULL   ,
     base_type int unsigned NOT NULL   COMMENT 'Base Type',
     numbering int unsigned NOT NULL   COMMENT 'Numbering',
     prefix varchar(10) NOT NULL   ,
     suffix varchar(10) NOT NULL   ,
     zero_padding int unsigned NOT NULL   COMMENT 'Zero Padding',
     bank_cash_ledger_restriction int unsigned NOT NULL   COMMENT 'Restriction' 
,
    PRIMARY KEY ( id )
 
 

-- /*******************************************************
-- *
-- * webzash_ledgers
-- *
-- * Ledger
-- *
-- *******************************************************/
CREATE TABLE webzash_ledgers (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Ledger Id',
     group_id int unsigned NOT NULL   COMMENT 'FK to Group ID',
     name varchar(100) NOT NULL   ,
     op_balance decimal(20,2)    COMMENT 'Opening ledger balance',
     op_balance_dc char(1)    COMMENT 'Opening ledger balance debit or credit (d/c)',
     type int unsigned    COMMENT 'Bank or Cash Account',
     reconciliation int unsigned    COMMENT 'Reconciliation Account' 
,
    PRIMARY KEY ( id )
 
 
,      
     CONSTRAINT FK_webzash_ledgers_group_id FOREIGN KEY (group_id) REFERENCES webzash_groups(id) ON DELETE SET NULL  
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

-- /*******************************************************
-- *
-- * webzash_entries
-- *
-- * Ledger Entries
-- *
-- *******************************************************/
CREATE TABLE webzash_entries (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Entry Id',
     tag_id int unsigned NOT NULL   COMMENT 'FK to Tag ID',
     entry_type int unsigned NOT NULL   COMMENT 'FK to Entry Type',
     number int unsigned    COMMENT 'Entry number',
     date date    COMMENT 'Entry date',
  	 fiscal_year int unsigned NOT NULL,
  	 fiscal_period int unsigned NOT NULL,
     dr_total decimal(20,2)    COMMENT 'Debit total amount',
     cr_total decimal(20,2)    COMMENT 'Credit total amount',
     narration text    COMMENT 'Narration' 
,
    PRIMARY KEY ( id )
 
 
,      
     CONSTRAINT FK_webzash_entries_tag_id FOREIGN KEY (tag_id) REFERENCES webzash_tags(id) ON DELETE SET NULL,      
     CONSTRAINT FK_webzash_entries_entry_type FOREIGN KEY (entry_type) REFERENCES webzash_entry_types(id) ON DELETE SET NULL  
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

-- /*******************************************************
-- *
-- * webzash_entry_items
-- *
-- * Ledger Items
-- *
-- *******************************************************/
CREATE TABLE webzash_entry_items (


     id int unsigned NOT NULL AUTO_INCREMENT  COMMENT 'Entry Id',
     entry_id int unsigned NOT NULL   COMMENT 'FK to Entry',
     ledger_id int unsigned NOT NULL   COMMENT 'FK to Ledger',
     amount decimal(20,2)    COMMENT 'Item amount',
     dc char(1)    COMMENT 'Debit/Credit',
     reconciliation_date date    COMMENT 'Reconciliation Date' 
,
    PRIMARY KEY ( id )
 
 
,      
     CONSTRAINT FK_webzash_entry_items_entry_id FOREIGN KEY (entry_id) REFERENCES webzash_entries(id) ON DELETE SET NULL,      
     CONSTRAINT FK_webzash_entry_items_ledger_id FOREIGN KEY (ledger_id) REFERENCES webzash_ledgers(id) ON DELETE SET NULL  
)  ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci  ;

 