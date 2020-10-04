@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center">My Friends</h3>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <form id="friendsForm" name="friendsForm" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Friends email address</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" value="" maxlength="50" required="">
                            </div>
                        </div>
          
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-primary" id="saveBtn" value="create">Invite my friend</button>
                        </div>
                    </form>
                    
                    <br />

                    <table class="table table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Friend Email</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($friendsListCount as $list)
                            <tr>                                
                                <td>{{ $list->femail }}</th>
                                <td class="text-center">{{ $list->status }}</td>
                            </tr>                    
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $("button#saveBtn").click(function() {
        var emailvalue = $("input#email").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "{{ route('invite.friends') }}",
            data: {emailvalue:emailvalue},
            success: function(msg) {
                if (msg == 'success') {
                    alert("Email Invitation sent.");
                } else if(msg == 'fail') {
                    alert("Email Invitation not sent.");
                } else {
                    alert("Something went wrong !!!");
                }
            }
        });
    });

</script>
@endsection


