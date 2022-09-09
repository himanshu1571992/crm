<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-08 15:53:21 --> Query error: Unknown column 'r.approved_status' in 'where clause' - Invalid query: SELECT * from tblrequests where r.approved_status = 1 and r.receive_status != 2 and r.category IN (1,2,3,4) and r.date > '2020-10-31'  and r.payfile_done = '0'  order by id desc
