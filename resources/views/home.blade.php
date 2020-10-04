@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h3 class="text-center">All Restuarants</h3>
        </div>
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <table class="table table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Restuarant Name</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center">Number of visits</th>
                                <th class="text-center">Open date(s)</th>
                                <th class="text-center">Open/Closed</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($restuarantListData as $list)
                            <tr>                                
                                <td>{{ ucwords($list->resname) }}</th>
                                <td class="text-center">{{ $list->rating }}</td>
                                <td class="text-center">{{ $list->visits }}</td>
                                <td class="text-center">{{ $list->date }}</td>
                                <td class="text-center">{{ strtoupper($list->openorclose) }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-target-id="{{$list->rating}}" id="{{$list->rating}}">
                                        Add to my collection
                                    </button>
                                </td>
                            </tr>                    
                        @endforeach
                        </tbody>
                    </table>
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} -->
                </div>                

            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">My Restaurant collections</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="collection-name" class="col-form-label">Collection name</label>
                        <input type="text" class="form-control" id="collection-name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary csave">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">

    $('#exampleModal').on('shown.bs.modal', function (event) {

        var id = $(event.relatedTarget).data('target-id');

        $("button.csave").click(function() {
            var cname = $("input#collection-name").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('save.collection') }}",
                data: {id:id, cname:cname},
                success: function(msg) {
                    if (msg == 'success') {
                        alert("Collection " + cname + " added successfully.");
                        $(".modal-backdrop").remove();
                        $("#exampleModal").hide();
                        location.reload();
                    } else if(msg == 'fail') {
                        alert("Collection " + cname + " already exists. Could not save with same name, please try with another collection name.");
                    } else {
                        alert("Something went wrong !!!");
                    }
                }
            });
        });

    });

</script>
@endsection


