<div class="section secondary-section ">
    <div id="stat_ip" style="background-color: black">
        <h3 class="stat_center">Статистика посещений по IP</h3>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @include('Views::table')


        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}
        {{ Form::hidden('reset', true)}}
        {!! Form::button('Сбросить фильтры',['class'=>'button-reset','type'=>'submit']) !!}
        {!! Form::close() !!}
        <hr>


        <h3>Сформировать за указанную дату</h3>
        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}
        {!! Form::text('date_ip', '',['class'=>'date_ip']) !!}

        {!! Form::button('Отфильтровать',['class'=>'button-reset','type'=>'submit']) !!}
        {!! Form::close() !!}
        <hr>


        <h3>Сформировать за выбранный период </h3>
        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}

        <div class="form-group">
            {{ Form::label('Начало', null, ['class' => 'control-label']) }}
            {!! Form::text('start_time', '',['class'=>'date_ip']) !!}
        </div>

        <div class="form-group">
            {{ Form::label('Конец', null, ['class' => 'control-label']) }}
            {!! Form::text('stop_time', '',['class'=>'date_ip']) !!}
        </div>

        {{ Form::hidden('period', true)}}
        {!! Form::button('Отфильтровать',['class'=>'button-reset','type'=>'submit']) !!}
        {!! Form::close() !!}
        <hr>


        <h3>Сформировать по определенному IP</h3>
        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}

        <div class="form-group">
            {{ Form::label('IP', null, ['class' => 'control-label']) }}
            {!! Form::text('ip', null, ['placeholder' => '127.0.0.1']) !!}
        </div>

        {{ Form::hidden('search_ip', true)}}
        {!! Form::button('Отфильтровать',['class'=>'button-reset','type'=>'submit']) !!}
        {!! Form::close() !!}
        <hr>


        <h3>Черный список IP</h3>
        <p>Под черным списком понимаются IP, по которым не нужна статистика, например IP администратора сайта.
            <br>По данным IP статистика не будет сохраняться с момента добавления в черный список.</p>

        <table>
            <tr class='tr_small'>

                <h4>Сейчас в черном списке:</h4>
                @foreach($black_list as $key=>$value)
                    <td> {{$value['ip']}}
                        @if(!empty($value['comment']))
                            - {{$value['comment']}}
                        @endif
                    </td>
                @endforeach

                @if(count($black_list)==0)
                    <td>Черный список пуст.</td>
                @endif

            </tr>
        </table>
        <br>


        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('IP', null, ['class' => 'control-label']) }}
            {!! Form::text('ip', null, ['placeholder' => '127.0.0.1']) !!}
        </div>
        <div class="form-group">
            {{ Form::label('Комментарий', null, ['class' => 'control-label']) }}
            {!! Form::text('comment') !!}
        </div>

        {{ Form::hidden('add_black_list', true)}}
        {!! Form::button('Добавить в черный список',['type'=>'submit']) !!}
        {!! Form::close() !!}
        <br>


        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('IP', null, ['class' => 'control-label']) }}
            {!! Form::text('ip', null, ['placeholder' => '127.0.0.1']) !!}
        </div>

        {{ Form::hidden('del_black_list', true)}}
        {!! Form::button('Удалить из черного списка',['type'=>'submit']) !!}
        {!! Form::close() !!}
        <hr>


        <h3>Очистка базы данных <span class="font_min">(старше 90 дней)</span></h3>

        {!! Form::open(['url'=>route('forms'), 'class'=>'form-horizontal','method' => 'POST']) !!}
        {{ Form::hidden('del_old', true)}}
        {!! Form::button('Удалить старые данные',['type'=>'submit']) !!}
        {!! Form::close() !!}
        <br>


        <script type="text/javascript">

            $.datepicker.regional['ru'] = {
                closeText: 'Закрыть',
                prevText: '&#x3c;Пред',
                nextText: 'След&#x3e;',
                currentText: 'Сегодня',
                monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
                    'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
                dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                dateFormat: 'dd.mm.yy',
                firstDay: 1,
                isRTL: false
            };
            $.datepicker.setDefaults($.datepicker.regional["ru"]);


            $('.date_ip').datepicker({

                dateFormat: "dd-mm-yy", //формат даты
                minDate: "-1y", // выбор не более чем за последний год
                maxDate: "+0d" // максимальная дата выбора - сегодняшняя
            });

        </script>

    </div>
</div>