<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class DashboardRepository
{

    public function getCounters(){
        $sql = 'SELECT 	(SELECT COUNT(id) from users) as `usersCount` ,
                        (SELECT COUNT(id) from transactions) as `transactionsCount`,
                        (SELECT COUNT(id) from payment_methods) as `paymentMethodsCount`,
                        (SELECT SUM(total_amount) from wallets) as `walletsTotalAmount`';
        $counters = DB::select($sql);
        return $counters[0];
    }

    public function indexPage(){
        $data["counters"] = $this->getCounters();
        return $data;
    }

}
