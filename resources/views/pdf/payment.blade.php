<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
        font-family: DejaVu Sans;
        font-size: 14px;
        border: 0;
    }
    table {
        width: 100%;
    }
    table, tbody, tr, td{
        border-collapse: collapse;
        border: 1px solid black
    }
    td div {
        border-bottom: 0;
    }
    .clear, .clear tbody, .clear tr, .clear td {
        border: 0;

    }
    .clear {
        margin: 5px;
    }
    .center {
        text-align: center;
    }
</style>
<body>
<div class="center">Расчетный лист за {{ $year.'-'.$month }}</div>
<table class="clear">
    <tr>
        <td>Работник - {{ $user->surname." ".$user->name." ".$user->patronymic }}</td>
        <td>Должность - {{ $user->role()->first()->title }}</td>
    </tr>
    <tr>
        <td>Номер: {{ $payments[0]["id"] }}</td>
    </tr>
</table>
<table>
    <tr>
        <td>
            <div>Вид</div>
        </td>
        <td>
            <div>Период</div>
        </td>
        <td>
            <div>Дни</div>
        </td>
        <td>
            <div>Часы</div>
        </td>
        <td>
            <div>Сумма</div>
        </td>
        <td>
            <div>Вид</div>
        </td>
        <td>
            <div>Период</div>
        </td>
        <td>
            <div>Сумма</div>
        </td>
    </tr>
    <tr>
        <td colspan="5">
            <div>1. Начисление</div>
        </td>
        <td colspan="3">
            <div>2. Удержано</div>
        </td>
    </tr>

    @for ($i = 0; $i < max($payments_accrual->count(), $payments_retention->count()); $i++)
   
        <tr>
            @if($i < $payments_accrual->count())
                <td><div>{{ $payments_accrual[$i]->type_payment()->first()->title }}</div></td>
                <td><div>{{ $payments_accrual[$i]->date->format("M-Y") }}</div></td>
                <td><div>{{ $payments_accrual[$i]->days }}</div></td>
                <td><div>{{ $payments_accrual[$i]->clock }}</div></td>
                <td><div>{{ $payments_accrual[$i]->sum }}</div></td>
            @else
                <td><div> </div></td>
                <td><div> </div></td>
                <td><div> </div></td>
                <td><div> </div></td>
                <td><div> </div></td>
            @endif
            @if($i < $payments_retention->count())
                <td><div>{{ $payments_retention[$i]->type_payment()->first()->title }}</div></td>
                <td><div>{{ $payments_retention[$i]->date->format("M-Y") }}</div></td>
                <td><div>{{ $payments_retention[$i]->sum }}</div></td>
            @else
                <td><div> </div></td>
                <td><div> </div></td>
                <td><div> </div></td>
            @endif
        </tr>

    @endfor

    <tr>
        <td colspan="4">
            <div>Всего начислено: </div>
        </td>
        <td>
            <div>{{ $payments_accrual->sum('sum') }}</div>
        </td>
        <td colspan="2">
            <div>Всего удержано: </div>
        </td>
        <td>
            <div>{{ $payments_retention->sum('sum') }}</div>
        </td>
    </tr>
    <tr>
        <td colspan="5">
            <div> </div>
        </td>
        <td colspan="2">
            <div>Сумма к выплате: </div>
        </td>
        <td>
            <div>{{ $payments_accrual->sum('sum') - $payments_retention->sum('sum') }}</div>
        </td>
    </tr>

</table>
</body>
</html>
