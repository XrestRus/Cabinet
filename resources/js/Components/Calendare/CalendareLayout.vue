<template>
<div class="calendare">
    <div class="c-row c-head">
        <div class="c-cell">
            Пн
        </div>
            <div class="c-cell">
            Вт
        </div>
            <div class="c-cell">
            Ср
        </div>
            <div class="c-cell">
            Чт
        </div>
            <div class="c-cell">
            Пт
        </div>
        <div class="c-cell">
            Сб
        </div>
        <div class="c-cell">
            Вс
        </div>
    </div>
    <div class="c-row" v-for="r of calendare.row" :key='r'>
        <cell
            v-for="c of calendare.column"
            :key='c'
            :row='r'
            :column='c'
            :isCurrentMonth='daysArray[r+""+c].isCurrentMonth'
            :cell='daysArray[r+""+c].day'
            :data='daysArray[r+""+c].data'
            :event='event'
        />
    </div>
</div>
</template>

<script>
import Cell from "@/Components/Calendare/Cell.vue";
import { getDate } from "@/utilits.js";
import { ref, reactive, onBeforeUpdate, onBeforeMount, watch } from 'vue';

export default {
    components: {
        Cell
    },

    props: {
        date: {
            type: String,
            default: null
        },
        data: {
            type: Array,
            default: [{
                title: "",
                day: null
            }]
        },
        event: null
    },

    setup(props) {
        const daysArray = reactive([]);
        const calendare = ref({});

        function set() {
            let n = 1;
            calendare.value = {
                ...getDate(props.date),
                row: 6,
                column: 7,
            };

            for(let r = 1; r <= calendare.value.row; r++) {
                for(let c = 1; c <= calendare.value.column; c++) {
                    let isValid = isValidDate(r, c, n);
                    let titlies = parseData(props.data, n);

                    daysArray[r+''+c] = {
                        row: r,
                        column: c,
                        data:  isValid ? titlies : null,
                        day: isValid ? n++ : null,
                        isCurrentMonth: isValid ? true : false,
                    };
                }
            }
        }

        function parseData(data, n) {
            if (data.length === 0) return;

            let array = null;

            if (
                data[0].hasOwnProperty("date_start")
                && data[0].hasOwnProperty("date_end")
            ) {
                array = data?.filter(
                    i => (
                            (
                                (
                                    i.date_start.split('-')[1] === calendare.value.month
                                    && i.date_end.split('-')[1] === calendare.value.month
                                ) && (
                                    i.date_start.split('-')[2] == n
                                    || i.date_end.split('-')[2] == n
                                    || i.date_start.split('-')[2] <= n
                                    && i.date_end.split('-')[2] >= n
                                )
                            )
                            || (
                                i.date_end.split('-')[1] !== calendare.value.month
                                && i.date_start.split('-')[2] <= n
                            )
                            || (
                                i.date_start.split('-')[1] !== calendare.value.month
                                && i.date_end.split('-')[2] >= n
                            )
                        )
                );
            } else if (data[0].hasOwnProperty("date")) {
                array = data?.filter(i => i.date.split('-')[2] == n);
            }

            return array?.map(i => {
                return {
                    title: i.title,
                    desc: i.desc,
                    date: i.date ?? i.date_start + ' - ' + i.date_end,
                }
            });
        }

        function isValidDate(r, c, n) {
            return (((c >= calendare.value.day_start && r === 1)
                || (c <= calendare.value.day_end && r === 6))
                || (r > 1 && r < 6))
                && calendare.value.days >= n
        }

        onBeforeUpdate(_ => {
            set();
        });

        set();

        return {
            daysArray, calendare, set, isValidDate
        }
    },

}
</script>

<style lang='scss'>
.calendare {
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    flex: 1;

    .c-head {
        max-height: 30px;
        background: var(--color-form-h);
        color: var(--color-white);
    }

    .c-row {
        display: flex;
        flex: 1;

        .c-cell {
            transition: transform 0.4s;
            display: flex;
            // flex-direction: column;
            flex: 1;
            align-items: center;
            justify-content: center;
            box-shadow:
                inset -1px -1px 0px 0px  var(--color-form-h),
                inset 1px 0px 0px 0px  var(--color-form-h);

            // .c-info {
            //      height: 18px;
            // }

            .c-day {
                width: 55px;
                text-align: center;
            }
        }

        .c-cell.body {
            background-color: rgba(192, 192, 192, 0.253);

        }

        .c-cell.body.currentMonth {
            background-color: transparent;

            &:hover {
                background: var(--color-form-h);
                box-shadow:
                    -1px -1px 4px 0px #000000,
                    1px 0px 5px 0px #000000;
                transform: scale(1.1 );

                span {
                    color: var(--color-white);
                }
            }
        }

    }
}
</style>
