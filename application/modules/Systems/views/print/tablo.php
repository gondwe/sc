<?php

$data = $_SESSION['tablePrint'];

echo '<img src="'.base_url('assets/imgs/XLS6.PNG').'" alt="" srcset="">';

table($data, "table-striped table-bordered");
