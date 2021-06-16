<?php


namespace App\Repositories;


use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentRepository
{
    public function getGroupByUser($userId = null) {
        $payments = Payment::without('type_payment')->join("users", "payments.user_id", "=", "users.id")
            ->select(
                DB::raw('DISTINCT users.id as user_id,
                    CONCAT(`users`.`name`, " ", `users`.`surname`, " ", `users`.`patronymic`) as user,
                    `users`.`id`,
                    DATE_FORMAT(`date`, \'%Y-%m\') as date'
                )
            )
            ->groupBy("users.name", "users.surname", "users.patronymic", "users.id", "date");

        if ($userId) $payments = $payments->where("users.id", $userId);

        return $payments->get();
    }

    public function showGroupToDate(User $user, $year, $month) {
        return $user
            ->payments()
            ->whereYear('payments.date', $year)
            ->whereMonth('payments.date', $month)
            ->get();
    }

    public function filterByTransaction($payments, $typeId) {
        return $payments->filter(function($v, $k) use($typeId) {
            return $v->type_payment()->first()->type_transaction_id === $typeId;
        })->values();
    }

    public function create($payment) {
        Payment::create([
            "clock" => $payment->clock,
            "days" => $payment->days,
            "date" => $payment->date,
            "comment" => $payment->comment,
            "sum" => $payment->sum,
            "type_payment" => $payment->type_payment['id'],
            "user_id" => $payment->user['id'],
        ]);
    }

    public function update($payment, $new) {

        return $payment->update([
            "clock" => $new->clock,
            "days" => $new->days,
            "date" => $new->date,
            "comment" => $new->comment,
            "sum" => $new->sum,
            "type_payment" => $new->type_payment['id'],
        ]);
    }

    public function delete(Payment $payment) {
        Payment::destroy($payment->id);
    }

    public function deleteGroupToDate(User $user, $year, $month) {
        Payment::where('user_id', $user->id)
            ->whereYear('payments.date', $year)
            ->whereMonth('payments.date', $month)
            ->delete();
    }
}
