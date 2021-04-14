<div class="{{$viewClass['form-group']}}">

    <label class="{{$viewClass['label']}} control-label">{{$label}}</label>

    <div class="{{$viewClass['field']}}">

        @include('admin::form.error')

        <textarea name="{{ $name}}" placeholder="{{ $placeholder }}" {!! $attributes !!} >{!! $value !!}</textarea>

        @include('admin::form.help-block')

    </div>
</div>

@include('vendor.ueditor.assets')

<script>
    window.UEDITOR_HOME_URL = "/vendor/ueditor/"
    window.UEDITOR_CONFIG.serverUrl = '{{ config('ueditor.route.name') }}'
</script>

<script type="text/javascript" init="{!! $selector !!}">
    var UE = baidu.editor.getEditor(id,{
        toolbars: [
            @json($options['toolbar'])
        ],
        initialFrameHeight: Number('{{$options['min_height']}}')
    })
    UE.ready(function() {
        //设置编辑器的内容
        UE.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        UE.execCommand('serverparam', 'path', '{{ $options['path'] }}'); // 设置 CSRF token.
    });
</script>
