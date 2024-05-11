<?php
class Database
{
    private $db_name = 'link_shortener';
    private $table_name = 'shortened_links';
    private $db;

    public function __construct() {
        $this->db = new SQLite3($this->db_name.'.db', SQLITE3_OPEN_CREATE|SQLITE3_OPEN_READWRITE);
        $this->db->enableExceptions(true);
        $this->db->query("create table if not exists $this->table_name(
            'id' integer primary key autoincrement not null,
            'key' text,
            'link' text,
            'created_at' datetime
        )");
    }

    public function insert($key, $link) {
        $now = date('Y-m-d H:i:s');
        $query = "insert into $this->table_name ('key', 'link', 'created_at') values ('$key', '$link', '$now')";
        $this->db->exec($query);
        return $this->find($key);
    }

    public function find($key) {
        $query = "select link from $this->table_name where key='$key'";
        return $this->db->querySingle($query);
    }
}