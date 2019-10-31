@if (session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function(){
            $.notify({
                title: "Success!",
                message: "{{ session()->get('success') }}"
            },{
                type: 'info'
            });
        });
    </script>
@endif

@if (session()->has('alert'))
    <script type="text/javascript">
        $(document).ready(function(){
            $.notify({
                title: "Sorry!",
                message: "{{ session()->get('alert') }}"
            },{
                type: 'danger'
            });
        });
    </script>
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