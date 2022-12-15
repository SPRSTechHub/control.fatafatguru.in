<?
date_default_timezone_set('Asia/Kolkata');
$totalUsers = $this->home->searchQuery('SELECT * FROM `tbl_users` WHERE `status` = 0');
$totalUsers = !empty($totalUsers) ? $totalUsers->num_rows() : '';
$totalreferals = $this->home->searchQuery('SELECT * FROM `tbl_referal` WHERE `refer_status` = 1');
$totalreferals = !empty($totalreferals) ? $totalreferals->num_rows() : '';
$totaldepAmount = $this->home->searchQuery("SELECT SUM(`amount`) AS DAmount FROM `tbl_wallet` WHERE `trtype` = 'credit' AND `trdetails` NOT LIKE 'win_amount'");
if ($totaldepAmount) {
    $totaldepAmount = ($totaldepAmount->row()->DAmount != null) ? round($totaldepAmount->row()->DAmount, 2) : '0.00';
} else {
    $totaldepAmount = '0.00';
}

$totalGames = $this->home->searchQuery('SELECT * FROM `tbl_gamelist` WHERE `status` = 0');
$totalGames = !empty($totalGames) ? $totalGames->num_rows() : '';
$totalBetAmount = $this->home->searchQuery("SELECT SUM(`bet_amnt`) AS BetAmount FROM `tbl_bets`");
$totalBetAmount = !empty($totalBetAmount) && ($totalBetAmount->row()->BetAmount != null) ? round($totalBetAmount->row()->BetAmount, 2) : '0.00';
$c_date = date('Y-m-d');
$td = date('l', strtotime($c_date));
$tdg = $this->home->searchQuery('SELECT * FROM `tbl_gamelist` WHERE `status` = 0  AND `day` = "' . strtolower($td) . '" ORDER BY `match_time` ASC');
$tgp = $this->home->searchQuery('SELECT * FROM `tbl_gamelist` WHERE `status` = 0 AND `match_time` < "' . date('H:i') . '" AND `day` = "' . strtolower($td) . '"');