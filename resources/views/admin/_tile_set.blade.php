{{--bootstrapとjquery-uiが競合して、登録時の挙動がおかしい--}}
{{--対策がないため、このテンプレは使用なし--}}

<div class="qustion-tiles">
    <div id="question-tile-set"></div>
    <text class="btn btn-primary" id="reset">リセット</text>
    <div class="tiles">
        <div id="manzu">
            <p>萬子</p>
            @for($i=1; $i <= 9;$i++)
                <img id="{{$i}}mnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}{{ $i }}mnz.png" width="30px">
            @endfor
            <img id="5rmnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}5rmnz.png" width="30px">
        </div>
        <div id="souzu">
            <p>索子</p>
            @for($i=1; $i <= 9;$i++)
                <img id="{{$i}}suz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}{{ $i }}suz.png" width="30px">
            @endfor
            <img id="5rsuz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}5rsuz.png" width="30px">
        </div>
        <div id="pinzu">
            <p>筒子</p>
            @for($i=1; $i <= 9;$i++)
                <img id="{{$i}}pnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}{{ $i }}pnz.png" width="30px">
            @endfor
            <img id="5rpnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}5rpnz.png" width="30px">
        </div>
        <div id="pinzu">
            <p>字牌</p>
            <img id="hk" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}hk.png" width="30px">
            <img id="ht" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}ht.png" width="30px">
            <img id="tyun" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}tyun.png" width="30px">
            <img id="ton" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}ton.png" width="30px">
            <img id="nan" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}nan.png" width="30px">
            <img id="sya" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}sya.png" width="30px">
            <img id="pei" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}pei.png" width="30px">
        </div>
    </div>
</div>

<script src="/js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<link type="text/css" rel="stylesheet" href="/js/jquery-ui-1.12.1.custom/jquery-ui.css">
<script>
    $(function () {
        let question = $(".question").val()
        let question_tiles = question.split('.')
        let tile_img = new String()
        let question_hidden = $('[name="question"]').val()
        if (question_hidden === '') {
            // 仮
            question_tiles = ['1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz', '1mnz']
            question_hidden = '1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz.1mnz'
        }
        let before_question_hidden = question_hidden.concat()
        $.each(question_tiles, function (index, tile) {
            tile_img += '<img src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}'+ tile + '.png" id="question-tile'+ index + '"  width="50px">'
        })
        $("#question-tile-set").html(tile_img)

        dropableAndDragableTile()

        // リセットボタン
        $('#reset').click(function () {
            // questionのhiddenを戻す
            $('[name="question"]').val(before_question_hidden)

            // Qのセットを戻す
            let before_question_tiles = before_question_hidden.split('.')
            tile_img = []
            $.each(before_question_tiles, function (index, tile) {
                tile_img += '<img src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}'+ tile + '.png" id="question-tile'+ index + '"  width="50px">'
            })
            $("#question-tile-set").html(tile_img)

            dropableAndDragableTile()
        })



        function dropableAndDragableTile() {
            // Qの牌をドラッグ時
            $(".drag-tile").draggable({
                revert:true,
                containment: ".qustion-tiles"
            })

            // Qに牌をドロップした時
            for (var i = 0; i <= 12;i++) {
                $("#question-tile" + i).droppable({
                    drop: function (event, ui) {
                        let drag_tile = ui.draggable.attr('id')
                        let attr_src = "{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}" + drag_tile + '.png'
                        let tile_index = $(this).attr('id').substr(13)

                        // Qの牌をドラッグした牌に置き換え
                        $("#question-tile" + tile_index).attr('src', attr_src)

                        // questionのhiddenをドラッグした牌に更新
                        let QstHiddenArr = question_hidden.split('.')
                        QstHiddenArr[tile_index] = drag_tile
                        let update_question_hidden = QstHiddenArr.join('.')
                        $('[name="question"]').val(update_question_hidden)
                        question_hidden = update_question_hidden
                    }
                })
            }
        }
    })



</script>
