DROP TABLE IF EXISTS webzash_groups;

CREATE TABLE IF NOT EXISTS webzash_groups (
  id int(11) NOT NULL AUTO_INCREMENT,
  parent_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  affects_gross int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

DROP TABLE IF EXISTS webzash_ledgers;

CREATE TABLE IF NOT EXISTS webzash_ledgers (
  id int(11) NOT NULL AUTO_INCREMENT,
  group_id int(11) NOT NULL,
  name varchar(100) NOT NULL,
  op_balance decimal(15,2) NOT NULL DEFAULT '0.00',
  op_balance_dc char(1) NOT NULL,
  type INT(2) NOT NULL DEFAULT 0,
  reconciliation int(1) NOT NULL,
  form990 varchar(20) NOT NULL,
  form990ez varchar(20) NOT NULL,
  omba122 varchar(20) NOT NULL, 
  PRIMARY KEY (id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;



TRUNCATE TABLE webzash_groups;

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1, 0, 'Assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2, 0, 'Liabilities', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (3, 0, 'Income', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4, 0, 'Expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5, 3, 'Contributions, Support', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (6, 3, 'Earned Revenue', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (7, 3, 'Other Revenue', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (8, 4, 'Expenses - personnel related', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (9, 4, 'Non-personnel related expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (10, 4, 'Non-GAAP expenses', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1000, 1, '1000: Cash', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1100, 1, '1100: Accounts receivable', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1200, 1, '1200: Contributions receivable', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1300, 1, '1300: Other receivables', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1400, 1, '1400: Other assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1500, 1, '1500: Investments', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1600, 1, '1600: Fixed operating assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1700, 1, '1700: Accum deprec - fixed operating assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1800, 1, '1800: Long term assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (1900, 1, '1900: Other long term assets', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2000, 2, '2000: Payables', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2100, 2, '2100: Accrued liabilities', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2300, 2, '2300: Unearned/deferred revenue', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2400, 2, '2400: Advances', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2500, 2, '2500: Short-term notes & loans payable', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2600, 2, '2600: Interest', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2700, 2, '2700: Long-term notes & loans payable', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2800, 2, '2800: Govt-owned', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (2900, 2, '2900: Custodial', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (3000, 2, '3000: Unrestricted net assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (3100, 2, '3100: Temporarily restricted net assets', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (3200, 2, '3200: Permanently restricted net assets', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4000, 5, '4000: Revenue from direct contributions', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4100, 5, '4100: Donated goods & services revenue', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4200, 5, '4200: Revenue from non-government grants', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4300, 5, '4300: Revenue from split-interest agreements', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4400, 5, '4400: Revenue from indirect contributions', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (4500, 5, '4500: Revenue from government grants', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5000, 6, '5000: Revenue from government agencies', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5100, 6, '5100: Revenue from program-related sales & fees', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5200, 6, '5200: Revenue from dues :', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5300, 6, '5300: Revenue from investments', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5400, 6, '5400: Revenue from other sources', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (5800, 6, '5800: Special events', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (6800, 7, '6800: Unrealized gain (loss)', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (6900, 7, '6900: Net assets released from restriction', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (7000, 8, '7000: Grants, contracts, & direct assistance:', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (7200, 8, '7200: Salaries & related expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (7500, 8, '7500: Contract service expenses:', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (8100, 9, '8100: Nonpersonnel expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (8200, 9, '8200: Facility & equipment expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (8300, 9, '8300: Travel & meetings expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (8500, 9, '8500: Other expenses', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (8600, 9, '8600: Business expenses', 0);

INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (9800, 10, '9800: Fixed asset purchases', 0);
INSERT INTO webzash_groups (`id`, `parent_id`, `name`, `affects_gross`) VALUES (9900, 10, '9900: Fixed asset purchases', 0);

TRUNCATE TABLE webzash_ledgers;

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1010, 1000, '1010: Cash in bank-operating', '0.00', 'D', 1, 0, '45', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1020, 1000, '1020: Cash in bank-payroll', '0.00', 'D', 1, 0, '45', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1040, 1000, '1040: Petty cash', '0.00', 'D', 1, 0, '45', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1070, 1000, '1070: Savings & short-term investments', '0.00', 'D', 1, 0, '46', '22', 'n/a');


INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1110, 1100, '1110: Accounts receivable', '0.00', 'D', 1, 0, '47a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1115, 1100, '1115: Doubtful accounts allowance', '0.00', 'D', 1, 0, '47b', '24', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1210, 1200, '1210: Pledges receivable', '0.00', 'D', 1, 0, '48a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1215, 1200, '1215: Doubtful pledges allowance', '0.00', 'D', 1, 0, '48b', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1225, 1200, '1225: Discounts - long-term pledges', '0.00', 'D', 1, 0, '48a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1240, 1200, '1240: Grants receivable', '0.00', 'D', 1, 0, '49', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1245, 1200, '1245: Discounts - long-term grants', '0.00', 'D', 1, 0, '49', '24', 'n/a');


INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1310, 1300, '1310: Employee & trustee receivables', '0.00', 'D', 1, 0, '50', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1320, 1300, '1320: Notes/loans receivable', '0.00', 'D', 1, 0, '51a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1324, 1300, '1324: Doubtful notes/loans allowance', '0.00', 'D', 1, 0, '51b', '24', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1410, 1400, '1410: Inventories for sale', '0.00', 'D', 1, 0, '52', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1420, 1400, '1420: Inventories for use', '0.00', 'D', 1, 0, '52', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1450, 1400, '1450: Prepaid expenses', '0.00', 'D', 1, 0, '53', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1460, 1400, '1460: Accrued revenues', '0.00', 'D', 1, 0, '47a', '24', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1510, 1500, '1510: Marketable securities ', '0.00', 'D', 1, 0, '54', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1530, 1500, '1530: Land held for investment', '0.00', 'D', 1, 0, '55a', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1540, 1500, '1540: Buildings held for investment', '0.00', 'D', 1, 0, '55a', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1545, 1500, '1545: Accum deprec - bldg investment', '0.00', 'D', 1, 0, '55b', '22', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1580, 1500, '1580: Investments - other', '0.00', 'D', 1, 0, '56', '22', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1610, 1600, '1610: Land - operating', '0.00', 'D', 1, 0, '57a', '23', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1620, 1600, '1620: Buildings - operating', '0.00', 'D', 1, 0, '57a', '23', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1630, 1600, '1630: Leasehold improvements', '0.00', 'D', 1, 0, '57a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1640, 1600, '1640: Furniture, fixtures, & equip', '0.00', 'D', 1, 0, '57a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1650, 1600, '1650: Vehicles', '0.00', 'D', 1, 0, '57a', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1660, 1600, '1660: Construction in progress', '0.00', 'D', 1, 0, '57a', '24', 'n/a');
	
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1725, 1700, '1725: Accum deprec - building', '0.00', 'D', 1, 0, '57b', '23', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1735, 1700, '1735: Accum amort - leasehold improvements', '0.00', 'D', 1, 0, '57b', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1745, 1700, '1745: Accum deprec - furn,fix,equip', '0.00', 'D', 1, 0, '57b', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1755, 1700, '1755: Accum deprec - vehicles', '0.00', 'D', 1, 0, '57b', '24', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1810, 1800, '1810: Other long-term assets', '0.00', 'D', 1, 0, '58', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1850, 1800, '1850: Split-interest agreements', '0.00', 'D', 1, 0, '58', '24', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1910, 1900, '1910: Collections - art, etc', '0.00', 'D', 1, 0, '58', '24', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (1950, 1900, '1950: Funds held in trust by others', '0.00', 'D', 1, 0, '58', '24', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2010, 2000, '2010: Accounts payable', '0.00', 'C', 0, 0, '60', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2020, 2000, '2020: Grants & allocations payable', '0.00', 'C', 0, 0, '61', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2110, 2100, '2110: Accrued  payroll', '0.00', 'C', 0, 0, '60', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2120, 2100, '2120: Accrued paid leave', '0.00', 'C', 0, 0, '60', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2130, 2100, '2130: Accrued payroll taxes', '0.00', 'C', 0, 0, '60', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2140, 2100, '2140: Accrued sales taxes', '0.00', 'C', 0, 0, '60', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2150, 2100, '2150: Accrued expenses - other', '0.00', 'C', 0, 0, '60', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2310, 2300, '2310: Deferred contract revenue', '0.00', 'C', 0, 0, '62', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2350, 2300, '2350: Unearned/deferred revenue - other', '0.00', 'C', 0, 0, '62', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2410, 2400, '2410: Refundable advances', '0.00', 'C', 0, 0, '62', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2510, 2500, '2510: Trustee & employee loans payable', '0.00', 'C', 0, 0, '63', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2550, 2500, '2550: Line of credit', '0.00', 'C', 0, 0, '65', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2560, 2500, '2560: Current portion - long-term loan', '0.00', 'C', 0, 0, '65', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2570, 2500, '2570: Short-term liabilities - other', '0.00', 'C', 0, 0, '65', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2610, 2600, '2610: Split-interest liabilities', '0.00', 'C', 0, 0, '65', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2710, 2700, '2710: Bonds payable', '0.00', 'C', 0, 0, '64a', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2730, 2700, '2730: Mortgages payable', '0.00', 'C', 0, 0, '64b', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2750, 2700, '2750: Capital leases', '0.00', 'C', 0, 0, '64b', '26', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2770, 2700, '2770: Long-term liabilities - other', '0.00', 'C', 0, 0, '64a', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2810, 2800, '2810: Govt-owned fixed assets liability', '0.00', 'C', 0, 0, '65', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (2910, 2900, '2910: Custodial funds', '0.00', 'C', 0, 0, '65', '26', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3010, 3000, '3010: Unrestricted net assets', '0.00', 'C', 0, 0, '21 & 67', '21 & 27', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3020, 3000, '3020: Board-designated net assets', '0.00', 'C', 0, 0, '21 & 67', '21 & 27', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3030, 3000, '3030: Board designated quasi-endowment', '0.00', 'C', 0, 0, '21 & 67', '21 & 27', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3040, 3000, '3040: Fixed operating net assets', '0.00', 'C', 0, 0, '21 & 67', '21 & 27', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3110, 3100, '3110: Use restricted net assets', '0.00', 'C', 0, 0, '21 & 68', '21 & 27', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3120, 3100, '3120: Time restricted net assets', '0.00', 'C', 0, 0, '21 & 68', '21 & 27', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (3210, 3200, '3210: Endowment net assets', '0.00', 'C', 0, 0, '21 & 69', '21 & 27', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4010, 4000, '4010: Individual/small business contributions', '0.00', 'C', 0, 0, '1a', '1', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4020, 4000, '4020: Corporate contributions', '0.00', 'C', 0, 0, '1a', '1', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4070, 4000, '4070: Legacies & bequests', '0.00', 'C', 0, 0, '1a', '1', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4075, 4000, '4075: Uncollectible pledges - estimated', '0.00', 'C', 0, 0, 'contra 1a', '1', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4085, 4000, '4085: Long-term pledges discount', '0.00', 'C', 0, 0, 'contra 1a', '1', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4110, 4100, '4110: Donated professional services-GAAP', '0.00', 'C', 0, 0, 'Part IV-A & 82b', 'n/a', 'match/in-kind');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4120, 4100, '4120: Donated other services - non-GAAP', '0.00', 'C', 0, 0, 'Part IV-A & 82b', 'n/a', 'match/in-kind');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4130, 4100, '4130: Donated use of facilities', '0.00', 'C', 0, 0, 'Part IV-A & 82b', 'n/a', 'match/in-kind');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4140, 4100, '4140: Gifts in kind - goods', '0.00', 'C', 0, 0, '1d', '1', 'match/in-kind');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4150, 4100, '4150: Donated art, etc', '0.00', 'C', 0, 0, '1d', '1', 'match/in-kind');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4210, 4200, '4210: Corporate/business grants', '0.00', 'C', 0, 0, '1a', '1', 'match/$');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4230, 4200, '4230: Foundation/trust grants', '0.00', 'C', 0, 0, '1a', '1', 'match/$');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4250, 4200, '4250: Nonprofit organization grants', '0.00', 'C', 0, 0, '1a', '1', 'match/$');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4255, 4200, '4255: Discounts - long-term grants', '0.00', 'C', 0, 0, 'contra 1a', '1', 'match/$');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4310, 4300, '4310: Split-interest agreement contributions', '0.00', 'C', 0, 0, '1a', '1', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4350, 4300, '4350: Gain (loss) split-interest agreements', '0.00', 'C', 0, 0, '20', '1', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4410, 4400, '4410: United Way or CFC contributions', '0.00', 'C', 0, 0, '1b', '1', 'match/$');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4420, 4400, '4420: Affiliated organizations revenue', '0.00', 'C', 0, 0, '1b', '1', 'match/$');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4430, 4400, '4430: Fundraising agencies revenue', '0.00', 'C', 0, 0, '1b', '1', 'match/$');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4510, 4500, '4510: Agency (government) grants', '0.00', 'C', 0, 0, '1c', '1', 'grant/match');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4520, 4500, '4520: Federal grants', '0.00', 'C', 0, 0, '1c', '1', 'grant/match');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4530, 4500, '4530: State grants', '0.00', 'C', 0, 0, '1c', '1', 'grant/match');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (4540, 4500, '4540: Local government grants', '0.00', 'C', 0, 0, '1c', '1', 'grant/match');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5010, 5000, '5010: Agency (government) contracts/fees', '0.00', 'C', 0, 0, '2 & 93(g)', '2', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5020, 5000, '5020: Federal contracts/fees', '0.00', 'C', 0, 0, '2 & 93(g)', '2', 'grant/match');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5030, 5000, '5030: State contracts/fees', '0.00', 'C', 0, 0, '2 & 93(g)', '2', 'grant/match');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5040, 5000, '5040: Local government contracts/fees', '0.00', 'C', 0, 0, '2 & 93(g)', '2', 'grant/match');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5080, 5000, '5080: Medicare/Medicaid payments', '0.00', 'C', 0, 0, '2 & 93f', '2', 'grant/match');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5180, 5100, '5180: Program service fees', '0.00', 'C', 0, 0, '2 & 93(a)', '2', 'match/$');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5185, 5100, '5185: Bad debts, est - program fees ', '0.00', 'C', 0, 0, '2 & 93(a)', '2', 'match/$');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5210, 5200, '5210: Membership dues-individuals', '0.00', 'C', 0, 0, '3 & 94', '3', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5220, 5200, '5220: Assessments and dues-organizations', '0.00', 'C', 0, 0, '3 & 94', '3', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5310, 5300, '5310: Interest-savings/short-term investments', '0.00', 'C', 0, 0, '4 & 95', '4', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5320, 5300, '5320: Dividends & interest - securities', '0.00', 'C', 0, 0, '4 & 96', '4', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5330, 5300, '5330: Real estate rent - debt-financed', '0.00', 'C', 0, 0, '6a & 97a', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5335, 5300, '5335: Real estate rental cost - debt-financed', '0.00', 'C', 0, 0, '6b & 97a', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5340, 5300, '5340: Real estate rent - not debt-financed', '0.00', 'C', 0, 0, '6a & 97b', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5345, 5300, '5345: Real estate rental cost - not debt-financed', '0.00', 'C', 0, 0, '6b & 97b', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5350, 5300, '5350: Personal property rent', '0.00', 'C', 0, 0, '6a & 98', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5355, 5300, '5355: Personal property rental cost', '0.00', 'C', 0, 0, '6b & 98', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5360, 5300, '5360: Other investment income', '0.00', 'C', 0, 0, '7 & 99', '4', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5370, 5300, '5370: Securities sales - gross', '0.00', 'C', 0, 0, '8a-(A) & 100', '5a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5375, 5300, '5375: Securities sales cost ', '0.00', 'C', 0, 0, '8b-(A) & 100', '5b', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5410, 5400, '5410: Non-inventory sales - gross', '0.00', 'C', 0, 0, '8a-(B) & 100', '5a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5415, 5400, '5415: Non-inventory sales cost ', '0.00', 'C', 0, 0, '8b-(B) & 100', '5b', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5440, 5400, '5440: Gross sales - inventory', '0.00', 'C', 0, 0, '10a & 102', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5445, 5400, '5445: Cost of inventory sold ', '0.00', 'C', 0, 0, '10b & 102', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5450, 5400, '5450: Advertising revenue', '0.00', 'C', 0, 0, '11 & 103', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5460, 5400, '5460: Affiliate revenues from other entities', '0.00', 'C', 0, 0, '11 & 103', '8', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5490, 5400, '5490: Misc revenue', '0.00', 'C', 0, 0, '11 & 103', '8', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5810, 5800, '5810: Special events - non-gift revenue', '0.00', 'C', 0, 0, '9a & 101', '6a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (5820, 5800, '5820: Special events - gift revenue', '0.00', 'C', 0, 0, '1a & 9a', '1 & (6a)', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (6810, 6800, '6810: Unrealized gain (loss) - investments', '0.00', 'C', 0, 0, 'Part IV-A', 'n/a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (6820, 6800, '6820: Unrealized gain (loss) - other assets', '0.00', 'C', 0, 0, 'Part IV-A', 'n/a', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (6910, 6900, '6910: Satisfaction of use restriction', '0.00', 'C', 0, 0, 'n/a', 'n/a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (6920, 6900, '6920: LB&E acquisition satisfaction', '0.00', 'C', 0, 0, 'n/a', 'n/a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (6930, 6900, '6930: Time restriction satisfaction', '0.00', 'C', 0, 0, 'n/a', 'n/a', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7010, 7000, '7010: Contracts - program-related', '0.00', 'D', 0, 0, '22', '10', '9');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7020, 7000, '7020: Grants to other organizations', '0.00', 'D', 0, 0, '22', '10', '9, 39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7040, 7000, '7040: Awards & grants - individuals', '0.00', 'D', 0, 0, '22', '10', '39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7050, 7000, '7050: Specific assistance - individuals', '0.00', 'D', 0, 0, '23', '10', '34');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7060, 7000, '7060: Benefits paid to or for members', '0.00', 'D', 0, 0, '24', '11', '34');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7210, 7200, '7210: Officers & directors salaries', '0.00', 'D', 0, 0, '25', '12', '7,32');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7220, 7200, '7220: Salaries & wages - other', '0.00', 'D', 0, 0, '26', '12', '7,32');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7230, 7200, '7230: Pension plan contributions', '0.00', 'D', 0, 0, '27', '12', '7,36');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7240, 7200, '7240: Employee benefits - not pension', '0.00', 'D', 0, 0, '28', '12', '7,13.49');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7250, 7200, '7250: Payroll taxes, etc.', '0.00', 'D', 0, 0, '29', '12', '7');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7510, 7500, '7510: Fundraising fees', '0.00', 'D', 0, 0, '30', '13', '39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7520, 7500, '7520: Accounting fees', '0.00', 'D', 0, 0, '31', '13', '39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7530, 7500, '7530: Legal fees', '0.00', 'D', 0, 0, '32', '13', '39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7540, 7500, '7540: Professional fees - other', '0.00', 'D', 0, 0, '43', '13', '39,44');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7550, 7500, '7550: Temporary help - contract', '0.00', 'D', 0, 0, '43', '13', '39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7580, 7500, '7580: Donated professional services - GAAP', '0.00', 'D', 0, 0, 'Part IV-B, 82b', 'n/a', '12');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (7590, 7500, '7590: Donated other services - non-GAAP', '0.00', 'D', 0, 0, 'Part IV-B, 82b', 'n/a', '12');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8110, 8100, '8110: Supplies', '0.00', 'D', 0, 0, '33', '16', '28');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8120, 8100, '8120: Donated materials & supplies', '0.00', 'D', 0, 0, '33', '16', '12');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8130, 8100, '8130: Telephone & telecommunications', '0.00', 'D', 0, 0, '34', '16', '6');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8140, 8100, '8140: Postage & shipping', '0.00', 'D', 0, 0, '35', '15', '6, 54');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8150, 8100, '8150: Mailing services', '0.00', 'D', 0, 0, '35', '15', '6');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8170, 8100, '8170: Printing & copying', '0.00', 'D', 0, 0, '38', '15', '28, 33, 41');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8180, 8100, '8180: Books, subscriptions, references', '0.00', 'D', 0, 0, '38', '15', '30, 41');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8190, 8100, '8190: In-house publications', '0.00', 'D', 0, 0, '38', '15', '28, 33, 41');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8210, 8200, '8210: Rent, parking, other occupancy', '0.00', 'D', 0, 0, '36', '14', '37, 46');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8220, 8200, '8220: Utilities', '0.00', 'D', 0, 0, '36', '14', '19, 46');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8230, 8200, '8230: Real estate taxes', '0.00', 'D', 0, 0, '36', '14', '51');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8240, 8200, '8240: Personal property taxes', '0.00', 'D', 0, 0, '36', '14', '51');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8250, 8200, '8250: Mortgage interest', '0.00', 'D', 0, 0, '36', '14', '23');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8260, 8200, '8260: Equipment rental & maintenance', '0.00', 'D', 0, 0, '37', '14', '27, 46');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8270, 8200, '8270: Deprec & amort - allowable', '0.00', 'D', 0, 0, '42', '16', '11, 15');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8280, 8200, '8280: Deprec & amort - not allowable', '0.00', 'D', 0, 0, '42', '16', '11, 15');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8290, 8200, '8290: Donated facilities ', '0.00', 'D', 0, 0, 'Part IV-B, 82b', '12', 'n/a');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8310, 8300, '8310: Travel', '0.00', 'D', 0, 0, '39', '16', '44, 45, 55, 56');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8320, 8300, '8320: Conferences, conventions, meetings', '0.00', 'D', 0, 0, '40', '16', '29, 34');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8510, 8500, '8510: Interest-general', '0.00', 'D', 0, 0, '41', '16', '23');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8520, 8500, '8520: Insurance - non-employee related', '0.00', 'D', 0, 0, '43', '16', '5, 22');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8530, 8500, '8530: Membership dues - organization', '0.00', 'D', 0, 0, '43', '16', '30');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8540, 8500, '8540: Staff development', '0.00', 'D', 0, 0, '43', '16', '44, 53');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8550, 8500, '8550: List rental', '0.00', 'D', 0, 0, '43', '16', '23');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8560, 8500, '8560: Outside computer services', '0.00', 'D', 0, 0, '43', '16', '39');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8570, 8500, '8570: Advertising expenses', '0.00', 'D', 0, 0, '43', '16', '1');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8580, 8500, '8580: Contingency provisions', '0.00', 'D', 0, 0, '43', '16', '8');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8590, 8500, '8590: Other expenses', '0.00', 'D', 0, 0, '43', '16', '20, 35, 43');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8610, 8600, '8610: Bad debt expense ', '0.00', 'D', 0, 0, '43', '16', '3');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8620, 8600, '8620: Sales taxes', '0.00', 'D', 0, 0, '43', '16', '51');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8630, 8600, '8630: UBITaxes ', '0.00', 'D', 0, 0, '43', '16', '51');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8650, 8600, '8650: Taxes - other', '0.00', 'D', 0, 0, '43', '16', '51');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8660, 8600, '8660: Fines, penalties, judgments', '0.00', 'D', 0, 0, '43', '16', '10, 16');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (8670, 8600, '8670: Organizational (corp) expenses', '0.00', 'D', 0, 0, '43', '16', '31, 44, 45, 47, 50');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9810, 9800, '9810: Capital purchases - land', '0.00', 'D', 0, 0, 'capitalized', 'capitalized', '11, 15');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9820, 9800, '9820: Capital purchases - building', '0.00', 'D', 0, 0, 'capitalized', 'capitalized', '11, 15, 42');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9830, 9800, '9830: Capital purchases - equipment', '0.00', 'D', 0, 0, 'capitalized', 'capitalized', '11, 15');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9840, 9800, '9840: Capital purchases - vehicles', '0.00', 'D', 0, 0, 'capitalized', 'capitalized', '11, 15');

INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9910, 9900, '9910: Payments to affiliates', '0.00', 'D', 0, 0, '16', '16', '9');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9920, 9900, '9920: Additions to reserves', '0.00', 'D', 0, 0, 'n/a', 'n/a', 'n/a');
INSERT INTO webzash_ledgers (`id`, `group_id`, `name`, `op_balance`, `op_balance_dc`, `type`, `reconciliation`, `form990`, `form990ez`, `omba122`) VALUES (9930, 9900, '9930: Program administration allocations', '0.00', 'D', 0, 0, 'n/a', 'n/a', 'n/a');


