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

    protected function getChartData(&$data){
        $months= getArrayOfMonths();
        $sql = "SELECT COUNT(*) as count, MONTH(created_at) as month FROM `transactions`
                WHERE YEAR(transactions.created_at) = YEAR(CURRENT_DATE) AND type = 'd'
                GROUP BY MONTH(created_at) ORDER BY MONTH(created_at)";
        $result = DB::select($sql);
        $deposit = [];
        foreach ($result as $row)
            $deposit[$row->month - 1] = $row->count;

        $sql = "SELECT COUNT(*) as count, MONTH(created_at) as month FROM `transactions`
                WHERE YEAR(transactions.created_at) = YEAR(CURRENT_DATE) AND type = 'w'
                GROUP BY MONTH(created_at) ORDER BY MONTH(created_at)";
        $result = DB::select($sql);
        $withdrawal = [];
        foreach ($result as $row)
            $withdrawal[$row->month - 1] = $row->count;

        foreach ($months as $number => $month){
            if(!isset($withdrawal[$number]))
                $withdrawal[$number] = 0;
            if(!isset($deposit[$number]))
                $deposit[$number] = 0;
        }

        $data['deposit'] = json_encode($deposit);
        $data['withdrawal'] = json_encode($withdrawal);
        $data["months"] = json_encode($months);
    }

    public function indexPage(): array
    {
        $data["counters"] = $this->getCounters();
        $this->getChartData($data);
        return $data;
    }

}
