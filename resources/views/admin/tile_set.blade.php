<div class="qustion-tiles">
    <div id="question-tile-set"></div>
    <text class="btn btn-primary" id="reset">リセット</text>
    <text class="btn btn-warning" id="delete">削除</text>
    <div class="tiles">
        <div id="manzu">
            <p>萬子</p>
            @for($i=1; $i <= 9;$i++)
                <img id="{{$i}}mnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}{{ $i }}mnz.png" width="30px" onclick="clickHai(this)">
            @endfor
            <img id="5rmnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}5rmnz.png" width="30px" onclick="clickHai(this)">
        </div>
        <div id="souzu">
            <p>索子</p>
            @for($i=1; $i <= 9;$i++)
                <img id="{{$i}}suz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}{{ $i }}suz.png" width="30px" onclick="clickHai(this)">
            @endfor
            <img id="5rsuz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}5rsuz.png" width="30px" onclick="clickHai(this)">
        </div>
        <div id="pinzu">
            <p>筒子</p>
            @for($i=1; $i <= 9;$i++)
                <img id="{{$i}}pnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}{{ $i }}pnz.png" width="30px" onclick="clickHai(this)">
            @endfor
            <img id="5rpnz" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}5rpnz.png" width="30px" onclick="clickHai(this)">
        </div>
        <div id="pinzu">
            <p>字牌</p>
            <img id="hk" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}hk.png" width="30px" onclick="clickHai(this)">
            <img id="ht" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}ht.png" width="30px" onclick="clickHai(this)">
            <img id="tyun" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}tyun.png" width="30px" onclick="clickHai(this)">
            <img id="ton" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}ton.png" width="30px" onclick="clickHai(this)">
            <img id="nan" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}nan.png" width="30px" onclick="clickHai(this)">
            <img id="sya" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}sya.png" width="30px" onclick="clickHai(this)">
            <img id="pei" class="drag-tile" src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}pei.png" width="30px" onclick="clickHai(this)">
        </div>
    </div>
</div>

<script>
    $(function () {
        let question = $(".question").val()
        let question_tiles = question.split('.')
        let tile_img = new String()

        $.each(question_tiles, function (index, tile) {
            tile_img += '<img src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}'+ tile + '.png" id="question-tile'+ index + '"  width="50px">'
        })
        $("#question-tile-set").val(question)
        $("#question-tile-set").html(tile_img)
    })


    // リセットボタン
    $('#reset').click(function () {
        let question = $(".question").val()
        let question_tiles = question.split('.')
        // questionのhiddenを戻す
        $('[name="question"]').val(question)

        // Qのセットを戻す
        tile_img = []
        $.each(question_tiles, function (index, tile) {
            tile_img += '<img src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}'+ tile + '.png" id="question-tile'+ index + '"  width="50px">'
        })
        $("#question-tile-set").val(question)
        $("#question-tile-set").html(tile_img)
        $("#question").val(question)
    })

    // 削除ボタン
    $('#delete').click(function () {
        $("#question-tile-set").val('')
        $("#question-tile-set").html('')
        $("#question").val('')
    })

    function clickHai(hai) {
        var tile = hai.id
        var tile_set = $("#question-tile-set").val()

        let arrTileSet = tile_set.split('.')
        if (arrTileSet.length <= 12) {
            if (tile_set === '') {
                add_tile_set = tile
            } else {
                add_tile_set = tile_set + '.' + tile
            }

            arrAddTileSet = add_tile_set.split('.')
            tile_img = []
            $.each(arrAddTileSet, function (index, tile) {
                tile_img += '<img src="{{\Illuminate\Support\Facades\Config::get('const.TILES_IMG_PATH')}}'+ tile + '.png" id="question-tile'+ index + '"  width="50px">'
            })
            $("#question-tile-set").val(add_tile_set)
            $("#question-tile-set").html(tile_img)
            $("#question").val(add_tile_set)
        } else {
            alert('設定した牌が多すぎます。')
        }
    }

</script>
