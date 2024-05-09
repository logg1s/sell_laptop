<?php
class Usages extends DB
{
    public function IUsage($username)
    {
        $last_view = $this->command("SELECT * FROM `web_usage` where username = '$username' ORDER BY id DESC limit 1;")->fetch_assoc();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $datetime = strtotime($last_view['datetime'] ?? "2000-09-15 00:00:00");
        if (time() - $datetime < 300)
            return false;
        $qr = "insert into web_usage (id, username, datetime) values (null, '$username', default)";
        try {
            $this->command($qr);
            return true;
        } catch (Exception) {
            return false;
        }
    }
    public function ProductViewCount($id)
    {
        $qr = "update product set view = view + 1 where id = '$id'";
        try {
            $this->command($qr);
            return true;
        } catch (Exception) {
            return false;
        }
    }
}
