<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class Paymentmodel extends Model
{
    protected $db;
    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    function insertCustomer($data)
    {
        $builder = $this->db->table('pay_customer');
        $builder->insert($data);
        return $this->db->insertID();
    }

    function insertTransaction($data)
    {
        $builder = $this->db->table('pay_transactions');
        $builder->insert($data);
        return $this->db->insertID();
    }
}
