@if (session('success'))
    <div class="alert alert-success alert-auto-dismiss" role="alert">
        {{ session('success') }}
    </div>
    <script>
    (function(){
        var els = document.querySelectorAll('.alert-auto-dismiss');
        if(!els || els.length === 0) return;
        els.forEach(function(el){
            el.style.transition = 'opacity 0.3s ease, max-height 0.3s ease, margin 0.3s ease, padding 0.3s ease';
            setTimeout(function(){
                el.style.opacity = '0';
                el.style.maxHeight = '0';
                el.style.margin = '0';
                el.style.padding = '0';
                setTimeout(function(){ if(el.parentNode) el.parentNode.removeChild(el); }, 320);
            }, 2000);
        });
    })();
    </script>
@endif
 
@if (session('info'))
    <div class="alert alert-info alert-auto-dismiss" role="alert">
        {{ session('info') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif