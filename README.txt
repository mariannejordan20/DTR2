// Logic pag iisang login form lang ang user at admin
Bale need mo magkaroon sa database mo ng magdedetermine whether they're admin or user then if the certain condition is met like nag-eexist si account and tama ang pass, i-header mo nalang then sa page na pagdadalhan is maglagay ka ng restriction as always para di maaccess esp. ni user.

// LINK NG CORS UNBLOCK
https://chrome.google.com/webstore/detail/cors-unblock/lfhmikememgdcahcdlaciloancbhjino/related?hl=en

// INNER JOIN
SELECT `employee_log`.`Employee_ID`, `employee_information`.`Employee_FullName`, `employee_information`.`Employee_FullName`,  `employee_log`.`Employee_Date`
FROM `employee_log`
INNER JOIN `employee_information` ON `employee_information`.`Employee_ID` = `employee_log`.`Employee_ID`