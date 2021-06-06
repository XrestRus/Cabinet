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
        text-align: center;
    }
    table {
        width: 100%;
    }
    table, tbody, tr, td{
        border-collapse: collapse;
        border: 1px solid black;
        height: 13px;
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
	.h {
	    text-align: center;
		font-weight: bold;
		font-size: 25px;
		padding: 0 0 10px 0;
	}
    hr {
        position: fixed;
        right: 5px;
        margin: 2rem;
        width: 50%;
        top: 37%;
    }

</style>
<body>

<div class='center h'>
	Табель учета рабочего времени  за {{ $date[0].' - '.$date[1] }}
</div>



<table>
    <tr>
		<td rowspan='3'>
			Номер
        </td>
        <td rowspan='3'>
            <div>
				Фамилия, инициалы,
			</div>
			<div>
				должность
			</div>
        </td>
		<td rowspan='3'>
			Табель
        </td>
		<td colspan='16'>
			Отметки о явках и неявках на работу по числу месяца
        </td>

        <td >
            Отработано за
        </td>

    </tr>
	<tr>

		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
		<td>6</td>
		<td>7</td>
		<td>8</td>
		<td>9</td>
		<td>10</td>
		<td>11</td>
		<td>12</td>
		<td>13</td>
		<td>14</td>
		<td>15</td>
		<td>X</td>

        <td>
            Дни
        </td>

    </tr>
	<tr>

		<td>16</td>
		<td>17</td>
		<td>18</td>
		<td>19</td>
		<td>20</td>
		<td>21</td>
		<td>22</td>
		<td>23</td>
		<td>24</td>
		<td>25</td>
		<td>26</td>
		<td>27</td>
		<td>28</td>
		<td>29</td>
		<td>30</td>
		<td>31</td>

        <td>
            Часы
        </td>
	</tr>

	<tr>
		<td rowspan='4'>
			{{ $user->visits[0]->id ?? 0 }}
        </td>
        <td rowspan='4'>
            <div>
                {{ $user->title }}
            </div>
			<div>
                {{ $user->role()->first()->title }}
            </div>
        </td>
		<td rowspan='4'>
            {{ $user->visits[0]->id ?? 0 }}
        </td>

        @for ($i = 1; $i < 16; $i++)
            @if ($user->visits->contains(function($v, $k) use($i) {
                return $v->date->day === $i;
            }))
                <td>
                    {{
                        $user->visits[$user->visits->search(function ($v, $k) use($i) {
                               return $v->date->day === $i;
                        })]['clock']
                       }}
                </td>
            @else
                <td>  </td>
            @endif
        @endfor
        <td> X </td>

        <td>
            {{
                $user->visits->slice(0,15)->count(function($i) {
                    return $i->date->day;
                })
            }}
        </td>
	</tr>

	<tr>
        @for ($i = 1; $i < 16; $i++)
            @if ($user->visits->contains(function($v, $k) use($i) {
                return $v->date->day === $i;
            }))
                <td>
                    {{
                        $user->visits[$user->visits->search(function ($v, $k) use($i) {
                          return $v->date->day === $i;
                        })]['type_mark']['code']
                  }}
                </td>
            @else
                <td>  </td>
            @endif
        @endfor
        <td> X </td>

        <td>
            {{
                $user->visits->slice(0,15)->sum(function($i) {
                    return $i->clock;
                })
            }}
        </td>
    </tr>

	<tr>
        @for ($i = 16; $i < 32; $i++)
            @if ($user->visits->contains(function($v, $k) use($i) {
                return $v->date->day === $i;
            }))
                <td>
                    {{
                        $user->visits[$user->visits->search(function ($v, $k) use($i) {
                            return $v->date->day === $i;
                        })]['type_mark']['code']
                    }}
                </td>
            @else
                <td>  </td>
            @endif
        @endfor

        <td>
            {{
                $user->visits->slice(15, 31)->count(function($i) {
                    return $i->date->day;
                })
            }}
        </td>
	</tr>

	<tr>
        @for ($i = 16; $i < 32; $i++)
            @if ($user->visits->contains(function($v, $k) use($i) {
                return $v->date->day === $i;
            }))
                <td>
                    {{
                        $user->visits[$user->visits->search(function ($v, $k) use($i) {
                            return $v->date->day === $i;
                        })]['clock']
                    }}
                </td>
            @else
                <td>  </td>
            @endif
        @endfor

        <td>
            {{
                $user->visits->slice(15, 31)->sum(function($i) {
                    return $i->clock;
                })
            }}
        </td>
	</tr>

</table>

<hr>
<hr>

</body>
</html>
